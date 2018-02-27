@extends('layouts.app')

@section('content')
    <div class="wrapper">
        <h1>Home</h1>

        <p class="[ text-grey-darker text-sm ]">
            Hey <strong v-html="user.name"></strong>! This part is a small demo of Laravel Passport working out of the box.
        </p>
    </div>
@endsection
