<div id="hwrap">
	<header class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
		<div id="headwrap">
			<div id="titlelogo">
				<a href="">				
					<div id="logo"><img src="themes/Endeavor/images/bemo-logo2.png" width="167" height="100" alt="Site logo"/></div>	
				<h1></h1></a>
				<h2></h2>
			</div>
			<div id="mwrap">
				<div id="lt"></div>
				<div id="lm"></div>
				<div id="lb"></div>
			</div>
			<div id="nwrap">
				<div id="menuBtn"></div>
				<nav>
					<ul class="navigation">
						<li id="current">
							<a href="./" rel="self" id="current">Main</a>
						</li>
						<li>
							<a href="./contact" rel="self">Contact Us</a>
						</li>
						@if(session()->has('user'))
						<li>
							<a href="./admin" rel="self">Control Panel</a>
						</li>
						<li>
							<a href="./logout" rel="self">Logout</a>
						</li>
						@else
						<li>
							<a href="./login" rel="self">Login</a>
						</li>
						@endif
					</ul>
				</nav>						
			</div>
		</div>
	</header>
	<div class="banner video_banner">
		<div id="feature" class="bghide">
			@isset($activeImage)
			<img id="featureImg" src="{{ $activeImage }}">
			@endisset
			<div id="extraContainer11">
				<div class="videoWrapper">
										    
				</div>
			</div>		
			<div id="extraContainer1">
			</div>		
			<div class="banner-text">	
			</div>
			<div id="extraContainer9">
				{{ $activeTitle }}
			</div>
		</div>			
	</div>
</div>