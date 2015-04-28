@if(!Auth::check())
<li class="">
	{{ HTML::link('users/register', 'Register', array('class'=>'drop megamenu-top-header')) }} 
</li>
<li class="right">
	{{ HTML::link('users/login', 'Iniciar sesión', array('class'=>'drop megamenu-top-header')) }}
</li>
@else
<li class="">
	{{ HTML::link('#', 'Perfil: '.Auth::user()->name.' '.Auth::user()->lastname  ,array( 'id'=>'perfilLink')) }} 
	<ul class="subPerfil">
		<li><a href="edit/{{ Auth::id(); }}"><i class="topmenu-icon icon-glyph icon-group"></i> Mi perfil </a></li>
		<li>{{ HTML::link('users/logout', 'Cerrar sesión',array('class'=>'')) }}</li>
	</ul>
</li>
<li id="organization-menu" class="">
	@include('layouts.menuOrgResp') 
</li>

<li id="project-menu" class="" > 
	@include('layouts.menuProysResp') 
</li>
@endif