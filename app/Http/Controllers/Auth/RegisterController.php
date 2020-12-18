<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller {

    use RegistersUsers;

    protected $redirectTo = '/statements';

    public function __construct() {

        $this->middleware('guest');
    }

    protected function validator(array $data) {

        $email      = '/([A-Z0-9._%+-]{1,})+@([A-Z0-9._%+-]{1,})+\.([A-z]{2,})$/i';
        $password   = '/^(?=.*[\p{Ll}])(?=.*[\p{Lu}])(?=.*\d)[\p{Ll}\p{Lu}\d#$@!%&*?]{8,30}$/u';
        $messages   = [
            'password.regex'    => 'Пароль должен содержать хотя бы одну цифру,<br>одну строчную и одну заглавную букву<br>(от 8 до 30 символов).',
            'email.regex'       => 'Пожалуйста, проверьте адрес электронной почты.',
            'email.unique'      => 'Данный адрес электронной почты уже используется.'
        ];

        $rules = [
            'email'     => ['required', 'string', 'max:256', 'unique:users', 'regex:'.$email],
            'password'  => ['required', 'string', 'regex:'.$password]
        ];

        return Validator::make($data, $rules, $messages);
    }

    protected function create(array $data) {

        return User::create([
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);
    }

    public function postRegistration(Request $request) {

        $submit = $request->all();
        $validator = $this->validator($submit);

        if($validator->fails())
            return $validator->messages();

        if($this->create($submit))
            return '{"href": "/home"}';
        else return '{"error": "Что-то пошло не так..."}';
    }
}
