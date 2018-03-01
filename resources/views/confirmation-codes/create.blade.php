<h1>Join {{ config('app.name') }}</h1>

<p>Please confirm your email address first.</p>

<form action="{{ route('confirmation-codes.store') }}" method="POST">
    @csrf

    <input name="email" type="text">

    <button>Confirm</button>
</form>

