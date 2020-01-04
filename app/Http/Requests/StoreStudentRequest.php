<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'picture' => 'nullable|image|max:1024',
            'proof_of_id' => 'required|image|max:2048',
            'location' => 'required',
            'budget' => 'required|numeric',
            'mobile' => 'required|numeric|digits:10',
            'bio' => 'required',
            'gender' => 'required',
            'year_of_birth' => 'required|numeric|digits:4',
            'class' => 'required',
            'institute' => 'required',
            'subjects' => 'required',
            'requirements' => 'nullable',
        ];
    }
}
