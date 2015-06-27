    <a href="/messages/create" style="text-decoration:none; vertical-align:middle" 
    class="btn btn-success pull-right">
    <i class="icon-plus-sign"></i> 
    Nuevo mensaje
    </a>
    <br>
    <h2>Lista de mensajes</h2>
    <br>

    @if (Session::has('error_message'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error_message')}}
        </div>
    @endif
    @if($threads->count() > 0)
        @foreach($threads as $thread)
        <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
        <div class="media alert {{$class}}">
            <h4 class="media-heading">{{link_to('messages/' . $thread->id, $thread->subject)}}</h4>
            <p>{{$thread->latestMessage->body}}</p>
            <p><small><strong>Participantes:</strong> {{ $thread->participantsString(Auth::id()) }}</small></p>
        </div>
        @endforeach
    @else
        <p>Disculpa, no existen mensajes...</p>
    @endif

