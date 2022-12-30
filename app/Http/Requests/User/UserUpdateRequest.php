<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseApiFormRequest;

class UserUpdateRequest extends BaseApiFormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user,
            'password' => 'nullable|string|min:6',
            'roles_id' => 'required|array|min:1',
            'roles_id.*' => 'required|integer|min:1',
            'permissions_id.*' => 'integer|min:1',
        ];
    }
}
