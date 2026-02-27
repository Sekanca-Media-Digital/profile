@if($result['success'] ?? false)
<p><strong>Host:</strong> {{ $result['host'] }} | <strong>WHOIS Server:</strong> {{ $result['whois_server'] }}</p>
<pre class="bg-light p-3 rounded small" style="max-height: 400px; overflow-y: auto; white-space: pre-wrap;">{{ $result['raw'] }}</pre>
@else
<div class="alert alert-danger">{{ $result['error'] ?? 'Gagal mengecek WHOIS' }}</div>
@endif
