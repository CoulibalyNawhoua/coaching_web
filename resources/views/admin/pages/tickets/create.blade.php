<style>
    .form-control-label {
        text-align: left;
    }
</style>
@extends('layouts.base')

@section('content')
    <div class="br-mainpanel br-profile-page">
        <div class="card shadow-base bd-0 rounded-0 widget-4"></div><!-- card -->

        <br>
        <div class="tab-content br-profile-body" style="background: #fff;">
            <div>
                <h4 class="tx-gray-800 mg-b-5">Crée un Ticket</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success w-50">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3"></div>
                    <form action="{{ route('tickets.store') }}" method="post" data-parsley-validate enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Evènement: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choisir une catégorie" name="id_events" required onchange="fetchEventDates(this)">
                                            <option selected> choisir un évènement</option>
                                            @foreach ($listeEvents as $listeEvent)
                                                <option value="{{ $listeEvent->id }}">{{ $listeEvent->titles }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Dates Evènement: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" data-placeholder="Choisir une date" name="id_date_event" required id="selectDateEvent">
                                            <option selected>Choisir une date</option>
                                            @foreach ($dates as $date)
                                                <option value="{{ $date->id }}">{{ $date->date_evenement }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3">
                                    <div class="form-group mg-b-10-force">
                                        <span id="result"></span>
                                        <table class="table " id="user_table">
                                            <thead>
                                                <tr>
                                                    <th width="35%">Libellé</th>
                                                    <th width="30%">Prix</th>
                                                    <th width="10%">Reduction</th>
                                                    <th width="15%">Nbre </th>
                                                    <th width="10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
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
        function fetchEventDates(eventId) {

            const webUrl = '/get-dates/' + eventId.value;          
            moment.locale('fr'); // Définir la locale française pour moment.js

            fetch(webUrl)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('La requête a échoué');
                    }
                    return response.json(); // Lire la réponse en tant que JSON
                })
                .then((data) => {
                    const selectDateEvent = document.querySelector('#selectDateEvent');
                    selectDateEvent.innerHTML = ''; // Réinitialiser le contenu du sélecteur

                    data.forEach((date) => {
                        const option = document.createElement('option');
                        option.value = date.id;
                        option.textContent = moment(date.date_evenement).format('DD MMMM YYYY');
                        selectDateEvent.appendChild(option);
                    });
                })
                .catch((error) => {
                    console.error('Erreur de requête web:', error);
                });
        }

        // tableau dynamique 
        var count = 1;

        dynamic_field(count);

        function dynamic_field(number) {
            html = '<tr>';
           
            html += '<td><input type="text" name="libelle[]" class="form-control" required /></td>';
            html += '<td><input type="text" name="prix_tickets[]" class="form-control" required /></td>';
            html += '<td><input type="number" name="taux_reduction[]" class="form-control" required /></td>';
            html += '<td><input type="number" name="quantite_tickets[]" class="form-control" required /></td>';
            if (number > 1) {
                html +=
                    '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Supprimer</button></td></tr>';
                $('tbody').append(html);
            } else {
                html +=
                    '<td><button type="button" name="add" id="add" class="btn btn-primary ">Ajouter ticket</button></td></tr>';
                $('tbody').html(html);
            }
        }



        $(document).on('click', '#add', function() {
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function() {
            count--;
            $(this).closest("tr").remove();
        });

        $('#dynamic_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    $('#save').attr('disabled', 'disabled');
                },
                success: function(data) {
                    if (data.error) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<p>' + data.error[count] + '</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">' + error_html +
                            '</div>');
                    } else {
                        dynamic_field(1);
                        $('#result').html('<div class="alert alert-success">' + data
                            .success + '</div>');
                    }
                    $('#save').attr('disabled', false);
                }
            })
        });



        // });
    </script>
@endsection



