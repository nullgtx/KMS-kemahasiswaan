<?php

namespace App\Http\Requests\Member\Knowledge;

use Illuminate\Foundation\Http\FormRequest;
use App\Knowledge;

class KnowledgeStore extends FormRequest
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
            'level' => 'required|in:'.Knowledge::KATEGORI_BEASISWA.','.Knowledge::KATEGORI_PKM,
            'image' => 'required|mimes:pdf|max:10000',
        ];
    }
}
