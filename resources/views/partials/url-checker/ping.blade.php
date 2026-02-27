@if($result['success'] ?? false)
<div class="table-responsive">
    <table class="table table-bordered">
        <tr><th width="200">Host</th><td>{{ $result['host'] }}</td></tr>
        <tr><th>Port</th><td>{{ $result['port'] }}</td></tr>
        <tr><th>Latency</th><td><strong>{{ $result['latency_ms'] }} ms</strong></td></tr>
        <tr><th>Status</th><td><span class="badge bg-success">Reachable</span></td></tr>
    </table>
</div>
@else
<div class="table-responsive">
    <table class="table table-bordered">
        <tr><th width="200">Host</th><td>{{ $result['host'] ?? '-' }}</td></tr>
        <tr><th>Port</th><td>{{ $result['port'] ?? '-' }}</td></tr>
        <tr><th>Latency</th><td>{{ $result['latency_ms'] ?? '-' }} ms</td></tr>
        <tr><th>Status</th><td><span class="badge bg-danger">Unreachable</span> — {{ $result['error'] ?? 'Host tidak terjangkau' }}</td></tr>
    </table>
</div>
@endif
