<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">   
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="descript" class="form-label">Descripción</label>
                        <input type="text" class="form-control slug-descript"  id="descript" name="descript" value="{{$data->descript}}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="uuid" class="form-label">UUID del elemento</label>
                        <input type="text" class="form-control slug-uuid"  id="uuid" name="uuid" value="{{$data->uuid}}">
                    </div>
 
                    <div class="col-md-6 mb-3">
                        <label class="example-select">Status</label>
                        <select name="status"  id="example-select" class="form-select" required="required">
                            <option value="1" @if($data->status == 1) selected @endif>Activo</option>
                            <option value="0" @if($data->status == 0) selected @endif>Inactivo</option>
                        </select>
                        
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