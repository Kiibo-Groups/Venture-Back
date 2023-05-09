
@extends('layouts.app')
@section('title') Generador de Beacons @endsection
@section('page_active') Beacons @endsection 
@section('subpage_active') Editar Elemento @endsection 



@section('content')
    {!! Form::model($data, ['url' => $form_url,'files' => true,'method' => 'PATCH']) !!}
    <input type="hidden" value="{{$data->id}}" name="id">
        @include('admin.beacons.form')
    </form>
@endsection