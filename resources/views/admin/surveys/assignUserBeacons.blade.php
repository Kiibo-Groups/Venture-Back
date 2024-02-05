<!-- SignIn modal content -->
<div id="modalAssignUsersBeacons{{$row->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center mt-2 mb-4">
                    <i class="dripicons-checkmark h1 text-white"></i>
                    <h4 class="mt-2 text-white">Selecciona el area a lanzar</h4>
                    <p class="mt-3 text-white">Ingresa el dispositivo para lanzar la encuesta.</p>
                </div>

                
                {!! Form::open(['url' => [$form_url],'files' => true,'method' => 'POST'],['class' => 'px-3']) !!}
                    <input type="hidden" name="survey_id" value="{{$row->id}}">
                    <div class="mb-3">
                        <label for="beacon" class="form-label">Dispositivo Beacon</label>
                        <div class="mt-3">
                            @foreach($beacons as $bc)
                            <div class="form-check">
                                <input type="radio" id="customBC{{$bc->id}}" name="beacon" value="{{$bc->id}}" required class="form-check-input">
                                <label class="form-check-label" for="customBC{{$bc->id}}">
                                    {{$bc->descript}}<br />
                                    <small>(Usuarios registrados: {{ $bc->get_signers_count }} )</small>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
 

                    <div class="mb-2 text-center">
                        <button class="btn rounded-pill btn-primary" type="submit">Lanzar</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->