@if (count($errors)>0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ Session::get('success') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p>{{ session('fail') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


