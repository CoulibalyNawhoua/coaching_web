@extends('layouts.base')

@section('content')
    <div class="br-mainpanel">
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Détails Evènement</h4>
        </div><!-- d-flex -->

        <div class="row">
            <div class="col-md">

            </div><!-- col -->
            <div class="col-md">
                <div class="card">
                    @if ($detail[0]->url_images)
                        <img class="card-img-bottom img-fluid" src="{{ $detail[0]->url_images }}" alt="Image">
                    @else
                        <img class="card-img-bottom img-fluid" src="{{ asset('assets/img/img12.jpg') }}" alt="Image">
                    @endif

                    <div class="card-body bd bd-b-0 bd-color-gray-lighter rounded-top">
                        <h6 class="mg-b-3"><a href="#" class="tx-dark mt-3">{{ $detail[0]->titles }}</a></h6>
                        @foreach ($detail as $item)
                            <div class="mt-3">
                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                <span
                                    class="tx-12">{{ Carbon\Carbon::parse($item->date_evenement)->locale('fr_FR')->isoFormat('LLLL') }}
                                    {{ $item->heure_evenement }}</span>
                            </div><br>
                        @endforeach
                    </div><!-- card-body -->
                </div><!-- card -->
            </div><!-- col -->

            <div class="col-md mg-t-20 mg-md-t-0">

            </div><!-- col -->
        </div><!-- row -->
    </div><!-- br-mainpanel -->
@endsection
