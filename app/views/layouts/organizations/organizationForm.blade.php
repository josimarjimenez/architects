 <br><br>
<div id="selectOrganization">
	<div class="panel panel-default">
		<h1>ORGANIZATION</h1>

		{{ Form::open('register', 'post') }}

		{{ Form::label('name', 'Name') . Form::text('name', Input::old('name')) }}
		{{ Form::label('test', 'Test') . Form::text('test', Input::old('test')) }}
		{{ Form::label('logo', 'Logo') . Form::file('logo') }}}
		{{ Form::label('address', 'Address') . Form::text('address', Input::old('address')) }}
		{{ Form::label('webPage', 'WebPage') . Form::text('webPage', Input::old('webPage')) }}
		{{ Form::label('create_at', 'Create_at') . Form::time('create_at') }}
		{{ Form::label('update_at', 'Update_at') . Form::time('update_at') }}

		{{ Form::submit('ORGANIZATION')}}

		{{ Form::token() . Form::close() }}

	</div>
</div>

