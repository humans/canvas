<div class="field {{ $name }} {{ $errors->has($name) ? 'has-error' : null }}">
    <label for="{{ $name }}" class="field-label [ block ]">
        {{ $label }}
        @if($optional ?? false)
            <small class="field-optional">(optional)</small>
        @endif
    </label>

    <input id="{{ $name }}"
           class="field-input"
           type="{{ $type ?? 'text' }}"
           name="{{ $name }}" value="{{ old($name, $value ?? null) }}"
           placeholder="{{ $placeholder ?? null }}">

    @if($errors->has($name))
        <p class="field-message">{{ $errors->get($name)[0] }}</p>
    @endif
</div>
