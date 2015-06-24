    <div class="col-md-6">
        <h1>{{$thread->subject}}</h1>

        @foreach($thread->messages as $message)
            <div class="media">
                <a class="pull-left" href="/messages/{{$thread->id}}">
                    <img src="//www.gravatar.com/avatar/{{$message->user->email}}?s=64" alt="{{$message->user->name}}" class="img-circle">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{{$message->user->name}} {{$message->user->lastname}}</h5>
                    <p>{{$message->body}}</p>
                    <div class="text-muted"><small>Posted {{$message->created_at->diffForHumans()}}</small></div>
                </div>
            </div>
        @endforeach

        <h2>Add a new message</h2>
        {{Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT'])}}
        <!-- Message Form Input -->
        <div class="form-group">
            {{ Form::textarea('message', null, ['class' => 'form-control']) }}
        </div>

        @if($users->count() > 0)
        <div class="form-group" style="overflow:hidden">
            @foreach($users as $user)
                <label style="float:left;" title="{{$user->name}} {{$user->lastname}}"><input type="checkbox" name="recipients[]" value="{{$user->id}}">{{$user->name}}</label>
            @endforeach
        </div>
        @endif

        <!-- Submit Form Input -->
        <div class="form-group">
            {{ link_to(URL::previous(), 'Cancelar', ['style' => 'color:green']) }}
            {{ Form::submit('Enviar', ['style' => 'color:green']) }}
        </div>
        {{Form::close()}}
    </div>

