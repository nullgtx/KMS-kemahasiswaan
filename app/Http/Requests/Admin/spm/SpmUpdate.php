<?php

namespace App\Http\Requests\Admin\Spm;

use Illuminate\Foundation\Http\FormRequest;
use App\Spm;

class SpmUpdate extends FormRequest
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
            'title' => 'required',
            'image' => 'mimes:pdf|max:10000',
        ];
    }
}
