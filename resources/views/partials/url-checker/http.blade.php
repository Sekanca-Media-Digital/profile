@if($result['success'] ?? false)
<div class="table-responsive">
    <table class="table table-bordered">
        <tr><th width="200">URL</th><td>{{ $result['url'] }}</td></tr>
        <tr><th>Status Code</th><td><span class="badge bg-{{ $result['status_code'] == 200 ? 'success' : ($result['status_code'] >= 400 ? 'danger' : 'primary') }}">{{ $result['status_code'] }}</span></td></tr>
        <tr><th>Response Time</th><td>{{ $result['response_time_ms'] }} ms</td></tr>
        @if($result['content_length'] ?? null)
            <tr><th>Content Length</th><td>{{ $result['content_length'] }}</td></tr>
        @endif
    </table>
</div>
@if(!empty($result['headers']))
    <h6 class="mt-3">Headers</h6>
    <pre class="bg-light p-3 rounded small" style="max-height: 300px; overflow-y: auto;"><code>@foreach($result['headers'] as $k => $v){{ $k }}: {{ $v }}
@endforeach</code></pre>
@endif
@else
<div class="alert alert-danger">{{ $result['error'] ?? 'Gagal mengecek HTTP' }}</div>
@endif
