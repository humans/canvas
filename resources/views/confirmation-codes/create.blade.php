@extends('layouts.app')

@section('content')
    <div class="wrapper [ max-w-sm mt-32 ]">
        <h1>Join {{ config('app.name') }}</h1>

        <p>Please confirm your email address first.</p>

        <form action="{{ route('confirmation-codes.store') }}" method="POST">
            @csrf

            @textfield([
                'label' => 'Email Address',
                'name'  => 'email',
                'utilities' => 'mt-8',
            ])

            <button class="button [ mt-16 ]">Confirm</button>
        </form>
    </div>
@endsection