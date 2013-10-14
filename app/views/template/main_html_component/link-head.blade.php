@if(App::environment() == "prod")
	{{-- CDN link --}}
	<link rel="stylesheet" type="text/css" href="http://cdn.vieassociative.fr/css/compiled.css" />
@else
	{{-- Direct link --}}
		<link href="/css/less/include.less" rel="stylesheet/less" type="text/css" />
		<script src="/js/vendor/less.min.js" type="text/javascript"></script>
	{{-- With less
	<link rel="stylesheet" type="text/css" href="/css/compiled.css" />
	--}}
@endif