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
        $query = Company::select("*");
        return $query;
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Name'))
                ->sortable(),
            Column::make(__('Status'))
                ->sortable(function ($builder, $direction) {
                    return $builder->orderBy('status', $direction);
                }),
            Column::make(__('IsPaid'))
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
