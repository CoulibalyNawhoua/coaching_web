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
                <h4 class="tx-gray-800 mg-b-5">Créer les offres d'abonnement </h4>
                @if (session()->has('success'))
                    <div class="alert alert-success w-50">
                        {{ session()->get('success') }}
                    </div>
                @endif
            </div>
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                    <form action="{{ route('detail-abonnement.store') }}" method="post" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">

                                <div class="col-lg-12">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Type abonnement: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2 d-flex justify-content-between"
                                            name="id_categories_abonnements">
                                            <option value=""> choisir...</option>
                                            @foreach ($categories_abonnements as $categorie)
                                                <option value="{{ $categorie->id }}">
                                                    {{ $categorie->name }}</option>;
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
                                                    <th width="90%">offres de l'abonnement</th>
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
        // tableau dynamique 
        var count = 1;

        dynamic_field(count);

        function dynamic_field(number) {
            html = '<tr>';
            html += '<td><input type="text" name="offres[]" class="form-control" required /></td>';
            if (number > 1) {
                html +=
                    '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Supprimer</button></td></tr>';
                $('tbody').append(html);
            } else {
                html +=
                    '<td><button type="button" name="add" id="add" class="btn btn-primary ">Ajouter</button></td></tr>';
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
