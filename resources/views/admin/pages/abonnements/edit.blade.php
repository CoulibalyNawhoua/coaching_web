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
                <h4 class="tx-gray-800 mg-b-5">Modifier l'abonnement </h4>
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
                    <form action="{{ route('abonnements.update', $abonnement->id) }}" method="post" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-6 mg-t-10">
                                    <label class="form-control-label mg-b-0-force">Libellé abonnement: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="libelle" required type="text" id="libelle" value="{{ $abonnement->libelle }}">
                                </div>
                                <div class="col-lg-6 mg-t-10">
                                    <label class="form-control-label mg-b-0-force">Prix abonnement: <span class="tx-danger">*</span></label>
                                    <input class="form-control" name="prix_abonnements" required type="number" id="prix_abonnements" value="{{ $abonnement->prix_abonnements }}" >
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Type abonnement: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 d-flex justify-content-between" required name="id_categories_abonnements">
                                            <option value=""> choisir...</option>
                                            @foreach ($categories_abonnements as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $abonnement->id_categories_abonnements == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Période abonnement: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 d-flex justify-content-between" name="id_dure_abonnement">
                                            <option> choisir...</option>
                                            @foreach ($periodes_abonnements as $item)
                                                <option value="{{ $item->id }}" 
                                                    {{ $abonnement->id_dure_abonnement == $item->id ? 'selected' : '' }}>
                                                    {{ $item->periode }}
                                                </option>;
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <p class="text-left mg-t-10">Quelles sont les offres de l'abonnement ? <span
                                    class="tx-danger">*</span></p>
                            <div id="cbWrapper2" class="parsley-checkbox">
                                @foreach ($offres as $item)
                                <label class="ckbox d-flex align-items-center">
                                    <input type="checkbox" name="offres[]" value="{{ $item->id }}" 
                                        {{ $abonnement->offresAbonnement->contains($item->id) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $item->offres }}</span>
                                </label>
                            @endforeach
                            </div>
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
    <script></script>
@endsection
