<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateWebsiteRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'website_url' => 'required|unique:websites,website_url',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "Website name is required.",
            'website_url.required' => "Website url is required.",
            'website_url.unique' => "Website url must be unique.",

        ];
    }
}
