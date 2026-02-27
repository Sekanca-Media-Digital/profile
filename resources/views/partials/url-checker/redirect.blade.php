@if($result['success'] ?? false)
<div class="table-responsive">
    <table class="table table-bordered">
        <tr><th width="200">Original URL</th><td>{{ $result['original_url'] }}</td></tr>
        <tr><th>Final URL</th><td>{{ $result['final_url'] }}</td></tr>
        <tr><th>Redirect Count</th><td>{{ $result['redirect_count'] }}</td></tr>
    </table>
</div>
@if(!empty($result['chain']))
    <h6>Redirect Chain</h6>
    <ol class="list-group list-group-numbered">
        @foreach($result['chain'] as $step)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">{{ $step['url'] }}</div>
                </div>
                <span class="badge bg-{{ $step['status_code'] == 200 ? 'success' : 'primary' }} rounded-pill">{{ $step['status_code'] }}</span>
            </li>
        @endforeach
    </ol>
@endif
@else
<div class="alert alert-danger">{{ $result['error'] ?? 'Gagal mengecek redirect' }}</div>
@endif
