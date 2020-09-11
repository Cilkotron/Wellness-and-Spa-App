
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        <title>Spa App</title>
       <link rel="shortcut icon" href="{{ asset('frontend/images/loading.gif') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/pricing.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datetimepicker.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <style>
                @foreach($sliders as $key=>$slider)
                    .owl-carousel .owl-wrapper, .owl-carousel .owl-item:nth-child({{ $key + 1 }}) .item
                    {
                        background: url({{ Storage::disk('s3')->url($slider->image)}});
                        background-size: cover;
                    }
                @endforeach
        </style>
    </head>
    <body data-spy="scroll" data-target="#template-navbar">

        <!--== 4. Navigation ==-->
        <nav id="template-navbar" class="navbar navbar-default custom-navbar-default navbar-fixed-top" style="margin-right:auto; margin-left:auto;">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#Food-fair-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="padding-top: 35px; ">
                        <img id="logo" src="frontend/images/new_logo_new.png" class="logo img-responsive">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="Food-fair-toggle">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#about">about</a></li>
                        <li><a href="#services">services</a></li>
                        <li><a href="#reserve">reservation</a></li>
                        <li><a href="#contact">contact</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.row -->
        </nav>

        <!--== 5. Header ==-->
        <section id="header-slider" class="owl-carousel">
            @foreach($sliders as $key=>$slider)
                <div class="item">
                    <div class="container">
                        <div class="header-content pull-right">
                            <h1 class="header-title">{{ $slider->title }}</h1>
                            <p class="header-sub-title">{{ $slider->sub_title }}</p>
                        </div> <!-- /.header-content -->
                    </div>
                </div>
            @endforeach
        </section>


        <!--== 6. About us ==-->
        <section id="about" class="about">
            <img src="{{  asset('frontend/images/icons/about_color.png') }}" class="img-responsive section-icon hidden-sm hidden-xs">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row dis-table">
                        <div class="hidden-xs col-sm-6 section-bg about-bg dis-table-cell">

                        </div>
                        <div class="col-xs-12 col-sm-6 dis-table-cell">
                            <div class="section-content">
                                <h2 class="section-content-title">About us</h2>
                                <p class="section-content-para">
                                Vice woke kinfolk messenger bag, brunch waistcoat kombucha marfa portland mixtape forage YOLO. Swag brooklyn tbh vaporware gastropub YOLO synth heirloom blue bottle celiac keytar ramps. Actually pitchfork wolf cliche coloring book la croix vegan roof party.
                                </p>
                                <p class="section-content-para">
                                Direct trade butcher poke shoreditch pickled listicle, pok pok heirloom. Authentic pug taxidermy, sartorial keytar ethical pinterest jianbing asymmetrical. Hell of shabby chic tumblr chia, yuccie pour-over craft beer semiotics truffaut taiyaki ennui bicycle rights affogato cloud bread. Listicle vice raclette chambray.
                                </p>
                            </div> <!-- /.section-content -->
                        </div>
                    </div> <!-- /.row -->
                </div> <!-- /.container-fluid -->
            </div> <!-- /.wrapper -->
        </section> <!-- /#about -->


        <!--==  7. Afordable Pricing  ==-->
        <section id="services" class="menu-list">
            <div id="w">
                <div class="pricing-filter">
                    <div class="pricing-filter-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="section-header">
                                        <h2 class="pricing-title">Our Services</h2>
                                        <ul id="filter-list" class="clearfix">
                                            <li class="filter" data-filter="all">All</li>
                                            @foreach($categories as $category)
                                                <li class="filter" data-filter="#{{ $category->slug }}">{{ $category->name }} <span class="badge">{{ $category->services->count() }}</span></li>
                                            @endforeach
                                        </ul><!-- @end #filter-list -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <ul id="menu-pricing" class="menu-price">

                                @foreach($services as $service)
                                    <li class="item" id="{{ $service->category->slug }}">
                                        <a href="#">
                                            <img src="{{ Storage::disk('s3')->url($service->image)}}" class="img-responsive" alt="Service" style="height: 300px; width: 369px;" >
                                            <div class="menu-desc text-center">
                                                    <span>
                                                        <h3>{{ $service->name }}</h3>
                                                        {{ $service->description }}
                                                    </span>
                                            </div>
                                        </a>
                                        <h2 class="white">${{ $service->price }}</h2>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!--== 15. Reserve A Tretment! ==-->
        <section id="reserve" class="reserve">
            <img class="img-responsive section-icon hidden-sm hidden-xs" src="{{ asset('frontend/images/icons/reserve_black.png')}}">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row dis-table justify-content-center">
                        <div class="col-xs-6 col-sm-6 dis-table-cell color-bg">
                            <h2 class="section-title">Reserve A Tretment !</h2>
                        </div>
                        <div class="col-xs-6 col-sm-6 dis-table-cell section-bg">

                        </div>
                    </div> <!-- /.dis-table -->
                </div> <!-- /.row -->
            </div> <!-- /.wrapper -->
        </section> <!-- /#reserve -->



        <section class="reservation">
            <img class="img-responsive section-icon hidden-sm hidden-xs" src="{{ asset('frontend/images/icons/reserve_color.png')}}">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <form class="reservation-form" method="post" action="{{ route('reservation.reserve')}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control reserve-form empty iconified" name="name"  placeholder="  &#xf007;  Name">
                                            </div>
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control reserve-form empty iconified"  placeholder="  &#xf1d8;  e-mail">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control reserve-form empty iconified" name="phone"  placeholder="  &#xf095;  Phone">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" autocomplete="off" class="form-control reserve-form empty iconified" name="date_and_time" id="datetimepicker1"  placeholder="&#xf017;  Time">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-">
                                            <select class="form-control reserve-form empty iconified" name="service_id" style="font-family: FontAwesome; font-style: normal; font-weight: normal;">
                                                <option selected disabled>&#9881; Pick Service</option>
                                                @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <textarea type="text" name="message" class="form-control reserve-form empty iconified"  rows="3"  placeholder="  &#xf086;  Live a message"></textarea>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <button type="submit" id="submit" name="submit" class="btn btn-reservation">
                                                <span><i class="fa fa-check-circle-o"></i></span>
                                                Make a reservation
                                            </button>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="col-md-2 hidden-sm hidden-xs"></div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="opening-time">
                                    <h3 class="opening-time-title">Hours</h3>
                                    <h5>Mon to Fri: <strong>09:00-21:00</strong> </h5>
                                    <h5>Sat: <strong style="padding-left: 45px;"><span>09:00-21:00</span></strong></h5>
                                    <h5>Sun: <strong style="padding-left: 42px;"><span>Closed</span></strong></h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container-fluid color-bg">
                <div class="row dis-table">
                    <div class="hidden-xs col-sm-6 dis-table-cell">
                        <h2 class="section-title">Get In Touch</h2>
                    </div>
                    <div class="col-xs-6 col-sm-6 dis-table-cell">
                        <div class="section-content">
                            <p>55 Branka Krsmanovica Street, Nis</p>
                            <p>+381 18 213584</p>
                            <p>example@mail.com </p>
                        </div>
                    </div>
                </div>
                <div class="social-media">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <ul class="center-block">
                                <li><a href="https://www.facebook.com" class="fb"></a></li>
                                <li><a href="https://twitter.com" class="twit"></a></li>
                                <li><a href="https://www.linkedin.com/in/sanjabudic/" class="link"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container-fluid">
            <div class="row">
                <div id="map-canvas"></div>
            </div>
        </div>



        <section class="contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                        <div class="row">
                             <form class="contact-form" method="post" action="{{ route('contact.send') }}">
                                @csrf
                                @method('POST')
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <input  name="name" type="text" class="form-control" id="name" required="required" placeholder="  Name">
                                    </div>
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" id="email" required="required" placeholder="  Email">
                                    </div>
                                    <div class="form-group">
                                        <input name="subject" type="text" class="form-control" id="subject" required="required" placeholder="  Subject">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <textarea name="message" type="text" class="form-control" id="message" rows="7" required="required" placeholder="  Message"></textarea>
                                </div>

                                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                                    <div class="text-center">
                                        <button type="submit" id="submit" name="submit" class="btn btn-send">Send </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer>
            <div class="container-fluid fixed-bottom">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="copyright text-center">
                            <p>
                                &copy; Wellness&Spa 2020 <a href="#"></a> Developed with &#10084; By <a href="https://www.linkedin.com/in/sanjabudic/"  target="_blank">Me</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="{{ asset('frontend/js/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.mixitup.min.js') }}" ></script>
        <script type="text/javascript" src="{{ asset('frontend/js/wow.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.hoverdir.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/jQuery.scrollSpeed.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-datetimepicker.min.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        @if($errors->any())
            @foreach ($errors->all() as $error)
            <script>
                toastr.error('{{ $error }}');
            </script>
            @endforeach
        @endif

        <script>
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    timeFormat: 'dd MM yyyy - HH:ii',
                    startDate: '+0d',
                    autoclose: true,
                    hoursDisabled: '0,1,2,3,4,5,6,7,8,21,22,23',
                    daysOfWeekDisabled: '0',
                    minuteStep: '30'
                });
            })
        </script>

        {!! Toastr::message() !!}

        <script type="text/javascript" src="{{ asset('frontend/js/jquery.flexslider.min.js') }}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('.flexslider').flexslider({
                 animation: "slide",
                 controlsContainer: ".flexslider-container"
                });
            });
        </script>

        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
                var mapCanvas = document.getElementById('map-canvas');
                var mapOptions = {
                    center: new google.maps.LatLng(43.32472, 21.90333),
                    zoom: 16,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
                var map = new google.maps.Map(mapCanvas, mapOptions)

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(43.32472, 21.90333),
                    title:"Spa App"
                });

                // To add the marker to the map, call setMap();
                marker.setMap(map);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

    </body>
</html>
