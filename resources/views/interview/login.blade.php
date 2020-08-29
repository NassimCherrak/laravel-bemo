@extends('layout.master')

@section('content')

<div class="main-content">

<div id="padding">
	<form action="./login" method="post" enctype="multipart/form-data">
		@csrf
		 <div>
			<label>Account:</label><br />
			<input class="form-input-field" id="user" type="text" value="" name="user" size="40" required/><br /><br />

			<label>Password:</label><br />
			<input class="form-input-field" id="password" type="password" value="" name="password" size="40" required/><br /><br />

			<input class="form-input-button" type="submit" name="submitButton" value="Submit" />
		</div>
		<div>
			@if($errors->any())
			<span style="color: red;">{{$errors->first()}}</span>
			@endif
		</div>
	</form>
</div>

</div>

@endsection