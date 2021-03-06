<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalRequest extends FormRequest
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
            'topic' => 'required|string|max:200',
            'start_time' => 'required|date|after_or_equal:yesterday',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'priority' => 'nullable|numeric|lte:5|gte:0',
            'agenda' => 'string|max:20|nullable',
            'description' => 'required|string|max:2000|min:5',
            'remind_update' => 'nullable',
            'is_pin' => 'nullable',
            'progress' => 'lte:100|gte:0',
            'status' => 'nullable',
        ];
    }
}
