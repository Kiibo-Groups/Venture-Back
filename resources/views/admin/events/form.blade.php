@section('styles')
<link href="{{ asset('resources/libs/spectrum-colorpicker2/spectrum.min.css') }}" 
    rel="stylesheet" 
    type="text/css" />
<link href="{{ asset('resources/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" 
    type="text/css" />
<link href="{{ asset('resources/libs/clockpicker/bootstrap-clockpicker.min.css') }}" 
    rel="stylesheet" 
    type="text/css" />
<link href="{{ asset('resources/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" 
    rel="stylesheet" 
    type="text/css" />
@endsection

<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">   
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="portada">Portada</label>
                        <input type="file" name="portada" id="portada" class="form-control" required="required" @if (!$data->id) required="required" @endif>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input class="form-control" id="titulo" type="text" name="titulo" required="required" value="{{ $data->titulo }}">
                    </div> 

                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input class="form-control" id="location" type="text" name="location" required="required" placeholder="Ej.- In-person session | Learn, Engage" value="{{ $data->location }}">
                    </div> 

                    <div class="col-md-6 mb-3">
                        <label for="datetime-datepicker" class="form-label">Fecha del evento</label>
                        <input type="text" id="datetime-datepicker" class="form-control" required="required" placeholder="Basic datepicker">
                    </div> 

                    <div class="col-md-6 mb-3">
                        <label for="register" class="form-label">Url para Pre-Registro</label>
                        <input class="form-control" id="register" type="url" name="register" required="required" value="{{ $data->register }}">
                    </div> 

                    <div class="col-md-6 mb-3">
                        <label for="calendar" class="form-label">Url para Calendario</label>
                        <input class="form-control" id="calendar" type="url" name="calendar" value="{{ $data->calendar }}">
                    </div> 

                   

                    <div class="col-md-6 mb-3">
                        <label for="room" class="form-label">Room</label>
                        <input class="form-control" id="room" type="text" name="room" placeholder="Ej.- Sala Monterrey" value="{{ $data->room }}">
                    </div> 

                    <div class="col-md-6 mb-3">
                        <label class="example-select">Status</label>
                        <select name="status"  id="example-select" class="form-select" required="required">
                            <option value="0" @if($data->status == 0) selected @endif>Activo</option>
                            <option value="1" @if($data->status == 1) selected @endif>Inactivo</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="descript" class="form-label">Descripción</label>
                        <textarea name="descript" id="descript" cols="30" rows="10" class="form-control">{{ $data->descript }}</textarea>
                    </div>  

                   </div>
                </div>

                <div class="mt-5" style="justify-items: end;display: grid;padding:20px;">
                    <button type="submit" class="btn btn-primary mb-2 btn-pill">
                        @if(!$data->id)
                        Agregar
                        @else 
                        Actualizar
                        @endif
                    </button>
                </div>
            </div>
        </div>           
    </div>
</div>

@section('scripts')
<!-- flatpickr --> 
<script src="{{ asset('resources/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('resources/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
<script src="{{ asset('resources/libs/clockpicker/bootstrap-clockpicker.min.js') }}"></script>
<!-- DatePicker -->
<script src="{{ asset('resources/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Init js-->
<script src="{{ asset('resources/js/pages/form-pickers.init.js') }}"></script>
@endsection