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
            'experiences.*.from' => 'nullable|max:'.date('y').'|required_with:experiences.*.detail|regex:/^[0-9]+$/',
            'experiences.*.to' => 'nullable|max:'.date('y').'|required_with:experiences.*.detail|regex:/^[0-9]+$/',
            'experiences.*.detail' => 'required_with:experiences.*.date|max:200',
            'educations.*.from' => 'nullable|max:'.date('y').'|required_with:experiences.*.detail|regex:/^[0-9]+$/',
            'educations.*.to' => 'nullable|max:'.date('y').'|required_with:experiences.*.detail|regex:/^[0-9]+$/',
            'educations.*.detail' => 'required_with:experiences.*.date|max:200',
            'achievements.*.date' => 'nullable|regex:/^[0-9]+$/',
            'achievements.*.detail' => 'required_with:experiences.*.date|max:200',
            'skills.*.skill' => 'max:20|required_with:skills.*.value',
            'skills.*.value' => 'nullable|required_with:skill.*.date|max:5|min:0',
            'socials.*' => 'nullable|url',
            'about_me' => 'max:1000',
            'phone' => 'nullable|max:15|min:8|regex:/^[0-9]+$/',
        ];
    }

    public function prepareForValidation()
    {
        $experiences = array_map(function ($item) {
            $item['from'] = ltrim($item['from'], '0');
            $item['to'] = ltrim($item['to'], '0');
            return $item;
        }, array_values($this->experiences));

        $educations = array_map(function ($item) {
            $item['from'] = ltrim($item['from'], '0');
            $item['to'] = ltrim($item['to'], '0');
            return $item;
        }, array_values($this->educations));

        $achievements = array_map(function ($item) {
            $item['date'] = ltrim($item['date'], '0');
            return $item;
        }, array_values($this->achievements));
        $skills = array_values($this->skills);

        $this->merge([
            'experiences' => $experiences,
            'educations' => $educations,
            'achievements' => $achievements,
            'skills' => $skills,
        ]);
    }
}
