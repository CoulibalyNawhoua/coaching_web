<style>
    .form-control-label {
        text-align: left;
    }
</style>
@extends('layouts.base')

@section('content')
    <div class="br-mainpanel br-profile-page">
        <div class="card shadow-base bd-0 rounded-0 widget-4">


        </div><!-- card -->
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <br>
        <div class="tab-content br-profile-body mt-3" style="background: #fff;">
            <h2 class="tx-gray-800 tx-uppercase tx-bold tx-16 ">Modifier un Evènement</h2>
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                    <form action="{{ route('evenements.update', $evenement->id) }}" method="POST" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Événement: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" name="titles" type="text" id="titles"
                                            value="{{ $evenement->titles }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Adresse: <span class="tx-danger">*</span></label>
                                        <input class="form-control" name="adresse_event" required type="text"
                                            id="adresse_event" value="{{ $evenement->adresse_event }}">
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <div class="form-group mg-b-10-force">
                                        <span id="result"></span>
                                        <table class="table" id="user_table">
                                            <thead>
                                                <tr>
                                                    <th width="35%">Date Évènement</th>
                                                    <th width="35%">Heure Évènement</th>
                                                    <th width="30%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($evenement->datesEvenement as $dateEvenement)
                                                    <tr>
                                                        <!-- Champ masqué pour stocker l'ID de la DateEvent -->
                                                        <input type="hidden" name="id_date[]" value="{{ $dateEvenement->id }}">
                                                        <td>
                                                            <input type="date"
                                                                name="date_evenement[]"
                                                                class="form-control"
                                                                value="{{ $dateEvenement->date_evenement }}">
                                                        </td>
                                                        <td>
                                                            <input type="time"
                                                                name="heure_evenement[]"
                                                                class="form-control"
                                                                value="{{ $dateEvenement->heure_evenement }}">
                                                        </td>
                                                        <td>
                                                            {{-- <a href="javascript:;" class="btn btn-danger btn-sm remove" onclick="deleteSub(this, {{ $dateEvenement->id }})">Supprimer</a> --}}
                                                            <button type="button" class="btn btn-danger btn-sm remove"
                                                                onclick="deleteSub(this, {{ $dateEvenement->id }})">Supprimer</button>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <button type="button" class="btn btn-primary mt-3" id="add_date">Ajouter
                                            date</button>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Description: </label>
                                        <textarea rows="10" class="form-control" placeholder="Description" name="descriptions">{{ $evenement->descriptions }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 mt-5">
                                    <div class="form-group mg-b-10-force">
                                        {{-- <img src="{{ Storage::url($evenement->url_images) }}" alt="" class="w-50"> --}}
                                        <input type="file" name="url_images" id="avatar" class="dropify"
                                            data-default-file="{{ $evenement->url_images }}">
                                    </div>
                                </div>
                            </div><!-- row -->
                        </div><!-- form-layout -->
                        <div class="form-layout-footer mt-3">
                            <button class="btn btn-info" type="submit">Enregistrer</button>
                        </div><!-- form-layout-footer -->
                    </form>
                </div>
            </div><!-- tab-pane -->
        </div><!-- br-pagebody -->
        <!-- </form> -->
    </div><!-- br-mainpanel -->
@endsection
@section('scripts')
    <script>
        let count =
        {{ count($evenement->datesEvenement) }}; // Initialisez le compteur avec le nombre actuel d'éléments dans la liste

        $('#add_date').click(function() {
            let html = `
                <tr>
                    <input type="hidden" name="id_date[]" value="">
                    <td>
                        <input type="date" name="date_evenement[]" class="form-control">
                    </td>
                    <td>
                        <input type="time" name="heure_evenement[]" class="form-control">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove">Supprimer</button>
                    </td>
                </tr>
            `;

            $('#user_table').append(html);
            count++;
        });

        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });

        function deleteSub(el, id) {
            if (Number(id) > 0) {
                $(el).parents('form').append('<input type="hidden" name="delete_sub[]" value="' + id + '" />');
            }
            $(el).parent().parent().remove();

        }
    </script>
@endsection
