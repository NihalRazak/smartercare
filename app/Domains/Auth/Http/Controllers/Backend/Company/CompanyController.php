<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Domains\Auth\Services\CompanyService;
use App\Domains\Auth\Models\Company;

/**
 * Class CompanyController.
 */
class CompanyController
{
    /**
     * @var CompanyService
     */
    protected $companyService;

    /**
     * UserController constructor.
     *
     * @param  CompanyService  $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.company.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.company.create');
    }

    /**
     * @param  Request  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $file = $request->file('avatar');
        $data = $request->post();
        if (isset($file)) {
            $filename = uniqid() . '.' . $file->clientExtension();
            Storage::disk('public')->putFileAs('img/company', $file, $filename);
            $data['avatar'] = "/img/company/$filename";
        }
        $user = $this->companyService->store($data);

        return redirect()->route('admin.auth.company.show', $user)->withFlashSuccess(__('The company was successfully created.'));
    }

    /**
     * @param  Company  $company
     *
     * @return mixed
     */
    public function show(Company $company)
    {
        return view('backend.auth.company.show')
            ->withCompany($company);
    }

    /**
     * @param  Request  $request
     * @param  Company  $company
     *
     * @return mixed
     */
    public function edit(Request $request, Company $company)
    {
        return view('backend.auth.company.edit')
            ->withCompany($company);
    }

    /**
     * @param  Request  $request
     * @param  Company  $company
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(Request $request, Company $company)
    {
        $file = $request->file('avatar');
        $data = $request->post();
        if (isset($file)) {
            $filename = uniqid() . '.' . $file->clientExtension();
            Storage::disk('public')->putFileAs('img/company', $file, $filename);
            $data['avatar'] = "/img/company/$filename";
        }
        $this->companyService->update($company, $data);

        return redirect()->route('admin.auth.company.show', $company)->withFlashSuccess(__('The company was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Company  $company
     * @param $status
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function mark(Request $request, Company $company, $status)
    {
        $this->companyService->mark($company, (int) $status);

        return redirect()->route('admin.auth.company.index')->withFlashSuccess(__('The company was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Company  $company
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Request $request, Company $company)
    {
        $this->companyService->destroy($company);

        return redirect()->route('admin.auth.company.index')->withFlashSuccess(__('The company was successfully deleted.'));
    }
}
