<?php

namespace App\Domains\Auth\Http\Requests\Backend\User;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class StoreUserRequest.
 */
class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required', Rule::in([User::TYPE_ADMIN, User::TYPE_COMPANY_ADMIN, User::TYPE_USER])],
            'first_name' => ['required', 'max:100'],
            'middle_name' => ['max:100'],
            'last_name' => ['required', 'max:100'],
            'email' => ['required', 'max:255', 'email', Rule::unique('users')],
            'address_number' => ['required'],
            'address_street_name' => ['required'],
            'apt_or_unit' => ['max:100'],
            'zip_code' => ['max:100'],
            'address_city' => ['required'],
            'address_state' => ['required'],
            'phone' => ['required', Rule::unique('users')],
            'company_id' => ['required'],
            'password' => ['max:100', PasswordRules::register($this->email)],
            'active' => ['sometimes', 'in:1'],
            'email_verified' => ['sometimes', 'in:1'],
            'send_confirmation_email' => ['sometimes', 'in:1'],
            // 'roles' => ['sometimes', 'array'],
            // 'roles.*' => [Rule::exists('roles', 'id')->where('type', $this->type)],
            // 'permissions' => ['sometimes', 'array'],
            // 'permissions.*' => [Rule::exists('permissions', 'id')->where('type', $this->type)],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            // 'roles.*.exists' => __('One or more roles were not found or are not allowed to be associated with this user type.'),
            // 'permissions.*.exists' => __('One or more permissions were not found or are not allowed to be associated with this user type.'),
        ];
    }
}
