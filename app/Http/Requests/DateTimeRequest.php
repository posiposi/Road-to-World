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
            'start_date_time' => ['after:now', 'before:end_date_time', 'required'],
            'end_date_time' => ['after:now', 'after:start_date_time', 'required'],
        ];
    }
    
    public function messages()
    {
        return [
            'start_date_time.after' => '開始日時は現在時刻よりも後を指定してください。',
            'start_date_time.before' => '開始日時は終了日時以前を指定してください。',
            'end_date_time.after' => '終了日時は正しい時間を指定してください。',
            'start_date_time.required' => '開始日を指定してください',
            'end_date_time.required' => '終了日を指定してください',
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