<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 認証不要なら true にする
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_num|min:4',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
            'building' => 'required|string',
            'phone_number' => [
                'required',
                'regex:/^(0[789]0\d{8})$/', // 携帯番号の正規表現（ハイフンなし）
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'そのメールアドレスは既に登録されています。',
            'password.alpha_num' => 'パスワードは半角英数字で入力してください。',
            'phone_number.regex' => '電話番号は正しい形式で入力してください（例：09012345678）。',
        ];
    }
}
