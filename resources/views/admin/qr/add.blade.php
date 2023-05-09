
@extends('layouts.app')
@section('title') Generador de QR @endsection
@section('page_active') Generador de QR @endsection 
@section('subpage_active') Agregar Elemento @endsection 


@section('content')
    {!! Form::model($data, ['url' => [route('add_qr')],'files' => true]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.qr.form')
    </form>
@endsection