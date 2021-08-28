<?php

namespace XTrees\CMS\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserPasswordRequest extends FormRequest
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
            'old_password' => 'required|current_password',
            'password' => [
                'required', 'confirmed', Password::defaults()
            ],
        ];
    }

    protected function getRedirectUrl(): string
    {
        return parent::getRedirectUrl() .'#password-setting';
    }
}
