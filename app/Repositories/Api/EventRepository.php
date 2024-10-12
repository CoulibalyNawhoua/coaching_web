<?php

namespace App\Repositories\Api;


use App\Models\Evenement;
use App\Repositories\Repository;

class EventRepository extends Repository
{

    public function __construct(Evenement $model)
    {
        $this->model = $model;
    }
    public function ListeEvenement()
    {
        $evenements = Evenement::with('datesEvenement')->where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
        $eventData = [];
        foreach ($evenements as $evenement) {
            $eventData[] = [
                'id' => $evenement->id,
                // Convertir en entier
                'titre' => $evenement->titles,
                'url_image' => $evenement->url_images,
                'premiere_date' => $evenement->premiereDate,
                'derniere_date' => $evenement->derniereDate,
                'heure_premiere_date' => $evenement->heurePremiereDate,
                'heure_derniere_date' => $evenement->heureDerniereDate,
            ];
        }
        return response()->json($eventData);
    }
    public function DetailsEvent($eventID)
    {
        $evenements = Evenement::with([
            'datesEvenement:id,id_events,date_evenement,heure_evenement,adresse_event,add_date',
            'tickets:id,id_events,added_by,add_date,status,quantite_tickets,taux_reduction'
        ])
        ->select('id', 'titles', 'descriptions', 'url_images')
        ->where([
            ['id', $eventID],
            ['is_deleted', 0],
        ])
        ->orderBy('add_date', 'DESC')
        ->first();
    
        return response()->json([$evenements]);
    }
}