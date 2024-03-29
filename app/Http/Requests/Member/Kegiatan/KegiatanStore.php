<?php

namespace App\Http\Requests\Member\Kegiatan;

use Illuminate\Foundation\Http\FormRequest;
use App\Kegiatan;

class KegiatanStore extends FormRequest
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
            'image' => 'required|mimes:pdf|max:10000',
        ];
    }
}
