<div class="container-fluid mb-3">
    @if ($message = Session::get('primary'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{--            <i class="mdi mdi-bullseye-arrow mr-2"></i> --}}
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($message = Session::get('secondary'))
        <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            {{--            <i class="mdi mdi-grease-pencil mr-2"></i> --}}
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{--            <i class="mdi mdi-check-all mr-2"></i> --}}
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @php($message = Session::get('danger'))
    @if (!$message && isset($errors) && !empty($errors->first()))
        @php($message = $errors->first())
    @endif
    @if ($message)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{--            <i class="mdi mdi-block-helper mr-2"></i> --}}
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{--            <i class="mdi mdi-alert-outline mr-2"></i> --}}
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
            {{--            <i class="mdi mdi-alert-circle-outline mr-2"></i> --}}
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>

