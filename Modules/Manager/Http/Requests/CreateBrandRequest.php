<?php

namespace Modules\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrandRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail_url' => 'required|mimes:jpg,jpeg,png',
            'name' => 'required|max:255',
            'detail' => 'required',
            'email' => 'required|unique:brands|email',
            'password' => 'required|min:8'
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
            'thumbnail_url' => ''
        ];
    }

    public function messages()
    {
        return [
            'name.max' => '企業名は255文字以下にしてください',
            'thumbnail_url.required' => 'イメージを選択してください',
            'email.unique' => 'このメールアドレスはすでに登録されています'
        ];
    }
}
