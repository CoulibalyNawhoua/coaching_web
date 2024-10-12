<?php

namespace App\Repositories;


use Carbon\Carbon;
use App\Models\Galerie;
use App\Models\Citation;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\CategorieCitation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RepositoryCitation extends Repository
{
    public function __construct(Citation $model)
    {
        $this->model = $model;
    }

    public function StoreCitation(Request $request)
    {
        $citation = Citation::create([
            'contenu' => $request->contenu,
            'id_categorie_citations' => $request->id_categorie_citations,
            'added_by' => Auth::user()->id,
            'add_date' => Carbon::now(),
        ]);
        // Traitez le fichier média et enregistrez-le dans la table "medias"

        if ($request->hasFile('fichiers')) {
            $fichiers = $request->file('fichiers');

            foreach ($fichiers as $fichier) {
                $extension = $fichier->getClientOriginalExtension();
                $destinationPath = '';

                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $destinationPath = 'images';
                } elseif (in_array($extension, ['mp4', 'mov'])) {
                    $destinationPath = 'videos';
                } elseif (in_array($extension, ['mp3'])) {
                    $destinationPath = 'audios';
                }

                $fileName = time() . '_' . $fichier->getClientOriginalName();
                $path = $fichier->storeAs('public/' . $destinationPath, $fileName);

                Galerie::create([
                    'id_citations' => $citation->id,
                    'url_medias' => $path,
                    'types_fichiers' => $extension,
                    'added_by' => Auth::user()->id,
                    'add_date' => Carbon::now(),
                ]);
            }
        }
        return $citation;
    }
    public function ListCategorie()
    {
        $citations = CategorieCitation::where('is_deleted', 0)->get();
        return $citations;
    }
    public function ListeCitation()
    {
        $citations = DB::select("SELECT citations.id, citations.contenu, citations.add_date, citations.edit_date, categories.name, users.first_name, users.last_name
        FROM citations INNER JOIN categories ON citations.id_categorie_citations = categories.id INNER JOIN users ON citations.added_by = users.id WHERE  citations.is_deleted = 0 ORDER BY citations.id DESC");
        return $citations;
    }
    public function update_citation(Request $request, $id)
    {
        $citation = Citation::find($id);
        $citation->contenu = $request->contenu;
        $citation->id_categorie_citations = $request->id_categorie_citations;
        $citation->edited_by = Auth::user()->id;
        $citation->edit_date = Carbon::now();

        // Galerie::where('id_citations', $id)->delete();

        if ($request->hasFile('fichiers')) {
            $fichiers = $request->file('fichiers');
            $id_fichier = $request->file('id_fichier');

            foreach ($fichiers as $key => $fichier) {
                $image = Galerie::find($id_fichier[$key]);

                $extension = $fichier->getClientOriginalExtension();
                $destinationPath = '';

                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $destinationPath = 'images';
                } elseif (in_array($extension, ['mp4', 'mov'])) {
                    $destinationPath = 'videos';
                } elseif (in_array($extension, ['mp3'])) {
                    $destinationPath = 'audios';
                }

                $fileName = time() . '_' . $fichier->getClientOriginalName();
                $path = $fichier->storeAs('public/' . $destinationPath, $fileName);

                if ($image) {

                    $image->update([
                        'url_medias' => $path[$key],
                        'types_fichiers' => $extension[$key],
                        'edited_by' => Auth::user()->id,
                        'edit_date' => Carbon::now(),
                    ]);
                } else {
                    Galerie::create([
                        'url_medias' => $path,
                        'types_fichiers' => $extension,
                        'added_by' => Auth::user()->id,
                        'add_date' => Carbon::now(),
                    ]);
                }
            }
        }
        $citation->save();
        // return $citation;
    }

    public function delete_citation($id)
    {

        $citation = $this->model->find($id);
        $citation->is_deleted = 1;
        $citation->deleted_by = Auth::user()->id;
        $citation->delete_date = Carbon::now();
        $citation->save();
    }
    public function edit_citation($id)
    {
        $citation = Citation::find($id);

        $images = Galerie::where('id_citations', $id)->get();
        $data = [
            'citation' => $citation,
            'images' => $images,
        ];
        return $data;
    }

    public function countCitationsPubliees()
    {
        $citationTotal = Citation::where([
            ['is_deleted', 0],
        ])->count();
        return $citationTotal;
    }
}
