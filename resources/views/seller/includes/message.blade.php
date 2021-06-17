@if (count($errors)>0)
    <div class="alert alert-danger" data-notify="container">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
            <i class="material-icons">close</i>
        </button>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" data-notify="container">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
            <i class="material-icons">close</i>
        </button>
        <span data-notify="message">{{ Session::get('success') }}</span>
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger" data-notify="container">
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
            <i class="material-icons">close</i>
        </button>
        <span data-notify="message">
            {{ session('fail') }}
        </span>
    </div>
@endif
