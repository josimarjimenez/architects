@if(!Auth::check())
<!--
<li class="right">
	{{ HTML::link('users/register', 'Register....', array('class'=>'drop megamenu-top-header')) }} 
</li>
-->
<li class="right">
	{{ HTML::link('users/login', 'Iniciar sesión', array('class'=>'drop megamenu-top-header')) }}
</li>

@else
<li class="right">

	{{ HTML::link('#', 'Perfil',array('class'=>'drop megamenu-top-header', 'id'=>'perfilID')) }}
	<div id="perfil" class="drop8columns dropcontent pull-left-450" style="left: auto; display: none; max-height: 639px;">
		<h3 class="col_6">Bienvenido: {{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3> 
		<div style="clear:both"></div> 
		<div class="col_6">
			<ul class="project-menu-horizontal-list">
				<li>
					<!--<a href="edit/{{ Auth::id(); }}"><i class="topmenu-icon icon-glyph icon-group"></i>Mi perfil</a>
					<a href="users/editProfile"><i class="topmenu-icon icon-glyph icon-group"></i>Mi perfil</a> -->
					@if(empty(Auth::user()->avatar))
						{{ HTML::link('users/editprofile', 'Mi perfil',array('class'=>'drop megamenu-top-header')) }}
					@else
						{{ HTML::image("uploads/users/".Auth::user()->avatar,
							'alt', 
							array(
								'width' => 48
								)
							) }}
						{{ HTML::link('users/editprofile', 'Mi perfilshh', array('class'=>'drop megamenu-top-header')) }}
					@endif
				</li>
				<li>
					{{ HTML::link('users/logout', 'Cerrar sesión',array('class'=>'drop megamenu-top-header')) }}
				</li>
			</ul>
		</div> 
	</div> 
</li>
<li id="navbar-project-menu" class="right" > 
	
</li>
<li id="navbar-organization-menu" class="right"> 
	@include('layouts.menuOrg')
</li>
@endif