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
            'start_date_time' => 'required|after:now|before:end_date_time',
            'end_date_time' => 'required|after:now|after:start_date_time',
        ];
    }
    
    public function messages()
    {
        return [
            'start_date_time.required' => '予約開始日時を入力してください。',
            'start_date_time.after' => '予約開始時間は現在以後を指定してください。',
            'start_date_time.before' => '予約開始時間は終了日時以前を指定してください。',
            'end_date_time.required' => '予約終了日時を入力してください。',
            'end_date_time.after' => '予約終了日時は:attribute以降を指定してください。',
        ];
    }
    
    public function attributes()
    {
        return [
            'start_date_time' => '開始日時',
            'now' => '現在',
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