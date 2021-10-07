<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DateTimeRequest extends FormRequest
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
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_date' => 'required|date',
            'end_time' => 'required|date_format:H:i',
        ];
    }
    
    public function messages()
    {
        return [
            'start_date.required' => '開始日は必須です。',
            'start_time.required' => '開始時間は必須です。',
            'end_date.required' => '終了日は必須です。',
            'end_time.required' => '終了時間は必須です。',
        ];
    }
}
