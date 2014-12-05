 <br><br>
<h3>Mis projects</h3>
<ul>
@foreach ($projects as $project)
    <li>Fecha: {{ $project->startDate }}</li>
@endforeach
</ul>