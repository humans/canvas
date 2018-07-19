@extends('layouts.app')

@push('scripts')
<script src="{{ mix('js/register.js') }}"></script>
@endpush

@section('content')
    <register-form-wizard email="{{ $email }}" :errors="{{ $errors }}">
    </register-form-wizard>
@endsection
