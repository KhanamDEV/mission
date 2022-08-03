<?php

namespace Modules\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissionBaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'mission_name' => 'required|string|max:255',
            'mission_detail' => 'required',
            'mission_thumbnail' => 'required|mimes:jpeg,bmp,png,jpg|max:2048',
            'time_required' => 'required',

            'feedback_title' => 'required|string|max:255',
            'feedback_detail' => 'required',
            'feedback_thumbnail' => 'required|mimes:jpeg,bmp,png,jpg|max:2048',
            'feedback_hint_title' => 'required|string|max:255',
            'feedback_hint_detail' => 'required',
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
            'mission_name.max' => 'タイトルは255文字以下にしてください',
            'mission_thumbnail.required' => 'イメージをアップロードしてください',
            'feedback_thumbnail.required' => 'イメージをアップロードしてください'
        ];
    }

}
