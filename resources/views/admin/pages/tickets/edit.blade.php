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
            {{-- <h2 class="tx-gray-800 tx-uppercase tx-bold tx-16 ">Modifier ticket {{ Str::upper($ticket->references) }}</h2> --}}
            <div class="tab-pane fade active show " id="posts">
                <div class="col-md-12 text-center">
                    <div class="d-flex align-items-center justify-content-between mb-3">

                    </div>
                        <form action="{{ route('tickets.update',$ticket->id) }}" method="post" data-parsley-validate
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-layout form-layout-1 form-center">
                                <div class="row mg-b-25">
                                    <div class="col-lg-6">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Evènement: <span  class="tx-danger">*</span></label>
                                                   
                                            <select class="form-control select2" data-placeholder="Choisir un évènement" name="id_events">
                                                
                                                <option value="" disabled selected>Choisir un évènement</option>
                                                @foreach ($listeEvents as $listeEvent)
                                                    <option value="{{ $listeEvent->id }}"
                                                        {{ $ticket->id_events == $listeEvent->id ? 'selected' : '' }}>
                                                        {{ $listeEvent->titles }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Libellé: <span class="tx-danger">*</span></label>
                                            <input class="form-control" name="libelle" id="libelle" type="text" value="{{ $ticket->libelle }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Prix ticket: <span class="tx-danger">*</span></label>
                                            <input class="form-control" name="prix_tickets" id="prix_tickets" type="text" value="{{ $ticket->prix_tickets }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Taux de reduction: <span class="tx-danger">*</span></label>
                                            <input class="form-control" name="taux_reduction" id="taux_reduction" type="text" value="{{ $ticket->taux_reduction }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group mg-b-10-force">
                                            <label class="form-control-label">Nombre de ticket: <span
                                                    class="tx-danger">*</span></label>
                                            <input class="form-control" name="quantite_tickets" id="quantite_tickets"
                                                type="number" value="{{ $ticket->quantite_tickets }}">
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

