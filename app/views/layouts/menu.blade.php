@if(!Auth::check())
<li class="right">
	{{ HTML::link('users/register', 'Register', array('class'=>'drop megamenu-top-header')) }} 
</li>
<li class="right">
	{{ HTML::link('users/login', 'Iniciar sesión', array('class'=>'drop megamenu-top-header')) }}
</li>

@else
<li class="right">
	{{ HTML::link('users/logout', 'Cerrar sesión',array('class'=>'drop megamenu-top-header')) }}
</li>
<li id="navbar-project-menu" class="right" > 
	
</li>
<li id="navbar-organization-menu" class="right"> 
	@include('layouts.menuOrg')
</li>


<!--
<li id="navbar-project-menu" class="right"> 
</li>

-->
@endif