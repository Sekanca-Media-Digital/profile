@if($result['success'] ?? false)
<p><strong>Host:</strong> {{ $result['host'] }}</p>
<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead><tr><th>Port</th><th>Service</th><th>Status</th></tr></thead>
        <tbody>
        @foreach($result['ports'] ?? [] as $p)
            <tr>
                <td><code>{{ $p['port'] }}</code></td>
                <td>{{ $p['service'] }}</td>
                <td>@if($p['open'])<span class="badge bg-success">Open</span>@else<span class="badge bg-secondary">Closed</span>@endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
