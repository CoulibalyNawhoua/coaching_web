<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {

        $param = $data;
        $param["added_by"] = Auth::user()->id;
        // $param["add_ip"] = $this->getIp();
        return $this->model->create($param);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $param = $data;
        $record = $this->model->find($id);
        $param["edited_by"] = Auth::user()->id;
        // $param["edit_ip"] = $this->getIp();
        $param["edit_date"] = Carbon::now();
        return $record->update($param);
    }

    // remove record from the database
    public function delete($id)
    {
        $_data = $this->model->find($id);

        $_data->is_deleted = 1;
        $_data->deleted_by = Auth::user()->id;
        // $_data->delete_ip = $this->getIp();
        $_data->delete_date = Carbon::now();
        $_data->save();

        return $_data;
    }
    // show the record with the given id
    public function edit($id)
    {
        return $this->model->findOrFail($id);
    }
    // show the record with the given id  display view
    public function view($id)
    {
        return $this->model->findOrFail($id);
    }
    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    //get record not delete
    public function getModelNotDelete()
    {
        return $this->model->where('is_deleted', 0)->orderBy('id', 'ASC')->get();
    }

    public function CodeRestoration($char = 5)
    {
        $nbcar = $char;
        $string = '';
        $chaine = strtoupper('abcdefghijklmnpqrstuvwxy123456789');
        srand((float) microtime() * 1000000);
        for ($i = 0; $i < $nbcar; ++$i) {
            $string .= $chaine[rand() % strlen($chaine)];
        }
        return $string;
    }

}
