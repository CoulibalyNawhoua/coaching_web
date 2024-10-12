<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CitationController;
use App\Http\Controllers\Api\FavoriesController;
use App\Http\Controllers\Api\EvenementController;
use App\Http\Controllers\Api\AbonnementController;
use App\Http\Controllers\Api\InscriptionController;
use App\Http\Controllers\Api\AchatsTicketsController;
use App\Http\Controllers\Api\RestaurePasswordController;
use App\Http\Controllers\Api\CategorieCitationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('inscription', [InscriptionController::class, 'register']);
Route::post('/signup', [InscriptionController::class, 'signup']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('checkAbonnement', [InscriptionController::class, 'checkAbonnement']);

    Route::get('citations', [CitationController::class, 'listeCitations']);
    Route::get('citations/categorie/{id}', [CitationController::class,'CitationsCategorie']);

    Route::get('categories/citations', [CategorieCitationController::class, 'categorieCitations']);
    
    Route::get('evenements', [EvenementController::class, 'ListeEvenement']);
    Route::get('details/evenements/{id}', [EvenementController::class, 'detailsEvenements']);
    
    Route::get('tickets/{dateId}',[TicketController::class, 'listeTickets']);
    Route::post('verifie/ticket',[TicketController::class, 'verifyTicketQuantity']);
    Route::post('achats/ticket', [TicketController::class, 'AchatsTickets']);
    Route::put('paiements/{paiementId}/{achatTicketId}/update-status', [TicketController::class, 'updateStatus']);
    Route::get('details-ticket',[TicketController::class, 'detailsTicket']);
    Route::get('paiements/{paiementId}/ticket',[AchatsTicketsController::class, 'getTicket']);

    Route::get('abonnements', [AbonnementController::class, 'ListeAbonnement']);
    Route::get('abonnements/{abonID}', [AbonnementController::class, 'DetailsAbonnement']);
    Route::post('souscription',[AbonnementController::class, 'SouscriptionAbonnement']);
    Route::put('paiementAbon/{paiementId}/{souscriptionId}/update-status',[AbonnementController::class, 'updateStatus']);
    Route::get('verifier-abonnement',[AbonnementController::class, 'verifierAbonnement']);
    Route::get('utilisateur-abonnement',[AbonnementController::class, 'userAbonnement']);
    Route::get('acces-utilisateur',[AbonnementController::class, 'getAccesUtilisateur']);
    Route::put('annuler-abonnement/{abonnementId}',[AbonnementController::class, 'annulerAbonnement']);
    

    Route::post('user-profile-update/{id}', [ProfileController::class, 'updateUserProfile']);
    Route::get('user', [ProfileController::class, 'userInfos']);
    Route::post('like',[FavoriesController::class, 'likes']);
    Route::get('restaure/password',[RestaurePasswordController::class, 'RestaurePassword']);
    Route::get('update/password', [RestaurePasswordController::class, 'UpdatePassword']);
    Route::get('deconnexion', [InscriptionController::class, 'logout']);

});
