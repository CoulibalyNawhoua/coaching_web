@extends('layouts.base')

@section('content')

    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Administrateurs</h4>
        <p class="mg-b-0">Espace citation Coaching</p>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="row row-sm mg-t-20">
            <div class="col-12">
                <div class="card pd-0 bd-0 shadow-base">
                    <div class="pd-x-20 pd-t-30 pd-b-15">
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 ">Ajouter une Citation</h6>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                        </div>
                        <form action="{{ route('citations.store') }}" method="post" data-parsley-validate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-layout form-layout-1">
                                <div class="row mg-b-25">
                                    <div class="col-lg-12">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Catégories: <span
                                                    class="tx-danger">*</span></label>
                                            <select class="form-control select2" data-placeholder="Choisir une catégorie"
                                                name="id_categorie_citations">
                                                <option label="Choose country"></option>
                                                @foreach ($categorie_citation as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Contenu: <span
                                                    class="tx-danger">*</span></label>
                                            <textarea rows="10" class="form-control" placeholder="contenu" name="contenu"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Fichier: <span
                                                    class="tx-danger">*</span></label>
                                            <input type="file" name="fichiers[]" class="dropify" multiple id="aovatar">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div id="preview-container" class="d-flex justify-content-center" style="width: 300px; height:100px;"></div>
                                    </div>

                                </div><!-- row -->
                            </div><!-- form-layout -->

                            <div class="form-layout-footer mt-3">
                                <button class="btn btn-info">Enregistrer</button>
                            </div><!-- form-layout-footer -->

                        </form>
                    </div>
                </div>
            </div>

        </div><!-- br-section-wrapper -->

        {{-- </div><!-- br-pagebody --> --}}
    @endsection

    @section('scripts')

        <script>
            function addRole() {
                $('#modal-user').modal('show');
                $('#FormUser').trigger('reset');
            }
        </script>
