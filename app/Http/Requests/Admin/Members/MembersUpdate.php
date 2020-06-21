<?php

namespace App\Http\Requests\Admin\Members;

use Illuminate\Foundation\Http\FormRequest;

class MembersUpdate extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.$this->member->user->id,
            'password' => 'nullable|confirmed|min:5',
            'name' => 'required',
            'nim' => 'required|unique:members,nim,'.$this->member->id,
            'photo' => 'nullable|image|max:2048',
        ];
    }
}
