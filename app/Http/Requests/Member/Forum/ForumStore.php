<?php

namespace App\Http\Requests\Member\Forum;

use Illuminate\Foundation\Http\FormRequest;
use App\Forum;

class ForumStore extends FormRequest
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
            'content' => 'required',
            'level' => 'required|in:'.Forum::KATEGORI_BEASISWA.','.Forum::KATEGORI_PKM.','.Forum::KATEGORI_TAK.','.Forum::KATEGORI_ASURANSI.','.Forum::KATEGORI_KEGIATAN,
        ];
    }
}
