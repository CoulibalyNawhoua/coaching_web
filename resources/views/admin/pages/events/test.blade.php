@extends('layouts.base')

@section('content')
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Administrateurs</h4>
        <p class="mg-b-0">Espace Evènement Coaching</p>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-12">
                <div class="card pd-0 bd-0 shadow-base">
                    <div class="pd-x-20 pd-t-30 pd-b-15">
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 ">Ajouter une Evènement</h6>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            @if (session()->has('success'))
                                <div class="alert alert-success col-lg-12">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
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
                                            <label class="form-control-label">Adresse: <span
                                                    class="tx-danger">*</span></label>
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
                                                    @foreach ($evenement->datesEvenement as $key => $dateEvenement)
                                                        <tr>
                                                            <td>
                                                                <input type="date"
                                                                    name="dates[{{ $key }}][date_evenement]"
                                                                    class="form-control"
                                                                    value="{{ $dateEvenement->date_evenement }}">
                                                            </td>
                                                            <td>
                                                                <input type="time"
                                                                    name="dates[{{ $key }}][heure_evenement]"
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
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Description: <span
                                                    class="tx-danger">*</span></label>
                                            <textarea rows="10" class="form-control" placeholder="Description" name="descriptions">{{ $evenement->descriptions }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Ajouter Images: </label>
                                            <input type="file" name="url_images" class="dropify" id="aovatar">
                                        </div>
                                    </div>
                                </div><!-- row -->
                            </div><!-- form-layout -->
                            <div class="form-layout-footer mt-3">
                                <button class="btn btn-info" type="submit">Enregistrer</button>
                            </div><!-- form-layout-footer -->
                        </form>

                    </div>
                </div>
            </div>
        </div><!-- br-section-wrapper -->
    @endsection

    @section('scripts')
        <script>

            $(document).ready(function() {

                let count = 10

                console.log(('ok'));


                $('#add_date').click(function() {
                    let html = `
                    <tr>
                        <td>
                            <input type="date" name="dates[${count}]" class="form-control">
                        </td>
                        <td>
                            <input type="time" name="dates[${count}]" class="form-control">
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
            });

            function deleteSub(el, id) {
                if (Number(id) > 0) {
                    $(el).parents('form').append('<input type="hidden" name="delete_sub[]" value="' + id + '" />');
                }
                $(el).parent().parent().remove();

            }
        </script>
    @endsection
