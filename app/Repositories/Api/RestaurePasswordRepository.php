<?php

namespace App\Repositories\Api;

use Carbon\Carbon;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Models\RestaurePassword;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;




class RestaurePasswordRepository extends Repository
{
    public function __construct(Inscription $model)
    {
        $this->model = $model;
    }

    public function restore_password(Request $request)
    {
        $user = Inscription::where('phone', $request->phone)->first();
        // $phone = Inscription::check($request->phone, $users->phone);
        if ($user) {

            $code = mt_rand(100000, 999999);

            $reset_mot_passe = RestaurePassword::create([
                "code" => $code,
                "phone" => $user->phone,
                "added_by" => auth()->user()->id,
                "add_date" => Carbon::now(),
            ]);


            if ($reset_mot_passe) {

                $smsResult = $this->sendSMS("0759745108", $code);

                if ($smsResult) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Un code a été envoyé à votre numéro de téléphone.',
                    ]);
                } else {
                    return response()->json([
                        'status' => 500,
                        'message' => 'Une erreur est survenue lors de l\'envoi du SMS.',
                    ]);
                }
            } else {

                return response()->json([
                    'status' => 500,
                    'message' => 'Une erreur est survenue lors de la génération du code.',
                ]);
            }

        } else {
            return response()->json([
                'status' => 401,
                'message' => 'ce numero de téléphone n\'existe pas',
            ]);
        }

    }
    public function restoreupdate_password(Request $request)
    {
        $reset_entry = RestaurePassword::where([
            "code" => $request->code,
        ])
            ->orderBy('add_date', 'desc')
            ->first();

        if (!$reset_entry) {
            return response()->json([
                'status' => 401,
                'message' => 'Le code est incorrect ou a expiré.',
            ]);
        } else {

            $user = Inscription::where('phone', $reset_entry->phone)->first();

            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Utilisateur non trouvé.',
                ]);
            }

            $user->update([
                'password' => Hash::make($request->password, [
                    'rounds' => 12,
                ]),

            ]);
            // Supprimer l'entrée de réinitialisation de mot de passe
            $reset_entry->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Votre mot de passe a été mis à jour avec succès.',
            ]);
        }
    }


    function sendSMS($phoneNumber, $Message)
    {

        $username = '0758914811';

        $password = '7828';

        $url = "https://api.smscloud.ci/v1/campaigns";

        $indicatif = "225";


        $data = array('sender' => 'MOTIVATION', 'content' => $Message, 'dlrUrl' => '', 'recipients' =>['225'.$phoneNumber]);

        $authorization = "Authorization: Bearer 9IoAKlIevjcBQVssxajHb5wkN2I1NoIbT0v";

        $postdata = json_encode($data);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $result = curl_exec($ch);

        curl_close($ch);


        $_message_logs = "The sms plateform sent sms to " . json_encode($phoneNumber) . " and return this code " . $result;
        return $result;

    }

}
