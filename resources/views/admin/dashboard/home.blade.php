
@extends('layouts.app')
@section('title') Inicio @endsection
@section('page_active') Dashboard @endsection 
@section('subpage_active') Home @endsection 


@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-4">Usuarios conectados</h4>

                    <div class="widget-chart-1">
                        <div class="widget-detail-1 text-end">
                            <span class="badge bg-danger rounded-pill float-start mt-3">{{ $overview['users'] }}% <i class="mdi mdi-trending-up"></i> </span>
                            
                            <h2 class="fw-normal pt-2 mb-1"> {{$overview['users']}} </h2>
                            <p class="text-muted mb-1">De este mes</p>
                        </div>
                    </div>
                    <div class="progress progress-bar-alt-pink progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar"
                                aria-valuenow="{{$overview['users']}}" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{$overview['users']}}%;">
                            <span class="visually-hidden">{{$overview['users']}}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-4">Interconexiones</h4>

                    <div class="widget-chart-1">
                            
                        <div class="widget-detail-1 text-end">
                            <span class="badge bg-success rounded-pill float-start mt-3">{{$overview['monthConn']}}% <i class="mdi mdi-trending-up"></i> </span>
                            
                            <h2 class="fw-normal pt-2 mb-1"> {{ $overview['monthConn'] }} </h2>
                            <p class="text-muted mb-1">Actividad de este mes</p>
                        </div>
                        <div class="progress progress-bar-alt-pink progress-sm">
                            <div class="progress-bar bg-success" role="progressbar"
                                    aria-valuenow="{{$overview['monthConn']}}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{$overview['monthConn']}}%;">
                                <span class="visually-hidden">{{$overview['monthConn']}}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                        
                    <h4 class="header-title mt-0 mb-4">Beacons en linea</h4>

                    <div class="widget-chart-1">
                        <div class="widget-detail-1 text-end">
                            <span class="badge bg-warning rounded-pill float-start mt-3">{{$overview['beaconOn']}}% <i class="mdi mdi-trending-up"></i> </span>
                            
                            <h2 class="fw-normal pt-2 mb-1"> {{$overview['beaconOn']}} </h2>
                            <p class="text-muted mb-1">Revenue today</p>
                        </div>
                    </div>
                    <div class="progress progress-bar-alt-pink progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar"
                                aria-valuenow="{{$overview['beaconOn']}}" aria-valuemin="0" aria-valuemax="100"
                                style="width: {{$overview['beaconOn']}}%;">
                            <span class="visually-hidden">{{$overview['beaconOn']}}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    
                    <h4 class="header-title mt-0 mb-3">Lecturas de QR</h4>

                    <div class="widget-box-2">
                        <div class="widget-detail-2 text-end">
                            <span class="badge bg-pink rounded-pill float-start mt-3">{{$overview['monthQrR']}}% <i class="mdi mdi-trending-up"></i> </span>
                            <h2 class="fw-normal mb-1"> {{ $overview['monthQrR'] }} </h2>
                            <p class="text-muted mb-3">Revenue today</p>
                        </div>
                        <div class="progress progress-bar-alt-pink progress-sm">
                            <div class="progress-bar bg-pink" role="progressbar"
                                    aria-valuenow="{{$overview['monthQrR']}}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{$overview['monthQrR']}}%;">
                                <span class="visually-hidden">{{$overview['monthQrR']}}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><!-- end col -->

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Registro de usuarios</h4>
                    <div id="users-signin" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Interconexiones</h4>
                    <div id="interconn-chart" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div> <!-- container-fluid -->

@endsection

@section('scripts')
    <script>
        !
function(e) {
	"use strict";

	function a() {
		this.$realData = []
	}

	a.prototype.createBarChart = function(e, a, t, r, o, i) {
		Morris.Bar({
			element: e,
			data: a,
			xkey: t,
			ykeys: r,
			labels: o,
			hideHover: "auto",
			resize: !0,
			gridLineColor: "rgba(173, 181, 189, 0.1)",
			barSizeRatio: .2,
			dataLabels: !1,
			barColors: i
		})
	}, a.prototype.createLineChart = function(e, a, t, r, o, i) {
		Morris.Bar({
			element: e,
			data: a,
			xkey: t,
			ykeys: r,
			labels: o,
			hideHover: "auto",
			resize: !0,
			gridLineColor: "rgba(173, 181, 189, 0.1)",
			barSizeRatio: .2,
			dataLabels: !1,
			barColors: i
		})
	}, a.prototype.init = function() {
		e("#users-signin").empty(); e("#interconn-chart").empty();
		
        // Estadisticas de usuarios registrados
        this.createBarChart("users-signin", [
            {
                y: "{{ $admin->getMonthName(5) }}",
                a: "{{ $admin->chartUsersSign(5)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(4) }}",
                a: "{{ $admin->chartUsersSign(4)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(3) }}",
                a: "{{ $admin->chartUsersSign(3)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(2) }}",
                a: "{{ $admin->chartUsersSign(2)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(1) }}",
                a: "{{ $admin->chartUsersSign(1)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(0) }}",
                a: "{{ $admin->chartUsersSign(0)['online'] }}"
            }
        ], "y", ["a"], ["Registros"], ["#188ae2"]);


        // Estadisticas de Interconexiones
        this.createLineChart("interconn-chart", [
            {
                y: "{{ $admin->getMonthName(5) }}",
                a: "{{ $admin->chartConnections(5)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(4) }}",
                a: "{{ $admin->chartConnections(4)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(3) }}",
                a: "{{ $admin->chartConnections(3)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(2) }}",
                a: "{{ $admin->chartConnections(2)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(1) }}",
                a: "{{ $admin->chartConnections(1)['online'] }}"
            },
            {
                y: "{{ $admin->getMonthName(0) }}",
                a: "{{ $admin->chartConnections(0)['online'] }}"
            }
            
        ], "y", ["a"], ["Conexiones"],  ["#10c469", "#188ae2"]);
		

	}, e.Dashboard1 = new a, e.Dashboard1.Constructor = a
    }(window.jQuery), function(a) {
        "use strict";
        a.Dashboard1.init(), window.addEventListener("adminto.setBoxed", function(e) {
            a.Dashboard1.init()
        }), window.addEventListener("adminto.setFluid", function(e) {
            a.Dashboard1.init()
        })
    }(window.jQuery);
    </script>
@endsection