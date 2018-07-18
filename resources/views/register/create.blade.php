@extends('layouts.app')

@push('scripts')
<script src="{{ mix('js/register.js') }}"></script>
@endpush

@section('content')
    <register-form email="{{ $email }}" errors="{{ $errors }}">
        <section class="registration">
            <div class="wrapper [ max-w-sm mt-8 ]">
                @partial('register.email-confirmation')

                @partial('register.user-profile')
            </div>
        </section>
    </register-form>
@endsection
