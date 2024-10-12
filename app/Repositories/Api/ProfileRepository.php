<?php

namespace App\Repositories\Api;


use App\Models\Inscription;
use App\Repositories\Repository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileRepository extends Repository
{
    public function __construct(Inscription $model)
    {
        $this->model = $model;
    }

    // $validated = $request->validate([
    //     'password' => 'required|same:confirmpassword',
    // ]);
    // public function updatePassword(Request $request, $id)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required|string|min:5|confirmed|regex:/^[0-9]{5}$/',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 400);
    //     }
    //     $user = Inscription::find($id);
    //     if (!$user) {
    //         return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    //     }
    //     $user->update([
    //         'password' => Hash::make($request->password),
    //     ]);
    //     return response()->json(['message' => 'Mot de passe mis à jour avec succès']);
    // }

    public function updateUserProfile(Request $request, $id)
    {
        $user = Inscription::find($id);
        // $user = Auth::user()->id;
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
        ]);
        // $input = $request->all();
        // $user->update($input);

        $userData = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "adresse" => $request->adresse,
            "genre" => $request->genre,
            "edited_by" => $user->id,
            "edit_date" => Carbon::now(),
        ];
        $user->update($userData);
// return $request->url_photo;
        if ($request->url_photo) {
            $photo = $request->file('url_photo');
            $fileName = time() . '_' . $photo->getClientOriginalName();
            $path = $photo->storeAs('photos', $fileName, 'public');
            $url_photos = Storage::url($path);
            $user->url_photo = $url_photos;
            $user->save();
        }
        
        

        return response()->json([
            'user_infos' => $user,
            'message' => 'Mise a jour effectué avec succès',
        ]);
    }

    public function user()
    {
        // $user = Inscription::find($id);
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        
        return response()->json(['user_infos' => $user]);
    }
    public function updatePassword(Request $request, $id)
    {
        $user = Inscription::find($id);
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->validate([
            'password' => ['required', 'regex:/^[0-9]{5}$/'],
            'newpassword' => ['required', 'regex:/^[0-9]{5}$/','different:password'],
            'password_confirmation' => ['required', 'regex:/^[0-9]{5}$/','confirmed'],
        ]);
        
        // Vérification de l'ancien mot de passe
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Mot de passe incorrect'], 401);
        }
        
        // Mise à jour du mot de passe
        $user->password = Hash::make($request->newpassword);
        $user->save();

        return response()->json(['message' => 'Mot de passe mis à jour avec succès'], 200);
        // $input = $request->all();

        // $user = $this->model->find($id);

        // $user->update(['password' => Hash::make($input['new_password'])]);
    }





    // public function profileUsers()
    // {
    //     $users = Auth::user();

    //     $souscription = Souscription::where([
    //         ['id_inscription', $users->id],
    //         ['souscriptions.is_deleted', 0],
    //     ])
    //         ->leftjoin('abonnements', 'abonnements.id', '=', 'souscriptions.id_abonnement')
    //         ->select('abonnements.name', 'abonnements.prix_abonnements')
    //         ->get();

    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Profil récupérés avec succès',
    //         'users' => $users,
    //         'souscription' => $souscription,
    //     ]);

    // }
    // public function UpdateProfile($request, $id)
    // {
    //     $user = Auth::user();

    //     $validate = $request->validate([
    //         'phone' => 'digits:10|numeric',
    //     ]);

    //     if ($validate) {
    //         $path = $user->avatar_url;

    //         if ($request->hasFile('url_photo')) {
    //             $path = Storage::disk('public')->putFile('avatars', $request->file('url_photo'), 'public');
    //         } else {
    //             $user->url_photo = null;
    //         };

    //         $user->update([

    //             "first_name" => $request->first_name,
    //             "last_name" => $request->last_name,
    //             "phone" => $request->phone,
    //             "email" => $request->email,
    //             "url_photo" => $path,
    //             "adresse" => $request->adresse,
    //             "genre" => $request->genre,
    //             "id_pays" => $request->id_pays,
    //             "edited_by" => $user->id,
    //             "edit_date" => Carbon::now(),

    //         ]);

    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Mofdification éffectuée avec succès',
    //             'data' => $user,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 401,
    //             'message' => 'Echec de la modification ; veiller réessayer',
    //             'data' => $user,
    //         ]);
    //     }

    //     // dd($user);

    // }

}
