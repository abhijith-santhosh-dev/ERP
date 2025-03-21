<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */


    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|string|min:8|confirmed',
            'contact_number' => 'required|string|max:20',
            'alternative_contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'designation_id' => 'required|exists:designations,id',
        ];
        
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->user->id;
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }
        
        return $rules;
    }
}
