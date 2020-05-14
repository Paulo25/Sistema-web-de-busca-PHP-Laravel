<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\resetPassword;
use App\Usuario;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function sendNewPassword(Request $request)
    {

        if ($request->ajax) {
            $email = $request->email;
            $user = Usuario::where('email', $email)->first();

            if ($user == null) {
                return response()->json(
                    ['title' => 'Registro inexistente', 'text' => 'Não a registro com o email informado.', 'status' => 'error']
                    , 200);
            }

            $randomPassword = str_random(8);
            $user->senha = bcrypt($randomPassword);

            Mail::to($user->email)->send(new resetPassword($user->nome, $randomPassword));

            return response()->json(
                ['title' => 'Senha alterada', 'message' => 'Sua nova senha foi enviada para o email cadastrado.','status' => 'success']
                , 200);
        }
    }
}
