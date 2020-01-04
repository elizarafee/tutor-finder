<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorRequest extends FormRequest
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
            'bio' => 'required',
            'gender' => 'required',
            'year_of_birth' => 'required|numeric|digits:4',
            'profile' => 'nullable|image|max:1024',
            'proof_of_id' => 'required|image|max:2048',
            'subjects' => 'required',
            'areas' => 'required',
            'years' => 'required',
            'salary' => 'required|numeric',
            'mobile' => 'required|numeric|digits:10',
            'level' => 'required',
            'subject' => 'required',
            'institute' => 'required',
            'status' => 'required',
            'proof_of_doc' => 'required|image|max:2048',
            'note' => 'nullable',
        ];
    }
}
