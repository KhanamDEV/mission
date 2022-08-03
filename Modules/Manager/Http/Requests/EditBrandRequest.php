<?php

namespace Modules\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:25',
            'detail' => 'required',
            'email' => 'required|email|unique:brands,email,'.request()->route('id'),
            'thumbnail_url' => 'mimes:jpg,jpeg,png',
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

    public function messages()
    {
        return [
            'name.max' => '企業名は255文字以下にしてください'
        ];
    }
}
