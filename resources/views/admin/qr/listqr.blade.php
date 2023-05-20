
@extends('layouts.app')
@section('title') Listado de QR @endsection
@section('page_active') QR Generados @endsection 
@section('subpage_active') Listado @endsection 


@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row"> 
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                     
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>QR</th>
                            <th>Descripción</th>
                            <th>Cantidad de elementos</th>
                            <th>Usuario</th> 
                            <th>Estado</th>
                        </tr>
                        </thead>


                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td>{{ $row['id'] }}</td>
                                <td><img src="data:image/png;base64,{{ $row['QR'] }}" style="width:50px;height: 50px;max-width:none !important;"></td>
                                <td>{{ $row['descript'] }}</td>
                                <td>{{ $row['counter'] }}</td>
                                <td>{{ $row['user'] }}<br />  <small>({{ $row['email'] }})</small> </td> 
                                <td>
                                    @if ($row['status'] == 1)
                                        <button type="button"
                                            class="btn btn-success width-xs waves-effect waves-light">Activo</button>
                                    @else
                                        <button type="button"
                                            class="btn btn-danger width-xs waves-effect waves-light">Canjeado</button>
                                    @endif
                                </td> 
                            </tr>
                            @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
 
</div> <!-- container-fluid -->

@endsection 