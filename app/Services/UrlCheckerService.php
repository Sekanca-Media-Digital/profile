<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class UrlCheckerService
{
    /**
     * Get server's public/outgoing IP (network IP).
     * Cached for 1 hour.
     */
    public function getNetworkIp(): ?string
    {
        return Cache::remember('url_checker_network_ip', 3600, function () {
            try {
                $response = Http::timeout(5)->get('https://api.ipify.org?format=text');

                return $response->successful() ? trim($response->body()) : null;
            } catch (\Exception) {
                return null;
            }
        });
    }

    /**
     * Normalize URL to ensure it has scheme.
     */
    protected function normalizeUrl(string $url): string
    {
        $url = trim($url);
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $url = 'https://' . $url;
        }

        return $url;
    }

    /**
     * Extract host/domain from URL.
     */
    protected function extractHost(string $url): string
    {
        $parsed = parse_url($this->normalizeUrl($url));

        return $parsed['host'] ?? $url;
    }

    /**
     * HTTP Checker - get status, headers, response time.
     */
    public function checkHttp(string $url): array
    {
        $url = $this->normalizeUrl($url);

        try {
            $start = microtime(true);
            $response = Http::timeout(8)->withOptions(['verify' => false])
                ->withHeaders(['User-Agent' => 'Sekanca-URL-Checker/1.0'])
                ->get($url);

            $responseTime = round((microtime(true) - $start) * 1000);
            $headers = collect($response->headers())->map(fn ($v) => is_array($v) ? ($v[0] ?? '') : $v)->toArray();

            return [
                'success' => true,
                'url' => $url,
                'status_code' => $response->status(),
                'response_time_ms' => $responseTime,
                'headers' => $headers,
                'content_length' => $headers['Content-Length'] ?? null,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'url' => $url,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Resolve host to first available IPv4 or IPv6.
     */
    public function resolveHostToIp(string $url): ?string
    {
        $host = $this->extractHost($url);
        $records = @dns_get_record($host, DNS_A + DNS_AAAA);
        if (!is_array($records) || empty($records)) {
            return null;
        }
        foreach ($records as $r) {
            if (isset($r['ip'])) {
                return $r['ip'];
            }
            if (isset($r['ipv6'])) {
                return $r['ipv6'];
            }
        }

        return null;
    }

    /**
     * IP Info - geolocation & ISP for domain's IP (like check-host.net).
     */
    public function checkIpInfo(string $url): array
    {
        $host = $this->extractHost($url);
        $ip = $this->resolveHostToIp($url);

        if (!$ip) {
            return [
                'success' => false,
                'host' => $host,
                'error' => 'Tidak dapat me-resolve IP untuk host ini.',
            ];
        }

        try {
            $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}?fields=status,message,country,countryCode,region,regionName,city,zip,lat,lon,timezone,isp,org,as,query");
            $data = $response->json();

            if (($data['status'] ?? '') !== 'success') {
                return [
                    'success' => false,
                    'host' => $host,
                    'ip' => $ip,
                    'error' => $data['message'] ?? 'Geolocation tidak tersedia.',
                ];
            }

            return [
                'success' => true,
                'host' => $host,
                'ip' => $data['query'] ?? $ip,
                'country' => $data['country'] ?? null,
                'country_code' => $data['countryCode'] ?? null,
                'region' => $data['regionName'] ?? null,
                'city' => $data['city'] ?? null,
                'zip' => $data['zip'] ?? null,
                'timezone' => $data['timezone'] ?? null,
                'isp' => $data['isp'] ?? null,
                'org' => $data['org'] ?? null,
                'as' => $data['as'] ?? null,
                'lat' => $data['lat'] ?? null,
                'lon' => $data['lon'] ?? null,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'host' => $host,
                'ip' => $ip,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Ping - approximate latency via TCP connect to port 80/443 (like check-host.net latency check).
     */
    public function checkPing(string $url): array
    {
        $host = $this->extractHost($url);
        $urlNormalized = $this->normalizeUrl($url);
        $parsed = parse_url($urlNormalized);
        $port = isset($parsed['port']) ? (int) $parsed['port'] : (str_starts_with($urlNormalized, 'https://') ? 443 : 80);

        $start = microtime(true);
        $fp = @fsockopen($host, $port, $errno, $errstr, 3);
        $latencyMs = round((microtime(true) - $start) * 1000);

        if ($fp) {
            fclose($fp);

            return [
                'success' => true,
                'host' => $host,
                'port' => $port,
                'latency_ms' => $latencyMs,
                'reachable' => true,
            ];
        }

        return [
            'success' => false,
            'host' => $host,
            'port' => $port,
            'latency_ms' => $latencyMs,
            'reachable' => false,
            'error' => $errstr ? "{$errstr} ({$errno})" : 'Host unreachable',
        ];
    }

    /**
     * Ping from multiple countries via Check-Host.net API (like check-host.net/check-ping).
     */
    public function checkPingGlobal(string $url): array
    {
        $host = $this->extractHost($url);
        $maxNodes = 12;
        $pollInterval = 2;
        $maxPollAttempts = 15;

        try {
            $startResponse = Http::timeout(10)
                ->withHeaders(['Accept' => 'application/json'])
                ->get("https://check-host.net/check-ping", [
                    'host' => $host,
                    'max_nodes' => $maxNodes,
                ]);

            $start = $startResponse->json();
            if (empty($start['request_id']) || empty($start['nodes'])) {
                return [
                    'success' => false,
                    'host' => $host,
                    'error' => 'Tidak dapat memulai pengecekan ping (Check-Host.net).',
                ];
            }

            $requestId = $start['request_id'];
            $nodes = $start['nodes'];
            $permanentLink = $start['permanent_link'] ?? null;

            $resultsByNode = [];
            $attempt = 0;

            while ($attempt < $maxPollAttempts) {
                if ($attempt > 0) {
                    sleep($pollInterval);
                }
                $attempt++;

                $resultResponse = Http::timeout(10)
                    ->withHeaders(['Accept' => 'application/json'])
                    ->get("https://check-host.net/check-result/{$requestId}");

                $resultData = $resultResponse->json();
                if (! is_array($resultData)) {
                    continue;
                }

                $hasAny = false;
                foreach (array_keys($nodes) as $nodeId) {
                    $nodeResults = $resultData[$nodeId] ?? null;
                    if ($nodeResults === null) {
                        continue;
                    }
                    $hasAny = true;
                    if (isset($resultsByNode[$nodeId])) {
                        continue;
                    }
                    $resultsByNode[$nodeId] = $nodeResults;
                }
                if ($hasAny && count($resultsByNode) >= count($nodes)) {
                    break;
                }
            }

            $rows = [];
            foreach ($nodes as $nodeId => $location) {
                $countryCode = $location[0] ?? '';
                $country = $location[1] ?? '';
                $city = $location[2] ?? '';
                $locationLabel = trim("{$city}, {$country}");
                if ($locationLabel === ', ') {
                    $locationLabel = $countryCode ?: $nodeId;
                }

                $status = '—';
                $timeMs = null;
                $targetIp = null;

                $raw = $resultsByNode[$nodeId] ?? null;
                if (is_array($raw) && ! empty($raw[0]) && is_array($raw[0])) {
                    $firstPing = is_array($raw[0][0] ?? null) ? $raw[0][0] : $raw[0];
                    if (is_array($firstPing)) {
                        $status = $firstPing[0] ?? '—';
                        $timeSec = $firstPing[1] ?? null;
                        if ($timeSec !== null) {
                            $timeMs = round((float) $timeSec * 1000);
                        }
                        $targetIp = $firstPing[2] ?? null;
                    }
                }

                $rows[] = [
                    'node_id' => $nodeId,
                    'country_code' => $countryCode,
                    'country' => $country,
                    'city' => $city,
                    'location' => $locationLabel,
                    'status' => $status,
                    'time_ms' => $timeMs,
                    'target_ip' => $targetIp,
                ];
            }

            return [
                'success' => true,
                'host' => $host,
                'permanent_link' => $permanentLink,
                'request_id' => $requestId,
                'rows' => $rows,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'host' => $host,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * TCP Port Checker - check if given ports are open (like check-host.net).
     * @param  array<int>|null  $ports  Default: 80, 443, 22, 21, 25, 587, 3306, 8080
     */
    public function checkTcpPort(string $url, ?array $ports = null): array
    {
        $host = $this->extractHost($url);
        $ports = $ports ?? [80, 443, 22, 21, 25, 587, 3306, 8080];

        $results = [];
        foreach ($ports as $port) {
            $port = (int) $port;
            if ($port < 1 || $port > 65535) {
                continue;
            }
            $fp = @fsockopen($host, $port, $errno, $errstr, 2);
            $results[] = [
                'port' => $port,
                'open' => (bool) $fp,
                'service' => $this->getPortServiceName($port),
            ];
            if ($fp) {
                fclose($fp);
            }
        }

        return [
            'success' => true,
            'host' => $host,
            'ports' => $results,
        ];
    }

    protected function getPortServiceName(int $port): string
    {
        $names = [
            21 => 'FTP',
            22 => 'SSH',
            25 => 'SMTP',
            80 => 'HTTP',
            443 => 'HTTPS',
            587 => 'SMTP (submission)',
            3306 => 'MySQL',
            8080 => 'HTTP-Alt',
            8443 => 'HTTPS-Alt',
        ];

        return $names[$port] ?? "Port {$port}";
    }

    /**
     * DNS Checker - A, AAAA, MX, NS, TXT, CNAME with TTL (like check-host.net).
     */
    public function checkDns(string $url): array
    {
        $host = $this->extractHost($url);

        $result = [
            'success' => true,
            'host' => $host,
            'records' => [],
        ];

        $types = [
            'A' => defined('DNS_A') ? DNS_A : 1,
            'AAAA' => defined('DNS_AAAA') ? DNS_AAAA : 28,
            'MX' => defined('DNS_MX') ? DNS_MX : 15,
            'NS' => defined('DNS_NS') ? DNS_NS : 2,
            'TXT' => defined('DNS_TXT') ? DNS_TXT : 16,
            'CNAME' => defined('DNS_CNAME') ? DNS_CNAME : 5,
        ];
        foreach ($types as $type => $const) {
            $records = @dns_get_record($host, $const);
            $result['records'][$type] = is_array($records) ? $records : [];
        }

        return $result;
    }

    /**
     * Redirect Checker - follow redirect chain.
     */
    public function checkRedirect(string $url): array
    {
        $url = $this->normalizeUrl($url);

        $chain = [];
        $currentUrl = $url;
        $maxRedirects = 10;
        $redirectCount = 0;

        try {
            while ($redirectCount < $maxRedirects) {
                $response = Http::timeout(5)->withOptions([
                    'verify' => false,
                    'allow_redirects' => false,
                ])->withHeaders(['User-Agent' => 'Sekanca-URL-Checker/1.0'])->get($currentUrl);

                $chain[] = [
                    'step' => $redirectCount + 1,
                    'url' => $currentUrl,
                    'status_code' => $response->status(),
                ];

                if ($response->status() >= 300 && $response->status() < 400) {
                    $location = $response->header('Location');
                    if ($location) {
                        $currentUrl = $this->resolveRedirectUrl($currentUrl, $location);
                        $redirectCount++;
                    } else {
                        break;
                    }
                } else {
                    break;
                }
            }

            return [
                'success' => true,
                'original_url' => $url,
                'final_url' => $currentUrl,
                'redirect_count' => $redirectCount,
                'chain' => $chain,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'url' => $url,
                'error' => $e->getMessage(),
            ];
        }
    }

    protected function resolveRedirectUrl(string $baseUrl, string $location): string
    {
        if (str_starts_with($location, 'http://') || str_starts_with($location, 'https://')) {
            return $location;
        }

        $parsed = parse_url($baseUrl);
        $scheme = $parsed['scheme'] ?? 'https';
        $host = $parsed['host'] ?? '';

        if (str_starts_with($location, '//')) {
            return $scheme . ':' . $location;
        }
        if (str_starts_with($location, '/')) {
            return $scheme . '://' . $host . $location;
        }

        return $scheme . '://' . $host . '/' . $location;
    }

    /**
     * WHOIS Checker.
     */
    public function checkWhois(string $url): array
    {
        $host = $this->extractHost($url);
        $host = preg_replace('/^www\./', '', $host);

        $whoisServer = $this->getWhoisServer($host);
        if (!$whoisServer) {
            return [
                'success' => false,
                'host' => $host,
                'error' => 'WHOIS server tidak ditemukan untuk domain ini.',
            ];
        }

        try {
            $whoisData = $this->queryWhois($host, $whoisServer);

            return [
                'success' => true,
                'host' => $host,
                'whois_server' => $whoisServer,
                'raw' => $whoisData,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'host' => $host,
                'error' => $e->getMessage(),
            ];
        }
    }

    protected function getWhoisServer(string $domain): ?string
    {
        $tld = substr(strrchr($domain, '.'), 1) ?: $domain;

        $servers = [
            'com' => 'whois.verisign-grs.com',
            'net' => 'whois.verisign-grs.com',
            'org' => 'whois.pir.org',
            'id' => 'whois.pandi.or.id',
            'co.id' => 'whois.pandi.or.id',
            'ac.id' => 'whois.pandi.or.id',
            'go.id' => 'whois.pandi.or.id',
            'info' => 'whois.afilias.net',
            'biz' => 'whois.biz',
            'io' => 'whois.nic.io',
        ];

        if (str_contains($domain, '.co.id') || str_contains($domain, '.ac.id') || str_contains($domain, '.go.id')) {
            $parts = explode('.', $domain);
            $sld = count($parts) >= 2 ? $parts[count($parts) - 2] . '.' . $parts[count($parts) - 1] : $tld;

            return $servers[$sld] ?? $servers[$tld] ?? null;
        }

        return $servers[$tld] ?? null;
    }

    protected function queryWhois(string $domain, string $server, int $port = 43): string
    {
        $fp = @fsockopen($server, $port, $errno, $errstr, 5);
        if (!$fp) {
            throw new \Exception("Tidak dapat terhubung ke WHOIS server: $errstr ($errno)");
        }

        fwrite($fp, $domain . "\r\n");
        $response = '';
        while (!feof($fp)) {
            $response .= fgets($fp, 128);
        }
        fclose($fp);

        return trim($response);
    }

    /**
     * Run a single check by name. For async/parallel frontend requests.
     *
     * @param  string  $url  URL or domain to check
     * @param  string  $check  One of: ip_info, ping, ping_global, http, dns, redirect, tcp_port, whois
     * @return array{success: bool, result: array}
     */
    public function runSingleCheck(string $url, string $check): array
    {
        $allowed = ['ip_info', 'ping', 'ping_global', 'http', 'dns', 'redirect', 'tcp_port', 'whois'];
        if (! in_array($check, $allowed, true)) {
            return ['success' => false, 'result' => ['error' => 'Invalid check type.']];
        }

        $result = match ($check) {
            'ip_info' => $this->checkIpInfo($url),
            'ping' => $this->checkPing($url),
            'ping_global' => $this->checkPingGlobal($url),
            'http' => $this->checkHttp($url),
            'dns' => $this->checkDns($url),
            'redirect' => $this->checkRedirect($url),
            'tcp_port' => $this->checkTcpPort($url),
            'whois' => $this->checkWhois($url),
            default => ['success' => false, 'error' => 'Unknown check'],
        };

        return ['success' => true, 'result' => $result];
    }

    /**
     * Run all checks for a URL (like check-host.net: IP Info, Ping, Ping Global, HTTP, DNS, Redirect, TCP Port, WHOIS).
     */
    public function runAllChecks(string $url): array
    {
        return [
            'ip_info' => $this->checkIpInfo($url),
            'ping' => $this->checkPing($url),
            'ping_global' => $this->checkPingGlobal($url),
            'http' => $this->checkHttp($url),
            'dns' => $this->checkDns($url),
            'redirect' => $this->checkRedirect($url),
            'tcp_port' => $this->checkTcpPort($url),
            'whois' => $this->checkWhois($url),
        ];
    }
}
