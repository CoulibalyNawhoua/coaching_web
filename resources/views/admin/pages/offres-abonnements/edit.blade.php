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
        <div class="tab-content br-profile-body" style="background: #fff;">
            <h2 class="tx-gray-800 tx-uppercase tx-bold tx-16 ">Modifier une offre</h2>
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                    <form action="{{ route('offres_abonnements.update', $offres->id) }}" data-parsley-validate
                        method="POST" id="FormCategorieTicket">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">

                            <div class="col-lg-12">
                                <label class="form-control-label mg-b-0-force">Libellé: <span
                                        class="tx-danger">*</span></label>
                                <textarea name="offres" class="editable" id="offres" cols="55" rows="5">{{ $offres->offres }}</textarea>

                            </div>

                        </div><!-- form-layout -->
                        <div class="modal-footer">
                            <button class=" btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium "
                                id="add_role" type="submit">Mise à jour</button>
                        </div>
                    </form>
                </div>
            </div><!-- tab-pane -->
        </div><!-- br-pagebody -->
        <!-- </form> -->
    </div><!-- br-mainpanel -->
@endsection
