@if($result['success'] ?? false)
<p><strong>Host:</strong> {{ $result['host'] }}</p>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Lokasi (Negara, Kota)</th>
                <th>Status</th>
                <th>Waktu (ms)</th>
                <th>Target IP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($result['rows'] ?? [] as $row)
            <tr>
                <td>
                    <span class="badge bg-light text-dark me-1">{{ strtoupper($row['country_code']) }}</span>
                    {{ $row['location'] }}
                </td>
                <td>
                    @if(($row['status'] ?? '') === 'OK')
                        <span class="badge bg-success">OK</span>
                    @elseif(($row['status'] ?? '') === 'TIMEOUT')
                        <span class="badge bg-warning text-dark">TIMEOUT</span>
                    @elseif(($row['status'] ?? '') === 'MALFORMED')
                        <span class="badge bg-secondary">MALFORMED</span>
                    @else
                        <span class="badge bg-secondary">{{ $row['status'] ?? '—' }}</span>
                    @endif
                </td>
                <td>
                    @if(isset($row['time_ms']))
                        <strong>{{ number_format($row['time_ms']) }}</strong> ms
                    @else
                        —
                    @endif
                </td>
                <td><code>{{ $row['target_ip'] ?? '—' }}</code></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-warning">{{ $result['error'] ?? 'Tidak dapat mengambil ping dari berbagai lokasi.' }}</div>
@endif
