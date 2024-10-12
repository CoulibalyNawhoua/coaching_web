@extends('layouts.base')

@section('content')

    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Administrateurs</h4>
        <p class="mg-b-0">Espace Evènement Coaching</p>
    </div><!-- d-flex -->

    <div class="br-pagebody">

        <div class="br-section-wrapper">

            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 ">Ajouter une Evènement</h6>

            <div class="d-flex align-items-center justify-content-between mb-3">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                {{-- <a href="{{ route('citations.create') }}" class="btn btn-primary btn-with-icon">
                    <div class="ht-40 justify-content-between">
                        <span class="pd-x-15">Ajouter</span>
                        <span class="icon wd-40"><i class="fa fa-plus"></i></span>
                    </div>
                </a> --}}
            </div>

            <form action="{{ route('evenements.store') }}" method="post" data-parsley-validate enctype="multipart/form-data">
                @csrf
                <div class="form-layout form-layout-1">
                    <div class="row mg-b-25">

                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Evènement: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="titles"  type="text" id="titles">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Adresse: <span class="tx-danger">*</span></label>
                                <input class="form-control" name="adresse_event" required type="text" id="adresse_event">

                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="form-group mg-b-10-force">
                                <p class="tx-14 mg-b-10"><label class="form-control-label">Date 1: <span
                                            class="tx-danger">*</span></label></p>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input type="date" class="form-control " name="date_1">
                                    </div>
                                </div><!-- wd-200 -->

                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="form-group mg-b-10-force">
                                <p class="tx-14 mg-b-10"><label class="form-control-label">Date 2: <span
                                            class="tx-danger"></span></label></p>
                                <div class="wd-200 mg-b-30">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                                        <input type="date" class="form-control" name="date_2">
                                    </div>
                                </div><!-- wd-200 -->

                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Heure 1: <span class="tx-danger">*</span></label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o tx-16 lh-0 op-6"></i></span>
                                        <input  type="time" class="form-control" name="heure_1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-3">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Heure 2: <span
                                    class="tx-danger"></span></label>
                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-clock-o tx-16 lh-0 op-6"></i></span>
                                        <input  type="time" class="form-control" name="heure_2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                                <textarea rows="5" class="form-control" placeholder="Description" name="descriptions"></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Ajouter Image: </label>
                                <input type="file" name="url_images" class="dropify" multiple>
                            </div>
                        </div>

                    </div><!-- row -->
                </div><!-- form-layout -->

                <div class="form-layout-footer mt-3">
                    <button class="btn btn-info">Enregistrer</button>
                </div><!-- form-layout-footer -->

            </form>




        </div><!-- br-section-wrapper -->

    </div><!-- br-pagebody -->
@endsection

@section('scripts')

    <script>
        function addRole() {
            $('#modal-user').modal('show');
            $('#FormUser').trigger('reset');
        }
    </script>
