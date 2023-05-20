
@extends('layouts.app')
@section('title') Listado de Usuarios @endsection
@section('page_active') Usuarios @endsection 
@section('subpage_active') Listado @endsection 

@section('content') 
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Perfíl</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Telefono</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td>
                                        <img src="{{ Asset('upload/users/' . $row->pic_profile) }}" class="rounded-circle avatar-md img-thumbnail mb-2" alt="profile-image">
                                    </td>
                                    <td>
                                        {{ $row->name }} {{ $row->last_name }}
                                    </td>
                                    <td>
                                        {{ $row->email }}
                                    </td>
                                    <td>
                                        {{ $row->phone }}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
