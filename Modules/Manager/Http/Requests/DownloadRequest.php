<?php

namespace Modules\Manager\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d');
        return [
            'team_id' => 'required|integer|min:0',
            'brand_id' => 'required|integer|min:0',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
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
