@extends('layouts.base')

@section('content')
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Administrateurs</h4>
        <p class="mg-b-0">Espace Rôles Coaching</p>
    </div><!-- d-flex -->

    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 ">MODIFICATION</h6>
            <div class="d-flex align-items-center justify-content-between mb-3">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

            </div>
            <form action="{{ route('detail-abonnement.update',$detail->id) }}" data-parsley-validate method="POST">
                @csrf
                @method('PUT')

                <div class="form-layout form-layout-1">
                    <div class="row mg-b-25">
                        <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Libellé: <span class="tx-danger">*</span></label>
                                <input class="form-control" value="{{ $detail->details }}" name="details" id="details"
                                    type="text">
                            </div>
                        </div>

                    </div><!-- row -->
                </div><!-- form-layout -->
                <div class="modal-footer">
                    <button class=" btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium "
                        id="add_role" type="submit">Modifier</button>

                </div>
            </form>

        </div><!-- br-section-wrapper -->

    </div><!-- br-pagebody -->
@endsection

{{-- @section('scripts') --}}

