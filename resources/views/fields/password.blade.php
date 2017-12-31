@component('fields.text', [
    'label'     => $label,
    'name'      => $name,
    'utilities' => $utilities ?? null,
    'optional'  => $optional ?? false,
    'type'      => 'password',
])
@endcomponent
