@component('components.fields.text', [
    'label'    => $label,
    'name'     => $name,
    'class'    => $class ?? null,
    'optional' => $optional ?? false,
    'type'     => 'password',
])
@endcomponent
