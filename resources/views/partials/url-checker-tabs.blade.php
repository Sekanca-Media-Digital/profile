@php
    $activeTab = $activeTab ?? 'ip_info';
    $tabs = [
        ['key' => 'ip_info', 'tab_id' => 'ipinfo-tab', 'pane_id' => 'ipinfo-pane', 'label' => 'IP Info', 'slug' => 'ip-info'],
        ['key' => 'ping', 'tab_id' => 'ping-tab', 'pane_id' => 'ping-pane', 'label' => 'Ping', 'slug' => 'ping'],
        ['key' => 'ping_global', 'tab_id' => 'ping-global-tab', 'pane_id' => 'ping-global-pane', 'label' => 'Ping Global', 'slug' => 'ping-global'],
        ['key' => 'http', 'tab_id' => 'http-tab', 'pane_id' => 'http-pane', 'label' => 'HTTP', 'slug' => 'http'],
        ['key' => 'dns', 'tab_id' => 'dns-tab', 'pane_id' => 'dns-pane', 'label' => 'DNS', 'slug' => 'dns'],
        ['key' => 'redirect', 'tab_id' => 'redirect-tab', 'pane_id' => 'redirect-pane', 'label' => 'Redirect', 'slug' => 'redirect'],
        ['key' => 'tcp_port', 'tab_id' => 'tcpport-tab', 'pane_id' => 'tcpport-pane', 'label' => 'TCP Port', 'slug' => 'tcp-port'],
        ['key' => 'whois', 'tab_id' => 'whois-tab', 'pane_id' => 'whois-pane', 'label' => 'WHOIS', 'slug' => 'whois'],
    ];
@endphp
<ul class="nav nav-tabs nav flex-wrap mb-3" id="urlCheckTabs" role="tablist">
    @foreach($tabs as $t)
    <li class="nav-item" role="presentation">
        <a href="{{ route('url-checker.tab', $t['slug']) }}" class="nav-link {{ $activeTab === $t['key'] ? 'active' : '' }}" id="{{ $t['tab_id'] }}" data-bs-toggle="tab" data-bs-target="#{{ $t['pane_id'] }}" role="tab">{{ $t['label'] }}</a>
    </li>
    @endforeach
</ul>
<div class="tab-content" id="urlCheckTabContent">
    @foreach($tabs as $t)
    <div class="tab-pane fade {{ $activeTab === $t['key'] ? 'show active' : '' }}" id="{{ $t['pane_id'] }}" role="tabpanel">
        @if(isset($results[$t['key']]))
            @include('partials.url-checker.' . str_replace('_', '-', $t['key']), ['result' => $results[$t['key']]])
        @else
            <div class="url-check-loading text-muted small">
                @if($t['key'] === 'ping_global')Memeriksa dari berbagai negara...@else Memeriksa...@endif
            </div>
        @endif
    </div>
    @endforeach
</div>
