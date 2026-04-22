<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => trim($this->email),
            'country_code' => $this->country_code ? trim($this->country_code) : null,
            'phone' => $this->phone ? preg_replace('/[^0-9]/', '', $this->phone) : null,
            'subject' => trim($this->subject),
            'message' => trim($this->message),
            'recaptcha' => $this->recaptcha ? trim($this->recaptcha) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'country_code' => 'nullable|string|max:10',
            'phone' => 'nullable|digits_between:7,15',
            'subject' => 'required|string|max:160',
            'message' => 'required|string|min:10|max:3000',
            'recaptcha' => 'nullable|string|max:4096',
        ];
    }
}