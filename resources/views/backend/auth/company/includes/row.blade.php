@php
    $providers = [
        'All_Providers' => 'All Providers',
        'Aetna' => 'Aetna', 
        'Blue Shield' => 'Blue Cross',
        'Cigna' => 'Cigna',
        'Cofinity' => 'Cofinity',
        'Humana' => 'Humana',
        'Mecosta' => 'Mecosta',
        'PHCS' => 'PHCS',
        'United' => 'United Healthcare',
        'UMPC' => 'UMPC'
    ];
@endphp
<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $providers[$row->default_provider] }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.company.includes.status', ['company' => $row])
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @include('backend.auth.company.includes.actions', ['company' => $row])
</x-livewire-tables::bs4.table.cell>
