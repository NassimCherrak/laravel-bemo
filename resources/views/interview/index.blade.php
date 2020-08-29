@extends('layout.master')

@section('content')

<div class="main-content all-content">

<div id="preview">
	
</div>
<!-- Create the editor container -->
<div id="edito-box">
	<div id="editor">
		{!! $homeContent['contentbody'] !!}
	</div>
</div>
@if(session()->has('user'))
<form action="./" method="post">
	@csrf
	<input type="hidden" name="quill-html" id="quill-html">
	<input type="hidden" name="content-id" value="{{ $homeContent['id'] }}">

	<div>
		<button id="btn-preview" type="button">Preview</button>
		<button id="btn-submit" type="button">Apply my changes</button>
	</div>
</form>
<!-- Initialize Quill editor -->
<script>
  	var quill = new Quill('#editor', {
    	theme: 'snow'
  	});

  	$(document).ready(function(){
  		var retrievedHtml = '{!! $homeContent['contentbody'] !!}';
  		$('#preview').html(retrievedHtml);
	});

  	$('#btn-submit').on('click', () => { 
    	// Get HTML content
    	var html = quill.root.innerHTML;

	    // Copy HTML content in hidden form
    	$('#quill-html').val(html);

	    // Post form
    	$("form").submit();
	});

	$('#btn-preview').on('click', () => {
		var html = quill.root.innerHTML;
		$('#preview').html(html);
	});
</script>
@endif
</div>

@endsection