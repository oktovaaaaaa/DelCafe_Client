@props(['message'])

@if($message)
    <div class="d-flex justify-content-center">
        <div class="alert alert-success alert-dismissible fade show col-lg-11 rounded-3 shadow-sm" role="alert">
            <strong>Notification:</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
