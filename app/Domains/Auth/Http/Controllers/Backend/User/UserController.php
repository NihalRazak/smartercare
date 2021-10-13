<?php

namespace App\Domains\Auth\Http\Controllers\Backend\User;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Domains\Auth\Http\Requests\Backend\User\DeleteUserRequest;
use App\Domains\Auth\Http\Requests\Backend\User\EditUserRequest;
use App\Domains\Auth\Http\Requests\Backend\User\StoreUserRequest;
use App\Domains\Auth\Http\Requests\Backend\User\UpdateUserRequest;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Models\Company;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use App\Domains\Auth\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Domains\Auth\Http\Imports\UserImport;

/**
 * Class UserController.
 */
class UserController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @var RoleService
     */
    protected $roleService;

    /**
     * @var PermissionService
     */
    protected $permissionService;

    /**
     * UserController constructor.
     *
     * @param  UserService  $userService
     * @param  RoleService  $roleService
     * @param  PermissionService  $permissionService
     */
    public function __construct(UserService $userService, RoleService $roleService, PermissionService $permissionService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.auth.user.index');
    }

    public function import(Request $request)
    {
        $file = $request->file('census');
        DB::beginTransaction();

        try {
            Excel::import( new UserImport, $file );
        } catch (Exception $e) {

            DB::rollBack();

            throw new GeneralException(__('There was a problem loading the census file. Please try again.'));
        }
        DB::commit();
        
        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('The users were successfully imported.'));
    }

    public function download_template()
    {
        return Storage::disk('public')->download('census_template.xlsx');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        $companies = Company::where('status', 1)->get();
        return view('backend.auth.user.create')
            ->withCompanies($companies)
            ->withRoles($this->roleService->get())
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions());
    }

    /**
     * @param  StoreUserRequest  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());

        return redirect()->route('admin.auth.user.show', $user)->withFlashSuccess(__('The user was successfully created.'));
    }

    /**
     * @param  User  $user
     *
     * @return mixed
     */
    public function show(User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param  EditUserRequest  $request
     * @param  User  $user
     *
     * @return mixed
     */
    public function edit(EditUserRequest $request, User $user)
    {
        $companies = Company::where('status', 1)->get();
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withCompanies($companies)
            ->withRoles($this->roleService->get())
            ->withCategories($this->permissionService->getCategorizedPermissions())
            ->withGeneral($this->permissionService->getUncategorizedPermissions())
            ->withUsedPermissions($user->permissions->modelKeys());
    }

    /**
     * @param  UpdateUserRequest  $request
     * @param  User  $user
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($user, $request->validated());

        return redirect()->route('admin.auth.user.show', $user)->withFlashSuccess(__('The user was successfully updated.'));
    }

    /**
     * @param  DeleteUserRequest  $request
     * @param  User  $user
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        $this->userService->delete($user);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('The user was successfully deleted.'));
    }
}
