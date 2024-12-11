<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->employee, 'email'), 
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique('users', 'phone')->ignore($this->employee, 'phone'), 
            ],
            'password'=> 'required',
            'salary' => 'required|numeric|min:1',
            'role_id' => 'required|integer|exists:roles,id',
            'department_id' => 'required|integer|exists:departments,id',
            'manager_id' => 'nullable|integer|exists:users,id',
            'avatar' => 'nullable|image|max:2048',
        ];
    }
}
