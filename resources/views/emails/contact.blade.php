@component('mail::message')
    <div>
        <p><strong>Name:</strong> {{ $request->name }}</p>
        <p><strong>Email:</strong> {{ $request->email }}</p>
        <p><strong>Message:</strong> {{ $request->description }}</p>
    </div>

    {{ config('app.name') }}
@endcomponent
