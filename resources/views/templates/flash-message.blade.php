@php
    $flashKeys = ['success', 'error', 'warning', 'info']
@endphp

@foreach($flashKeys as $flashKey)
    @if (session($flashKey))
        <div class="alert alert-{{ $flashKey }} alert-dismissible fade show" role="alert">
            <strong>{{ session($flashKey) }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

