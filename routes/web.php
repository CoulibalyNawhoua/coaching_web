<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\OffresAbonnementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CitationController;
use App\Http\Controllers\categories_ticketController;
use App\Http\Controllers\categories_citationController;
use App\Http\Controllers\categorie_abonnementController;
use App\Http\Controllers\periode_abonnementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::middleware('auth')->group(function () {                          

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('users', UsersController::class);
    Route::post('delete-user', [UsersController::class, 'delete_user']);
    Route::get('liste-inscrits', [UsersController::class, 'listUserInscrits'])->name('liste.inscrits');

    Route::resource('roles', RolesController::class);
    Route::post('delete-role', [RolesController::class, 'delete_role']);
    // Route::post('test', [RolesController::class, 'test']);

    Route::resource('categories_citations', categories_citationController::class);
    Route::post('delete-categorie', [categories_citationController::class, 'delete_categorie']);

    Route::resource('citations', CitationController::class);
    Route::post('delete-citation', [CitationController::class, 'delete_citation']);
    Route::post('total-citation-publie', [CitationController::class, 'countCitationsPubliees']);

    Route::resource('evenements', EventsController::class);
    Route::post('delete-evenement', [EventsController::class, 'delete_evenement']);

    Route::resource('categories_tickets', categories_ticketController::class);
    Route::post('delete-CategoriesTickets', [categories_ticketController::class, 'delete_CategorieTicket']);

    Route::resource('tickets', TicketController::class);
    Route::get('get-dates/{eventId}', [TicketController::class, 'getDatesByEvent']);
    Route::post('delete-ticket', [TicketController::class, 'delete_ticket']);
    Route::get('liste-ticket-vendus', [TicketController::class, 'listTicketsVendus'])->name('liste.ticket.vendu');

    // Route::get('liste-inscrits', InscriptionController::class, 'c')->name('liste.inscrits');

    Route::resource('periodes_abonnements', periode_abonnementController::class);
    Route::post('delete-PeriodesAbonnements', [periode_abonnementController::class, 'delete_periode']);

    Route::resource('categories_abonnements', categorie_abonnementController::class);
    Route::post('delete-CategoriesAbonnements', [categorie_abonnementController::class, 'delete_abonnement']);

    Route::resource('offres_abonnements',OffresAbonnementController::class);
    Route::post('delete-Offre', [OffresAbonnementController::class, 'delete_offre']);

    Route::resource('abonnements', AbonnementController::class);
    Route::post('delete-abonnement', [AbonnementController::class, 'delete_abonnement']);

    Route::get('liste-abonnees', [AbonnementController::class, 'ListeAbonne'])->name('liste.abonnees');
    Route::get('liste-paiements', [AbonnementController::class, 'ListePaiement'])->name('liste.paiements');
    // Route::resource('paiements', PaiementController::class);


    Route::get('admin_profile', [ProfileController::class, 'index_profile'])->name('profile.admin');
    Route::get('edit_profile', [ProfileController::class, 'edit_profile'])->name('profile.edit');
    Route::put('profil-update', [ProfileController::class, 'update_profile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
