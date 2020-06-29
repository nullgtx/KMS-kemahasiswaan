<?php

namespace App\Http\Requests\Admin\Admins;

use Illuminate\Foundation\Http\FormRequest;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminsUpdate extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->admin->user->id,
            'password' => 'nullable|confirmed|min:5',
            'name' => 'required',           
            'position' => 'required',
            'level' => ($this->admin->user->id==Auth::user()->id) ? 'nullable':'required|in:'.Admin::ADMIN_LEVEL_ADMIN.','.Admin::ADMIN_LEVEL_OPERATOR,
            'active' => ($this->admin->user->id==Auth::user()->id) ? 'nullable':'required|in:'.User::USER_IS_ACTIVE.','.User::USER_IS_NOT_ACTIVE,
            'photo' => 'nullable|image|max:2048',
        ];
    }
}
