@extends('layout.master')

@section('content')

<div class="main-content">

<div id="padding">
	<div>
		<span style="font-size:17px; font-weight:bold; ">BeMo Academic Consulting Inc. </span><br />
		<span style="font-size:13px; font-weight:bold; "><u>Toll Free</u></span>
		<span style="font-size:13px; ">: </span>
		<span style="font-size:14px; ">1-855-900-BeMo (2366)</span>
		<span style="font-size:13px; "><br /></span>
		<span style="font-size:13px; font-weight:bold; "><u>Email</u></span>
		<span style="font-size:13px; ">: </span>
		<span style="font-size:14px; ">{{ $siteSetup['email'] }}</span>
	</div><br />
	<form action="./contact" method="post" enctype="multipart/form-data">
		@csrf
		 <div>
			<label>Name:</label> *<br />
			<input class="form-input-field" id="name" type="text" value="" name="name" size="40"/><br /><br />

			<label>Email Address:</label> *<br />
			<input class="form-input-field" id="email" type="text" value="" name="email" size="40"/><br /><br />

			<label>How can we help you?</label> *<br />
			<textarea class="form-input-field" id="message" name="message" rows="8" cols="38"></textarea><br /><br />

			<div style="display: none;">
				<label>Spam Protection: Please don't fill this in:</label>
				<textarea name="comment" rows="1" cols="1"></textarea>
			</div>
			<input class="form-input-button" id="reset" type="reset" name="resetButton" value="Reset" />
			<input class="form-input-button" type="submit" name="submitButton" value="Submit" />
		</div>
	</form>
</div>
<script type="text/javascript">
	$('#reset').on('click', () => {
		$('#name').val('');
		$('#email').val('');
		$('#message').val('');
	});
</script>

</div>

@endsection