<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Company;
use App\Domains\Auth\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Class UsersTable.
 */
class UsersTable extends DataTableComponent
{
    /**
     * @var
     */
    public $status;

    /**
     * @var array|string[]
     */
    // public array $sortNames = [
    //     'email_verified_at' => 'Verified',
    //     'two_factor_auth_count' => '2FA',
    // ];

    /**
     * @var array|string[]
     */
    // public array $filterNames = [
    //     'type' => 'User Type',
    //     'verified' => 'E-mail Verified',
    // ];

    /**
     * @param  string  $status
     */
    public function mount($status = 'active'): void
    {
        $this->status = $status;
    }

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        $query = User::with('roles', 'twoFactorAuth')
        ->withCount('twoFactorAuth');

        if ($this->status === 'deleted') {
            $query = $query->onlyTrashed();
        } elseif ($this->status === 'deactivated') {
            $query = $query->onlyDeactivated();
        } else {
            $query = $query->onlyActive();
        }
        return $query
            ->when($this->getFilter('search'), fn ($query, $search) => $query->where(DB::raw("CONCAT(first_name, ' ', middle_name, ' ', last_name)"), 'like', '%'.$search.'%'));
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return [
            'type' => Filter::make('User Type')
                ->select([
                    '' => 'Any',
                    User::TYPE_ADMIN => 'Administrators',
                    User::TYPE_COMPANY_ADMIN => 'Company Administrators',
                    User::TYPE_USER => 'Users',
                ]),
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->sortable(),
            Column::make(__('Name'))
                ->sortable(function(Builder $query, $direction) {
                    return $query->select(["*", DB::raw("CONCAT(first_name, ' ', last_name) AS full_name")])->orderBy('full_name', $direction);
                }),
            Column::make(__('Company'), 'company.name')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Company::select('name')->whereColumn('companies.id', 'users.company_id'), $direction);
                }),
            Column::make(__('E-mail'), 'email')
                ->sortable(),
            Column::make(__('Mobile Phone'), 'phone')
                ->sortable(),
            Column::make(__('Address'), 'address.number')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Address::select(DB::raw("CONCAT(number, ' ', street_name, ' ', apt_or_unit) AS address_string"))->whereColumn('users.id', 'addresses.user_id'), $direction);
                }),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.auth.user.includes.row';
    }
}
