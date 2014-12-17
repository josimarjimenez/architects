 <br><br>
<h3>MI empresa</h3>
<ul>
@foreach ($scrumStates as $state)
    <li>Nombre: {{ $state->name}}</li>
@endforeach

</ul>