<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class CompaniesTable.
 */
class CompaniesTable extends DataTableComponent
{

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return Company::query()
            ->when($this->getFilter('search'), fn ($query, $search) => $query->where('name', 'like', '%'.$search.'%'));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('Default Provider'))
                ->sortable(),
            Column::make(__('Status'))
                ->sortable(),
            Column::make(__('Actions'))
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.auth.company.includes.row';
    }
}
