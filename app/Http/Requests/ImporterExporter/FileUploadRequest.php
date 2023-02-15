<?php

namespace App\Http\Requests\ImporterExporter;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
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
            'imgUpload1'  => 'required|mimes:xls,xlsx,pdf|max:2048'
        ];
    }
}
