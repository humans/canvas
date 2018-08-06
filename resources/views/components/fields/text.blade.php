<div class="field {{ $name }} {{ $errors->has($name) ? '-errors' : null }} [ {{ $class ?? null }} ]">
    <label for="{{ $name }}" class="label [ block mb-1 font-semibold ]">
        {{ $label }}
        @if($optional ?? false)
            <small class="optional">(optional)</small>
        @endif
    </label>

    <input id="{{ $name }}"
           class="input"
           type="{{ $type ?? 'text' }}"
           name="{{ $name }}" value="{{ old($name, $value ?? null) }}"
           placeholder="{{ $placeholder ?? null }}"

           @if($model ?? false)
                v-model="{{ $model }}"
           @endif
           >

    @if($errors->has($name))
        <p class="message">{{ $errors->get($name)[0] }}</p>
    @endif
</div>
