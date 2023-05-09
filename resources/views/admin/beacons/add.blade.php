
@extends('layouts.app')
@section('title') Generador de Beacons @endsection
@section('page_active') Beacons @endsection 
@section('subpage_active') Agregar Elemento @endsection 


@section('content')
    {!! Form::model($data, ['url' => [$form_url],'files' => true]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.beacons.form')
    </form>
@endsection