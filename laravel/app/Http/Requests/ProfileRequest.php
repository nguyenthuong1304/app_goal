<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'job' => 'required|max:100',
            'experiences.*.from' => 'nullable|date|before:tomorrow|required_with:experiences.*.detail',
            'experiences.*.to' => 'nullable|date|before:tomorrow|required_with:experiences.*.detail',
            'experiences.*.detail' => 'required_with:experiences.*.date|max:200',
            'educations.*.from' => 'nullable|date|before:tomorrow|required_with:experiences.*.detail',
            'educations.*.to' => 'nullable|date|before:tomorrow|required_with:experiences.*.detail',
            'educations.*.detail' => 'required_with:experiences.*.date|max:200',
            'achievements.*.from' => 'nullable|date|before:tomorrow|required_with:experiences.*.detail',
            'achievements.*.to' => 'nullable|date|before:tomorrow|required_with:experiences.*.detail',
            'achievements.*.detail' => 'required_with:experiences.*.date|max:200',
            'skills.*.skill' => 'max:20|required_with:skills.*.value',
            'skills.*.value' => 'nullable|required_with:skill.*.date|max:5|min:0',
            'socials.*' => 'nullable|url',
            'about_me' => 'max:1000',
        ];
    }

    public function passedValidation()
    {
        $this->experiences = array_values($this->experiences);
        $this->educations = array_values($this->educations);
        $this->achievements = array_values($this->achievements);
        $this->skills = array_values($this->skills);
    }
}
