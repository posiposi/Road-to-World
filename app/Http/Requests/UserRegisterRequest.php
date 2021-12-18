<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'tel' => 'required | numeric | digits_between:10,11',
            'name' => 'required | string | max:255',
            'nickname' => ['required', 'string', 'max:255'],
            'email' => 'required | string | email | max:255',
            'password' => 'required | string | min:8',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => '名前を入力してください。',
            'name.max' => '名前は255文字以内で入力してください。',
            'nickname.required' => 'ニックネームを入力してください。',
            'nickname.max' => 'ニックネームは255文字以内で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは最低8文字必要です。',
            'tel.required' => '電話番号を入力してください。',
            'tel.numeric' => '電話番号は半角数字、ハイフン無しで入力してください。',
            'tel.digits_between' => '電話番号は10文字、または11文字で入力してください。',
        ];
    }
}
