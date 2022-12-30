<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\BaseApiFormRequest;

class RoleUpdateRequest extends BaseApiFormRequest
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
            'name' => 'required|max:255|unique:roles,name,' . $this->role,
            'display_name' => 'required|max:255',
            'permissions_id' => 'required|array|min:1',
            'permissions_id.*' => 'required|integer|min:1'
        ];
    }
}
