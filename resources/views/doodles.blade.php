@extends('layouts.app')

@section('content')
    @component('forms.field', [
        'name'  => 'email',
        'label' => 'Email address',
    ])
    @endcomponent
@endsection
