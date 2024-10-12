<?php

namespace App\Repositories;


use Carbon\Carbon;
use App\Models\Inscription;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ConnexionRequest;
use App\Http\Requests\InscriptionRequest;
use App\Models\Abonnement;
use App\Models\OffreAbonnement;
use App\Models\Souscription;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class InscriptionRepository extends Repository
{
    public function __construct(Inscription $model)
    {
        $this->model = $model;
    }
    public function Inscription(InscriptionRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:inscriptions',
            'password' => [
                'required',
                'confirmed',
                'regex:/^[0-9]{5}$/',
            ],
            'password_confirmation' => ['required', 'regex:/^[0-9]{5}$/'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Echec de la validation',
                'errors' => $validator->errors(),
            ], 422);
        } else {
            try {

                $utilisateurs = Inscription::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'add_date' => Carbon::now(),
                    'password' => Hash::make($request->password),
                    'password_confirmation' => Hash::make($request->password_confirmation),
                ]);

                return response()->json(
                    [
                        'message' => 'Votre inscription a été effectuée avec succès',
                        'inscription' => $utilisateurs
                    ],
                    201
                );
            } catch (\Throwable $th) {
                return response()->json([
                    'message' => 'Votre inscription a échoué',
                ], 422);
            }
        }
    }
    public function signup(ConnexionRequest $request)
    {
        $request->validated();
        $user = Inscription::where('phone', $request->phone)->first();

        try {

            if (!$user || (!Hash::check($request->password, $user->password))) {

                return response()->json([
                    'message' => 'Vos identifiants sont incorrects',
                ], 422);
            } else {

                $token = $user->createToken('api');
                $expirationTime = now()->addMinutes(60);
                $person = PersonalAccessToken::findToken($token->plainTextToken);

                if ($person) {
                    $person->forceFill(['expires_at' => $expirationTime])->save();
                }

                $abonnementInfo = $this->checkAbonnement($user->id);

                return response()->json([
                    'message' => 'Connexion effectuée avec succès',
                    'user_info' => $user,
                    'access_token' => $token->plainTextToken,
                    'expires_at' => $expirationTime,
                    'abonnement_info' => $abonnementInfo,
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Une erreur est survenue lors de la connexion.',
            ], 500);
        }
    }

    public function checkAbonnement($user)
    {
        $souscription = Souscription::where('id_inscription', $user)
            ->where('status', 1)
            ->first();

        if (!$souscription) {
            return [];
        }
        $abonnement = Abonnement::join('periode_abonnement', 'abonnements.id_dure_abonnement', '=', 'periode_abonnement.id')
            ->where('abonnements.id', $souscription->id_abonnement)
            ->select('abonnements.id', 'abonnements.libelle', 'abonnements.prix_abonnements', 'periode_abonnement.periode')
            ->first();

        if (!$abonnement) {
            return response()->json(['message' => 'Abonnement introuvable'], 404);
        }

        // Récupérer les offres liées à cet abonnement
        $offres = OffreAbonnement::join('details_abonnements', 'offres_abonnements.id', '=', 'details_abonnements.id_offre')
            ->where('details_abonnements.id_abonnement', $abonnement->id)
            ->select('offres_abonnements.offres')
            ->get();

        return [
            'abonnement' => $abonnement,
            'abonnement_offres' => $offres,
        ];
    }

    public function userInscrits()
    {
        $userInscrits = Inscription::all()->count();
        return $userInscrits;
        
    }
    public function listUserInscrits()
    {
        $userInscrits = Inscription::OrderBy('add_date','DESC')->get();
        return $userInscrits;
    }

  
}

