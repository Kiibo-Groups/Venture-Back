
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
                            <span class="badge bg-danger rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                            
                            <h2 class="fw-normal pt-2 mb-1"> 150 </h2>
                            <p class="text-muted mb-1">De este mes</p>
                        </div>
                    </div>
                    <div class="progress progress-bar-alt-pink progress-sm">
                        <div class="progress-bar bg-danger" role="progressbar"
                                aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                style="width: 77%;">
                            <span class="visually-hidden">77% Complete</span>
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
                            <span class="badge bg-success rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                            
                            <h2 class="fw-normal pt-2 mb-1"> 525 </h2>
                            <p class="text-muted mb-1">Actividad de hoy</p>
                        </div>
                        <div class="progress progress-bar-alt-pink progress-sm">
                            <div class="progress-bar bg-success" role="progressbar"
                                    aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 77%;">
                                <span class="visually-hidden">77% Complete</span>
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
                            <span class="badge bg-warning rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                            
                            <h2 class="fw-normal pt-2 mb-1"> 4569 </h2>
                            <p class="text-muted mb-1">Revenue today</p>
                        </div>
                    </div>
                    <div class="progress progress-bar-alt-pink progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar"
                                aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                style="width: 77%;">
                            <span class="visually-hidden">77% Complete</span>
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
                            <span class="badge bg-pink rounded-pill float-start mt-3">32% <i class="mdi mdi-trending-up"></i> </span>
                            <h2 class="fw-normal mb-1"> 158 </h2>
                            <p class="text-muted mb-3">Revenue today</p>
                        </div>
                        <div class="progress progress-bar-alt-pink progress-sm">
                            <div class="progress-bar bg-pink" role="progressbar"
                                    aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 77%;">
                                <span class="visually-hidden">77% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><!-- end col -->

    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Encuestas Creadas</h4>

                    <div class="widget-chart text-center">
                        <div id="morris-donut-example" dir="ltr" style="height: 245px;" class="morris-chart"></div>
                        <ul class="list-inline chart-detail-list mb-0">
                            <li class="list-inline-item">
                                <h5 style="color: #BCD001;"><i class="fa fa-circle me-1"></i>Satisfactorias</h5>
                            </li>
                            <li class="list-inline-item">
                                <h5 style="color: #CB1414;"><i class="fa fa-circle me-1"></i>Pendientes</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Registro de usuarios</h4>
                    <div id="morris-bar-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Interconexiones</h4>
                    <div id="morris-line-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
</div> <!-- container-fluid -->

@endsection