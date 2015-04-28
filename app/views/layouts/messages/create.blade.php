
<h1>Crear nuevo mensaje</h1>
{{Form::open(['route' => 'messages.store'])}}
<div class="col-md-6">
    <!-- Subject Form Input -->
    <div class="form-group">
        {{ Form::label('subject', 'Asunto', ['class' => 'control-label']) }}
        {{ Form::text('subject', null, ['class' => 'form-control']) }}
    </div>

    <!-- Message Form Input -->
    <div class="form-group">
        {{ Form::label('message', 'Mensaje', ['class' => 'control-label']) }}
        {{ Form::textarea('message', null, ['class' => 'form-control']) }}
    </div>

    @if($users->count() > 0)
<!--    <div class="checkbox">-->
        <div class="form-group" style="overflow:hidden">
        @foreach($users as $user)
            <label style="float:left;" title="{{$user->name}} {{$user->lastname}}"><input type="checkbox" name="recipients[]" value="{{$user->id}}">{{$user->name}}</label>
        @endforeach
        </div>
    <!--</div>-->
    @endif
    </br>
    <!-- Submit Form Input -->
    <div class="form-group">
        {{ link_to(URL::previous(), 'Cancelar', ['class' => 'btn btn-danger btn-sm']) }}
        {{ Form::submit('Guardar', ['class' => 'btn btn-primary form-control', 'float' => 'right' ]) }}
    </div>
</div>
{{Form::close()}}

