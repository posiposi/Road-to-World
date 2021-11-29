<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BikeRegisterRequest extends FormRequest
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
            'brand' => 'required',
            'name' => 'required',
            'status' => 'required',
            'bike_address' => 'required',
            'image_path' => 'required | file | image | dimensions:max_width=1500,max_height=1500',
            'price' => 'required | numeric',
        ];
    }
    
    public function messages()
    {
        return [
            'brand.required' => 'ブランド名を入力してください。',
            'name.required' => 'バイク名を入力してください。',
            'status.required' => '保管状態を入力してください。',
            'bike_address.required' => '受け渡し場所を入力してください。',
            'price.required' => '料金を入力してください。',
            'price.numeric' => '料金は数値で入力してください。',
            'image_path.required' => '画像を選択してください。',
            'image_path.dimensions' => '画像サイズは1,500×1,500が上限となります。',
        ];
    }
}
