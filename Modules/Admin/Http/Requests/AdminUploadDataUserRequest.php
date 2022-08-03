<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUploadDataUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file_data' => 'file|mimes:xlsx,csv,txt'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'file_data' => ''
        ];
    }

    public function messages()
    {
        return [
            'file_data.required' => 'ファイルを 選択してください',
            'file_data.mimes' => ' xlsx, csvタイプのファイルを指定してください'
        ];
    }
}
