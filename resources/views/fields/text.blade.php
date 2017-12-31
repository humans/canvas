<div class="field {{ $name }} {{ $errors->has($name) ? 'has-error' : null }} [ {{ $utilities ?? null }} ]">
    <label for="{{ $name }}" class="field-label [ block mb-1 text-sm font-semibold ]">
        {{ $label }}
        @if($optional ?? false)
            <small class="field-optional">(optional)</small>
        @endif
    </label>

    <input id="{{ $name }}"
           class="field-input [ w-full py-2 px-1 ]"
           type="{{ $type ?? 'text' }}"
           name="{{ $name }}" value="{{ old($name, $value ?? null) }}"
           placeholder="{{ $placeholder ?? null }}">

    @if($errors->has($name))
        <p class="field-message">{{ $errors->get($name)[0] }}</p>
    @endif
</div>
