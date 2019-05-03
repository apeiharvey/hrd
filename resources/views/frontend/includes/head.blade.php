<meta name="viewport" content="initial-scale=1.0">
<meta charset="utf-8">

@if(!empty($meta_description))
	<meta name="description" content="{{$meta_description}}" />
@endif
@if(!empty($meta_keywords))
	<meta name="keywords" content="{{strip_tags($meta_keywords)}}" />
@endif
<link rel="icon" href="{{asset('images/frontend/web/'.$fav_icon)}}" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{{asset('css/'.$view_path.'/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/owlcarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/owlcarousel/owl.theme.default.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/'.$view_path.'/buttons.css')}}">
<style type="text/css">
	@font-face{
		font-family:'BebasNeue Bold';
		src: url('{{asset("fonts/bebas_neue/BebasNeue-Bold.otf")}}');
		font-weight:normal;
	}
	@font-face{
		font-family:'BebasNeue';
		src: url('{{asset("fonts/bebas_neue/BebasNeue-Regular.otf")}}');
		font-weight:normal;
	}
	@font-face{
		font-family:'Open Sans';
		src: url('{{asset("fonts/open_sans/OpenSans-Regular.ttf")}}');
		font-weight:normal;
	}
	@font-face{
		font-family:'Open Sans Bold';
		src: url('{{asset("fonts/open_sans/OpenSans-Bold.ttf")}}');
		font-weight:normal;
	}
	@font-face{
		font-family:'Lora Bold';
		src: url('{{asset("fonts/lora/Lora-Bold.ttf")}}');
		font-weight:normal;
	}
	@font-face{
		font-family:'Lora';
		src: url('{{asset("fonts/lora/Lora-Regular.ttf")}}');
		font-weight:normal;
	}
</style>
