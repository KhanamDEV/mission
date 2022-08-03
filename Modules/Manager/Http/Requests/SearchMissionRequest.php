<?php

namespace Modules\Manager\Http\Requests;

use App\Rules\MissionBaseRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SearchMissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $missionBaseId = DB::table('mission_bases')->pluck('id')->toArray();
        return [
            'mission_id' => ['required', 'integer', 'min:0', 'not_in:0', Rule::in($missionBaseId)],
            'day' => 'integer|required|min:0|not_in:0'
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
            'mission_id' => '',
            'day' => ''
        ];
    }

    public function messages()
    {
        return [
            'mission_id.in' => 'こちらのIDは存在していないません',
            'mission_id.not_in' => 'こちらのIDは存在していないません'
        ];
    }
}
