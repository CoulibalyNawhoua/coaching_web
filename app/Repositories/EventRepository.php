<?php

namespace App\Repositories;


use Carbon\Carbon;
use App\Models\DateEvent;
use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class EventRepository extends Repository
{
    public function __construct(Evenement $model)
    {
        $this->model = $model;
    }
    public function getDate()
    {
        date_default_timezone_set('Africa/Abidjan');
        return date_format(date_create(date('Ymd H:i:s')), 'Ymd H:i:s');
    }
    public function StoreEvent(Request $request)
    {
        if ($request->hasFile('url_images')) {
            $file = $request->file('url_images');
            $path = $file->storeAs('public/events', $file->getClientOriginalName());
            $url_images = Storage::url($path);
        } 
        else {
            $url_images = "events/debora.jpeg";
        }

        $evenements = Evenement::create([
            'titles' => $request->titles,
            'descriptions' => $request->descriptions,
            'url_images' => $url_images,
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);

        $date_evenements = $request->input('date_evenement');
        $heure_evenements = $request->input('heure_evenement');
        $adresse_events = $request->input('adresse_event');

        for ($i = 0; $i < count($date_evenements); $i++) {

            DateEvent::create([
                'id_events' => $evenements->id,
                'date_evenement' => $date_evenements[$i],
                'heure_evenement' => $heure_evenements[$i],
                'adresse_event' => $adresse_events[$i],
                'added_by' => Auth::user()->id,
                'add_date' => Carbon::now(),
            ]);
        }
        return $evenements;

    }
    public function ListeEvenement()
    {
        return Evenement::with('user')->where('is_deleted', 0)->orderBy('add_date', 'DESC')->get();
    }

    public function DetailsEvent($id)
    {
        $evenement = $this->model->find($id);
        $details = DateEvent::where([
            ['dates_evenements.id_events', '=', $evenement->id],
            ['dates_evenements.is_deleted', '=', 0],
        ])
            ->leftJoin('evenements', 'evenements.id', '=', 'dates_evenements.id_events')
            ->leftJoin('users', 'users.id', '=', 'dates_evenements.added_by')
            ->select('evenements.titles', 'evenements.adresse_event', 'evenements.add_date', 'evenements.descriptions', 'evenements.id', 'users.first_name', 'users.last_name', 'users.email', 'dates_evenements.date_evenement', 'dates_evenements.heure_evenement', 'evenements.url_images')
            ->get();
        return $details;
    }

    public function update_evenement($request, $id)
    {
        $evenement = $this->model->find($id);

        $imagePath = null;

        if ($request->hasFile('url_images')) {
            $file = $request->file('url_images');
            $path = $file->storeAs('public/events', $file->getClientOriginalName());
            $imagePath = Storage::url($path);
        }

        $evenement->titles = $request->titles;
        $evenement->adresse_event = $request->adresse_event;
        $evenement->url_images = $imagePath;
        $evenement->descriptions = $request->descriptions;
        $evenement->edited_by = Auth::user()->id;
        $evenement->edit_date = Carbon::now();
        $evenement->save();

        // Récupère les dates soumises sous forme de tableau associatif
        $date_evenement = $request->input('date_evenement');
        $heure_evenement = $request->input('heure_evenement');
        $id_date = $request->input('id_date');


        for ($i = 0; $i < count($date_evenement); $i++) {

            $dateEvt = DateEvent::where('id', $id_date[$i])->first();

            if (is_null($dateEvt)) {
                DateEvent::create([
                    'id_events' => $evenement->id,
                    'date_evenement' => $date_evenement[$i],
                    'heure_evenement' => $heure_evenement[$i],
                    'added_by' => Auth::user()->id,
                    'add_date' => Carbon::now(),
                ]);
            } else {

                $dateEvt->update([
                    'date_evenement' => $date_evenement[$i],
                    'heure_evenement' => $heure_evenement[$i],
                    'edited_by' => Auth::user()->id,
                    'edit_date' => Carbon::now(),
                ]);
            }
        }
        return $evenement;

       
    }

    public function delete_evenement($id)
    {
        $evenement = $this->model->find($id);
        $evenement->is_deleted = 1;
        $evenement->deleted_by = Auth::user()->id;
        $evenement->delete_date = Carbon::now();
        $evenement->save();
    }

    public function nbreEvent()
    {
        $totalEvent = Evenement::OrderBy('add_date','DESC')
            ->where([
                ['evenements.is_deleted', 0],
            ])
            ->count();
        return $totalEvent;
    }

}