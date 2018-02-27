@if(count($errors) > 0)
<section class="errors">
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</section>
@endif