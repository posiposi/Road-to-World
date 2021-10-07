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
            'end_date_time' => 'after:start_date_time',
            'start_date_time' => 'after:now',
        ];
    }
    
    public function messages()
    {
        return [
            'start_date.required' => '開始日は必須です。',
            'start_time.required' => '開始時間は必須です。',
            'end_date.required' => '終了日は必須です。',
            'end_time.required' => '終了時間は必須です。',
            'end_date_time.after' => '終了日時は開始日時より後日を指定してください。',
            'start_date_time.after' => '開始日時は現在時刻よりも後日を指定してください。',
        ];
    }
    
    protected function prepareForValidation()
    {
        $start_date_time = ($this->filled(['start_date', 'start_time'])) ? $this->start_date .' '. $this->start_time : '';
        $end_date_time = ($this->filled(['end_date', 'end_time'])) ? $this->end_date .' '. $this->end_time : '';
        $this->merge([
           'start_date_time' => $start_date_time,
           'end_date_time' => $end_date_time,
        ]);
    }
}