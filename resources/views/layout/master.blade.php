<!doctype html>
<head>
		<meta name="viewport" content="initial-scale=1 maximum-scale=1"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<title>Contact Us</title>
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/styles.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/colourtag-page3.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/flexslider.css"  />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/contentcenter.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/ec9on.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/rimage.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/ssoff.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/sslide.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/sidenone.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/olight90.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/fontarial.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/title26.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/fontarialspan.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/bts46.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/btoff.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/fontarialnav.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/nav17.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/fontarialside.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/fontarialheader.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/fontarialcontent.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="themes/Endeavor/css/font13.css" />
		<!-- Include stylesheet for quill -->
		<link href="themes/Endeavor/quilleditor/quill.snow.css" rel="stylesheet">
		@isset($activeImage)
		<style type="text/css" media="all">#feature {background-image: url({{ $activeImage }});}</style>
		@endisset
		<script type="text/javascript" src="themes/Endeavor/javascript.js"></script>
		<script type="text/javascript" src="themes/Endeavor/scripts/jquery-1.7.1.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
		<!-- Include the Quill library -->
		<script src="themes/Endeavor/quilleditor/quill.js"></script>

		@if($noIndex)
		<meta name="robots" content="noindex" />
		@endif
</head>
<!-- Start Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{{ $siteSetup['GoogleAnalytics'] }}', 'auto');
  ga('send', 'pageview');

</script>
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '{{ $siteSetup['facebook'] }}']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id={{ $siteSetup['facebook'] }}&amp;ev=NoScript" /></noscript>
<body>
	<div id="wrapper">
		@include('layout.header')
		<div class="clear"></div>
		<div id="container">
			<section>
				<div id="padding">
					@yield('content')
				</div>
			</section>
		</div>
	</div>
</body>
@include('layout.footer')