<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesignationRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:designations',
        ];
        
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['title'] = 'required|string|max:255|unique:designations,title,' . $this->designation->id;
        }
        
        return $rules;
    }
}
