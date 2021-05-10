<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonAnswer;
use App\Http\Token;
use App\Models\GoodcarePortfolio;
use App\Models\GoodcareUser;
use App\Models\GoodcareUserToken;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $content = json_decode($request->getContent());
        $login = $content->login;
        $email = $content->email;
        $password = $content->password;
        if (empty($login) || empty($email) || empty($password))
            return response()->json(
                new JsonAnswer(
                    0,
                    'Invalid sign up data',
                    null,
                    0
                ));

        $user = GoodcareUser::where('login','=',$login)->first();
        if(!is_null($user))
            return response()->json(
                new JsonAnswer(
                    0,
                    'Login is already used',
                    null,
                    0
                ));

        $user = GoodcareUser::where('email','=',$email)->first();
        if(!is_null($user))
            return response()->json(
                new JsonAnswer(
                    0,
                    'e-mail is already used',
                    null,
                    0
                ));

        $user = new GoodcareUser();
        $user->login = $login;
        $user->email = $email;

        $options = [
            'cost' => 11
        ];
        $user->password = password_hash($password, PASSWORD_BCRYPT, $options);

        if ($user->save()) {
            $portfolio = new GoodcarePortfolio();
            $portfolio->name = "default";
            $portfolio->cost = 0;
            $portfolio->currency = 0;
            $portfolio->user_id = $user->id;
            $portfolio->save();

            return response()->json(
                new JsonAnswer(
                    1,
                    'User created successfully',
                    null,
                    0
                ));
        } else
            return response()->json(
                new JsonAnswer(
                    0,
                    'can\'t create new user',
                    null,
                    0
                ));
    }

    public function signIn(Request $request)
    {
        $content = json_decode($request->getContent());
        $login = $content->login;
        $password = $content->password;

        $user = GoodcareUser::where([
            ['login', '=', $login],
        ])->first();

        $message = 'Invalid login or password';
        $code = 0;
        if ($user && password_verify($password, $user->password)) {
            $code = 1;
            $message = Token::get($user->id, $user->login, 600);
        }

        return response()->json(
            new JsonAnswer(
                $code,
                $message,
                null,
                0
            ));
    }

    public function getUserData(Request $request)
    {
        $userId = $request->input('userId');
        $user = GoodcareUser::where('id', '=', $userId)->first();
        if (is_null($user)) return response()->json(new JsonAnswer(
            0,
            'internal authorization Error'
        ));

        return response()->json(
            new JsonAnswer(
                1,
                'Hello, ' . $user->login,
                [
                    'username' => $user->login,
                    'money' => 777
                ]
            ));
    }
}


