<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:3|max:150',
            'lastName' => 'required|string|min:3|max:150',
            'dniPassport' => 'required|string|min:9|max:9|unique:guests,dniPassport,'.$this->route('guest.id'),
            'email' => 'required|email|max:255|unique:guests,email,'.$this->route('guest.id'),
            'phone' => 'required|string|min:9|max:9|unique:guests,phone,'.$this->route('guest.id'),
            'checkInDate' => 'required|date',
            'checkOutDate' => 'required|date|after:checkInDate',
        ];
    }
}
