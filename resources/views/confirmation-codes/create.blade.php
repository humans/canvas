@extends('layouts.app')

@section('content')
    <div class="wrapper [ max-w-sm py-8 ]">
        <h1>Join {{ config('app.name') }}.</h1>

        <p class="[ text-grey-darker ]">@lang('messages.please_confirm_your_email_address')</p>

        <form class="[ flex flex-col ]" action="{{ route('confirmation-codes.store') }}" method="POST">
            @csrf

            @textfield([
                'label' => 'Email Address',
                'name'  => 'email',
                'class' => 'mt-4',
            ])

            <button class="button button-primary [ mt-4 ml-auto ]">Confirm</button>
        </form>
    </div>
@endsection
