<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchStudentRequest extends FormRequest
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
            'class' => 'nullable',
            // 'subject' => 'nullable|required_without:class,location,budget',
            // 'location' => 'nullable|required_without:subject,class,budget',
            // 'budget' => 'nullable|required_without:subject,location,class',
        ];
    }
}
