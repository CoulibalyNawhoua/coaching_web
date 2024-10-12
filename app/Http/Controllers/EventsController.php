<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EventRepository;

class EventsController extends Controller
{

    private $eventRepository;
    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
        $evenements = $this->eventRepository->ListeEvenement();
        
        return view('admin.pages.events.index', compact('evenements'));
    }
    

    public function create()
    {
        return view('admin.pages.events.create');
    }
    public function store(Request $request)
    {
        $data = $this->eventRepository->StoreEvent($request);
        // dd($data);
        return redirect('/evenements')->with('success', 'Enregistrement effectué avec succès!');
    }
    public function edit(string $id)
    {
        $evenement = $this->eventRepository->edit($id);
        return view('admin.pages.events.edit', compact('evenement'));
    }
    public function update(Request $request, string $id)
    {
        $this->eventRepository->update_evenement($request, $id);
        return redirect('/evenements')->with('success', 'Modification effectuée avec succès!');
    }

    public function delete_evenement(Request $request)
    {
        $id = $request->evenement_id;
        $this->eventRepository->delete_evenement($id);

        return response()->json($id);
    }
    public function show(string $id){
        $detail = $this->eventRepository->DetailsEvent($id);
        // dd($details);
        return view('admin.pages.events.details',compact('detail'));
    }
}
