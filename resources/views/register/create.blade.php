@extends('layouts.app')

@push('scripts')
<script>
    window.App.whisper = "{{ $whisper }}"
</script>

<script src="{{ mix('js/register.js') }}"></script>
@endpush

@section('content')
    <register-form-wizard email="{{ $email }}" 
        :errors="{{ $errors }}" 
        :old="{{ json_encode(old()) }}">
    </register-form-wizard>
@endsection
