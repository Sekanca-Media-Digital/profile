@if($result['success'] ?? false)
<div class="table-responsive">
    <table class="table table-bordered">
        <tr><th width="200">Host</th><td>{{ $result['host'] }}</td></tr>
        <tr><th>IP Address</th><td><code>{{ $result['ip'] }}</code></td></tr>
        @if($result['country'] ?? null)
            <tr><th>Country</th><td>{{ $result['country'] }} @if($result['country_code'] ?? null)<span class="badge bg-secondary">{{ $result['country_code'] }}</span>@endif</td></tr>
        @endif
        @if($result['region'] ?? null)<tr><th>Region</th><td>{{ $result['region'] }}</td></tr>@endif
        @if($result['city'] ?? null)
            <tr><th>City</th><td>{{ $result['city'] }}@if($result['zip'] ?? null) ({{ $result['zip'] }})@endif</td></tr>
        @endif
        @if($result['timezone'] ?? null)<tr><th>Timezone</th><td>{{ $result['timezone'] }}</td></tr>@endif
        @if($result['isp'] ?? null)<tr><th>ISP</th><td>{{ $result['isp'] }}</td></tr>@endif
        @if($result['org'] ?? null)<tr><th>Organization</th><td>{{ $result['org'] }}</td></tr>@endif
        @if($result['as'] ?? null)<tr><th>AS</th><td><code>{{ $result['as'] }}</code></td></tr>@endif
    </table>
</div>
@else
<div class="alert alert-warning">{{ $result['error'] ?? 'Tidak dapat mengambil info IP.' }}</div>
@endif
