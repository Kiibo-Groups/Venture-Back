
@extends('layouts.app')
@section('title') Generador de QR @endsection
@section('page_active') Generador de QR @endsection 
@section('subpage_active') Editar Elemento @endsection 



@section('content')
    {!! Form::model($data, ['url' => $form_url,'files' => true,'method' => 'PATCH']) !!}
    <input type="hidden" value="{{$data->id}}" name="id">
        @include('admin.qr.form')
    </form>
@endsection