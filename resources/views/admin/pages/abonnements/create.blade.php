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
                <h4 class="tx-gray-800 mg-b-5">Créer un abonnement </h4>
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
                    <form action="{{ route('abonnements.store') }}" method="post" data-parsley-validate
                        enctype="multipart/form-data" class="parsley-style-1">
                        @csrf
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-6 mg-t-10">
                                    <label class="form-control-label mg-b-0-force">Libellé abonnement: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="libelle" required type="text" id="libelle">
                                </div>
                                <div class="col-lg-6 mg-t-10">
                                    <label class="form-control-label mg-b-0-force">Prix abonnement: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="prix_abonnements" required type="number" id="prix_abonnements">
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Type abonnement: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 d-flex justify-content-between"  name="id_categories_abonnements">
                                            <option value=""> choisir...</option>
                                            @foreach ($categories_abonnements as $categorie)
                                                <option value="{{ $categorie->id }}">
                                                    {{ $categorie->name }}</option>;
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Période abonnement: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 d-flex justify-content-between" required name="id_dure_abonnement">
                                            <option> choisir...</option>
                                            @foreach ($periodes_abonnements as $periode)
                                                <option value="{{ $periode->id }}">
                                                    {{ $periode->periode }}</option>;
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="text-left mg-t-10">Quelles sont les offres de l'abonnement ? <span class="tx-danger">*</span></p>
                            <div id="cbWrapper2" class="parsley-checkbox">
                                @foreach ($offres_abonnements as $item)
                                    <label class="ckbox d-flex align-items-center">
                                        <input type="checkbox" name="offres[]" value="{{ $item->id }}">
                                        <span class="ml-2">{{ $item->offres }}</span>
                                    </label>
                                @endforeach
                            </div><!-- parsley-checkbox -->


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
