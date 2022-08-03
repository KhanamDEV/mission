<?php

namespace Modules\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProgramRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'thumbnail_url' => 'nullable|mimes:jpg,jpeg,png',
            'name' => 'required',
            'detail' => 'required',
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
}
