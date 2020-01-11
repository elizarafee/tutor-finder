<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTutorRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'bio' => 'required',
            'gender' => 'required',
            'year_of_birth' => 'required|numeric|digits:4',
            'picture' => 'nullable|image|max:1024',
            'proof_of_id' => 'nullable|image|max:2048',
            'subjects' => 'required',
            'locations' => 'required',
            'years' => 'required',
            'salary' => 'required|numeric',
            'mobile' => 'required|numeric|digits:10',
            'level' => 'required',
            'subject' => 'required',
            'institute' => 'required',
            'status' => 'required',
            'proof_of_doc' => 'nullable|image|max:2048',
            'note' => 'nullable',
        ];
    }
}
