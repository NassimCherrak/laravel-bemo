@extends('layout.master')

@section('content')

<div class="main-content">

<div id="padding">
	<div class="all-content">
		@foreach($changes as $change)
		<span>{{ $change }}</span><br/>
		@endforeach
	</div>
</div>

</div>

@endsection