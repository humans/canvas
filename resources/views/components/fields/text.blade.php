<div class="field {{ $name }} {{ $errors->has($name) ? 'has-error' : null }} [ {{ $class ?? null }} ]">
    <label for="{{ $name }}" class="field-label [ block mb-1 font-semibold ]">
        {{ $label }}
        @if($optional ?? false)
            <small class="field-optional">(optional)</small>
        @endif
    </label>

    <input id="{{ $name }}"
           class="field-input [ w-full py-2 px-1 border rounded ]"
           type="{{ $type ?? 'text' }}"
           name="{{ $name }}" value="{{ old($name, $value ?? null) }}"
           placeholder="{{ $placeholder ?? null }}"

           @if($model ?? false)
                v-model="{{ $model }}"
           @endif
           >

    @if($errors->has($name))
        <p class="field-message">{{ $errors->get($name)[0] }}</p>
    @endif
</div>
