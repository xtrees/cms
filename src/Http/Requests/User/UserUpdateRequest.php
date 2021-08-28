<?php

namespace XTrees\CMS\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:20|min:2',
            'sex' => [
                'required',
                Rule::in([-1, 0, 1]),
            ],
            'phone' => 'string|size:11|nullable'
        ];
    }
}
