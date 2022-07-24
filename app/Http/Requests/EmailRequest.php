<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'from' => 'required|string|max:250',
            'recipient' => 'array|required|max:250',
            'recipient.*.to' => 'required|string|max:250',
            'subject' => 'required|string|max:250',
            'text_content' => 'required',
            'html_content' => 'nullable',
            'file' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'from.required' => 'The sender field cannot be empty',
            'to.required' => 'The recipient field cannot be empty'
        ];
    }
}
