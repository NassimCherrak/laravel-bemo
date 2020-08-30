<form action="./access" method="post">
	@csrf
	<span>enter site password: </span><input type="password" name="password"/>
	<input type="submit" value="Validate"/>
	<div>
		@if($errors->any())
		<span style="color: red;">{{$errors->first()}}</span>
		@endif
	</div>
</form>