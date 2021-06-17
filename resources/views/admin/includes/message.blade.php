@if (count($errors)>0)
    <div class="alert alert-danger alert-with-icon" data-notify="container">
        <i class="material-icons" data-notify="icon">notifications</i>
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
            <i class="material-icons">close</i>
        </button>
        <span data-notify="message">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </span>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-with-icon" data-notify="container">
        <i class="material-icons" data-notify="icon">notifications</i>
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
            <i class="material-icons">close</i>
        </button>
        <span data-notify="message">{{ Session::get('success') }}</span>
    </div>
@endif

@if (session('fail'))
    <div class="alert alert-danger alert-with-icon" data-notify="container">
        <i class="material-icons" data-notify="icon">notifications</i>
        <button type="button" aria-hidden="true" data-dismiss="alert" class="close">
            <i class="material-icons">close</i>
        </button>
        <span data-notify="message">
            {{ session('fail') }}
        </span>
    </div>
@endif
