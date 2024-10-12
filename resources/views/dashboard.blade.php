@extends('layouts.base')

@section('content')

<div class="br-mainpanel">
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
    </div><!-- d-flex -->

    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="row row-sm ">
            <div class="col-sm-6 col-xl-3 mt-3">
                <div class="bg-teal rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="fa fa-book tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Citations Publiées</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$citationTotal}}</p>
                            {{-- <span class="tx-11 tx-roboto tx-white-6">24% higher yesterday</span> --}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0 mt-3">
                <div class="bg-danger rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="fa fa-users tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Nombre d'Abonnés</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$userSouscrits}}</p>
                            {{-- <span class="tx-11 tx-roboto tx-white-6">$390,212 before tax</span> --}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0 mt-3">
                <div class="bg-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="fa fa-users tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Nombre d'utilisateurs</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$userInscrits}}</p>
                            {{-- <span class="tx-11 tx-roboto tx-white-6">23% average duration</span> --}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0 mt-3">
                <div class="bg-br-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="fa fa-ticket tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Nombre d'évènements</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{$totalEvent}}</p>
                            {{-- <span class="tx-11 tx-roboto tx-white-6">65.45% on average time</span> --}}
                        </div>
                    </div>
                </div>
            </div><!-- col-3 -->
        </div><!-- row -->

        {{-- <div class="row row-sm mg-t-20">
            <div class="col-12">
                <div class="card bd-0 shadow-base pd-30 mg-t-20">
                    <div class="d-flex align-items-center justify-content-between mg-b-30">
                        <div>
                            <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Newly Registered
                                Users</h6>
                            <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i> From October 2017 -
                                December 2017</p>
                        </div>
                        <a href="#"
                            class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">See
                            more</a>
                    </div><!-- d-flex -->

                    <table class="table table-valign-middle mg-b-0">
                        <tbody>
                            <tr>
                                <td class="pd-l-0-force">
                                    <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
                                </td>
                                <td>
                                    <h6 class="tx-inverse tx-14 mg-b-0">Deborah Miner</h6>
                                    <span class="tx-12">@deborah.miner</span>
                                </td>
                                <td>Nov 01, 2017</td>
                                <td><span id="sparkline1">1,4,4,7,5,9,4,7,5,9,1</span></td>
                                <td class="pd-r-0-force tx-center"><a href="#" class="tx-gray-600"><i
                                            class="icon ion-more tx-18 lh-0"></i></a></td>
                            </tr>
                            <tr>
                                <td class="pd-l-0-force">
                                    <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
                                </td>
                                <td>
                                    <h6 class="tx-inverse tx-14 mg-b-0">Belinda Connor</h6>
                                    <span class="tx-12">@belinda.connor</span>
                                </td>
                                <td>Oct 28, 2017</td>
                                <td><span id="sparkline2">1,3,6,4,5,8,4,2,4,5,0</span></td>
                                <td class="pd-r-0-force tx-center"><a href="#" class="tx-gray-600"><i
                                            class="icon ion-more tx-18 lh-0"></i></a></td>
                            </tr>
                            <tr>
                                <td class="pd-l-0-force">
                                    <img src="../img/img6.jpg" class="wd-40 rounded-circle" alt="">
                                </td>
                                <td>
                                    <h6 class="tx-inverse tx-14 mg-b-0">Andrew Wiggins</h6>
                                    <span class="tx-12">@andrew.wiggins</span>
                                </td>
                                <td>Oct 27, 2017</td>
                                <td><span id="sparkline3">1,2,4,2,3,6,4,2,4,3,0</span></td>
                                <td class="pd-r-0-force tx-center"><a href="#" class="tx-gray-600"><i
                                            class="icon ion-more tx-18 lh-0"></i></a></td>
                            </tr>
                            <tr>
                                <td class="pd-l-0-force">
                                    <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
                                </td>
                                <td>
                                    <h6 class="tx-inverse tx-14 mg-b-0">Brandon Lawrence</h6>
                                    <span class="tx-12">@brandon.lawrence</span>
                                </td>
                                <td>Oct 27, 2017</td>
                                <td><span id="sparkline4">1,4,4,7,5,9,4,7,5,9,1</span></td>
                                <td class="pd-r-0-force tx-center"><a href="#" class="tx-gray-600"><i
                                            class="icon ion-more tx-18 lh-0"></i></a></td>
                            </tr>
                            <tr>
                                <td class="pd-l-0-force">
                                    <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="">
                                </td>
                                <td>
                                    <h6 class="tx-inverse tx-14 mg-b-0">Marilyn Tarter</h6>
                                    <span class="tx-12">@marilyn.tarter</span>
                                </td>
                                <td>Oct 27, 2017</td>
                                <td><span id="sparkline5">1,3,6,4,5,8,4,2,4,5,0</span></td>
                                <td class="pd-r-0-force tx-center"><a href="#" class="tx-gray-600"><i
                                            class="icon ion-more tx-18 lh-0"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- card -->

            </div><!-- col-9 -->

        </div><!-- row --> --}}

    </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->


@endsection
