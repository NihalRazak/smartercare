<?php

namespace App\Domains\Auth\Http\Requests\Backend\User;

use App\Domains\Auth\Rules\UnusedPassword;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;
use Illuminate\Validation\Rules\Password;

/**
 * Class UpdateUserPasswordRequest.
 */
class UpdateUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ! ($this->user->isMasterAdmin() && ! $this->user()->isMasterAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => array_merge(
                [
                    'max:100',
                    Password::min(16)->mixedCase()->letters()->symbols(),
                    new UnusedPassword((int) $this->segment(4)),
                ],
                PasswordRules::changePassword($this->email)
            ),
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException(__('Only the administrator can change their password.'));
    }
}
