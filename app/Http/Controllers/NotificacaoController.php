<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacaoController extends Controller
{


    public function index()
    {
        return view('system.notificacao.index');
    }

    /**
     * Função responsável por salvar token do browser do usuário
     */
    public function saveToken()
    {

        $token = $_POST['token'];
        $date = Carbon::now();

        $insertDevice = DB::table('devices')->insertGetId(
            ['token' => $token, 'created_at' => $date]
        );

        return response()->json("Alert: token salvo com sucesso!", 200);
    }

    /**
     * Função reponsável por enviar notificação para usuário inscrito
     */
    public function sendNotify(Request $request)
    {
        $httpCode = 500;

        $tokens = DB::table('devices')->selectRaw('token')->get();

        foreach ($tokens as $token) {

            $fields = [
                "to" => $token->token,
                "data" => [
                    "body" => $request['mensagem'],
                    "title" => "Dicio Programming"
                ]
            ];

            $response = $this->FcmSendCurl($fields);
        }

        if ($response) {
            $success = true;
            $httpCode = 200;
        }

        return response()->json(compact('success'), $httpCode);
    }


    /**
     * Função reponsável por executar ação de envio da notificação
     */
    private function FcmSendCurl($fields)
    {

        $fields = json_encode($fields);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => array(
                "Authorization: key=AAAAihfuCBw:APA91bGdIagmEWQ2WlG6Lg-mAV_mqlb4iPudBtRqgeYYLCJnpR6oD0PEz950G3BR-Dple-PbmPPWmD2UEPaLpU2XKWYjmAw72ylwCd949O_rit5TUgwV6dYqBroiFUyrnBJbVoQ8gQ2M",
                "Content-Type: application/json",
                "Host: fcm.googleapis.com"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

    }


}
