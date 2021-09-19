<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * バリデーションエラーメッセージ
     */
     
    protected $messages = [
        'name.required' => '名前を入力してください。',
        'name.max' => '名前は255文字以内で入力してください。',
        'email.required' => 'メールアドレスを入力してください。',
        'email.email' => '正しいメールアドレスを入力してください。',
        'email.max' => 'メールアドレスは255文字以内で入力してください。',
        'email.unique' => 'そのメールアドレスはすでに登録されています。',
        'password.required' => 'パスワードを入力してください。',
        'password.min' => 'パスワードは最低8文字必要です。',
        'password.confirmed' => '入力されたパスワードが一致しません。',
        'tel.required' => '電話番号を入力してください。',
        'tel.numeric' => '電話番号は数字で入力してください。',
        'tel.digits_between' => '電話番号は10文字、あるいは11文字で入力してください。',
    ];
    
    /**
     * バリデーションルール
     */
     
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        //'image' => ['required'], //登録画面に画像フォームはないがバリデーション必須？
        'tel' => ['required', 'numeric', 'digits_between:10,11'],
    ];
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
     //バリデーション
    protected function validator(array $data)
    {
        return Validator::make($data, $this->rules, $this->messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tel' => $data['tel'],
        ]);
    }
}
