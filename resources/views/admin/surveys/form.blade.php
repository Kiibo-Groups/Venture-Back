 
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">   
                <div class="card-body">
                   <div class="row">
                     
                    

                    <div class="col-md-6 mb-3">
                        <label class="example-select">Status</label>
                        <select name="status"  id="example-select" class="form-select" required="required">
                            <option value="0" @if($data->status == 0) selected @endif>Activo</option>
                            <option value="1" @if($data->status == 1) selected @endif>Inactivo</option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="script" class="form-label">Script <small>( Obtenlo de <a href="https://www.surveyhero.com" target="_blank">surveyhero.com</a> )</small> </label>
                        <textarea name="script" id="script" cols="10" rows="5" class="form-control">{{ $data->script }}</textarea>
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
 