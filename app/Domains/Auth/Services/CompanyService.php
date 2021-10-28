<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Models\Company;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class CompanyService.
 */
class CompanyService extends BaseService
{
    /**
     * CompanyService constructor.
     *
     * @param  Company  $company
     */
    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    /**
     * @param  array  $data
     *
     * @return Company
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Company
    {
        DB::beginTransaction();

        try {
            $company = $this->createCompany([
                'name' => $data['name'],
                'avatar' => $data['avatar'],
                'status' => isset($data['status']) ? $data['status'] : 1,
                'isPaid' => 0,
                'default_provider' => $data['default_provider']
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this company. Please try again.'));
        }

        DB::commit();

        return $company;
    }

    /**
     * @param  Company  $company
     * @param  array  $data
     *
     * @return Company
     * @throws \Throwable
     */
    public function update(Company $company, array $data = []): Company
    {
        DB::beginTransaction();

        try {
            $company->update([
                'name' => $data['name'],
                'avatar' => isset($data['avatar']) ? $data['avatar'] : $company->avatar,
                'status' => isset($data['status']) ? $data['status'] : $company->status,
                'default_provider' => isset($data['default_provider']) ? $data['default_provider'] : $company->default_provider
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__($e->getMessage()));
        }

        DB::commit();

        return $company;
    }

    /**
     * @param  Company  $company
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Company $company): bool
    {
        if ($company->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this company. Please try again.'));
    }
    
    /**
     * @param  Company  $user
     * @param $status
     *
     * @return Company
     * @throws GeneralException
     */
    public function mark(Company $company, $status): Company
    {
        DB::beginTransaction();

        try {
            $company->update([
                'status' => $status
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__($e->getMessage()));
        }

        DB::commit();

        return $company;
    }

    /**
     * @param  array  $data
     *
     * @return Company
     */
    protected function createCompany(array $data = []): Company
    {
        return $this->model::create([
            'name' => $data['name'] ?? null,
            'status' => $data['status'] ?? 1,
            'isPaid' => 0,
            'default_provider' => $data['default_provider'] ?? null
        ]);
    }
}
