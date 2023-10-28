<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Comment;
use Illuminate\Contracts\Validation\Validator;

class SendRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'message' => [new Comment]
        ];
    }

    public function message(): string
    {
        return $this->input('message');
    }

    protected function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator);
    }
}
