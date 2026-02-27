@if($result['success'] ?? false)
<p><strong>Host:</strong> {{ $result['host'] }}</p>
@foreach($result['records'] ?? [] as $type => $records)
    @if(!empty($records))
        <h6 class="mt-3">{{ $type }} Records</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead><tr><th>Value / Target</th><th>TTL</th></tr></thead>
                <tbody>
                @foreach($records as $r)
                    <tr>
                        <td><code>{{ $r['ip'] ?? $r['ipv6'] ?? $r['target'] ?? ($r['txt'] ?? json_encode($r)) }}</code></td>
                        <td>{{ $r['ttl'] ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endforeach
@endif
