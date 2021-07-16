@extends('layouts.app')
@section('title')
    Event
@endsection
@section('userdashboard')
    <style>
        .right-box .card-body{
            padding: 1rem 0;
            columns: 3;
            column-gap: 10px;
        }
        .right-box .card-body .image-box {
            max-width: 60rem;
            display: column;
            gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-template-rows: masonry;
        }
        .right-box .card-header{
            text-align: center;
            background-color: #032100;
            color: white;
        }
        .events .card-header{
            text-align: center;
            background-color: #032100;
            color: white;
        }
        .top img{
            width: 100%;
            position: relative;
            margin: auto;
        }
        .row2 {
            width: 80%;
            margin: auto;
        }
        .col-lg-8{
            float: left;
            padding: 10px;
        }
        .col-lg-4{
            float: left;padding: 10px;
        }
        .img-1{
            width: 45%;
            height: auto;
            float: left;
            padding-right: 10px;
        }
    </style>
@endsection
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#!"><img src="{{asset('./images_folder/uc_logo.png')}}" alt="uc logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-dark"><i class="las la-home"></i>HOME</a></li>
                <li class="nav-item"><a href="/events" class="nav-link text-dark"><i class="las la-calendar"></i>EVENTS</a></li>
                <li class="nav-item"><a class="nav-link text-dark"><i class="las la-book-open"></i>LIBRARY</a></li>
		<li class="nav-item">
                    <div class="input-group rounded">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                    <i class="las la-search"></i>
                    </span>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link text-dark"><i class="las la-user-tie las-lg"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Page content-->
<div class="container-fluid">
    <div class="row1">
            <div class="card mb-4 slideshow">
                <a href="#!">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100 card-img-top img-fluid" src="{{asset('images_folder/empty.png')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100 card-img-top img-fluid" src="{{asset('images_folder/4.png')}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100 card-img-top img-fluid" src="{{asset('images_folder/8.jpg')}}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </a>
                <div class="card-body" style="background-color: #032100;">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    <div class="row2">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Nested row for non-featured blog posts--> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card events" style="background-color: #f0f0f0;">
                        <div class="card-header"> FEATURED EVENTS</div>
                        @if($events->count() > 0)
                            @foreach ($events as $event)
                            <div class="card-body d-flex">
                                <img src="{{asset('./images_folder/empty.png')}}" alt="" style="width: 300px;">
                                <div class="p-2">
                                    <h2 class="card-title text-capitalize font-weight-bold text-info" >{{$event->title}}</h2>
                                    <p>
                                        {{$event->description}}
                                    </p>
                                    @if($event->event_status == 'end')
                                    <a class="btn btn-success" href="{{URL::to('user/survey/'.$event->id)}}">Get Certificate</a>
                                    @elseif(strtotime($event->start) >= strtotime(date('Y-m-d') .' '.date('H:i:s')))
                                    <a class="btn btn-info text-light disabled">Ongoing Event</a>
                                    @else
                                    <p class="card-text">Event will Start on <span class="text-success">{{date('F j, Y', strtotime($event->start))}} <span class="text-danger">{{date('h:i A', strtotime($event->start))}}</span></span> until <span class="text-success">{{date('F j, Y', strtotime($event->end))}} <span class="text-danger">{{date('h:i A', strtotime($event->end))}}</span></span></p>
                                    <a href="" class="btn btn-secondary disabled">Event waiting</a>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        @else
                            <h4>Empty Events</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Categories widget-->
            <div class="card mb-4 right-box">
                <div class="card-header">CALENDAR</div>
                @if($gallery->count() > 0)
                <div class="card-body">
                    @foreach($gallery as $gal)
                    <div class="image-box">
                        <a href="{{URL::to('/')}}/images_folder/gallery/{{$gal->image_name}}" target="_blank">
                            <img class="p-1 img-fluid" src="{{asset('images_folder/gallery/'.$gal->image_name)}}" alt="image">
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                    <h1 class="text-center">Empty Gallery</h1>
                @endif
            </div>
            <div class="card mb-4 right-box">
                <div class="card-header">ANNOUNCEMENTS</div>
                @if($gallery->count() > 0)
                <div class="card-body">
                    @foreach($gallery as $gal)
                    <div class="image-box">
                        <a href="{{URL::to('/')}}/images_folder/gallery/{{$gal->image_name}}" target="_blank">
                            <img class="p-1 img-fluid" src="{{asset('images_folder/gallery/'.$gal->image_name)}}" alt="image">
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                    <h1 class="text-center">Empty Gallery</h1>
                @endif
            </div>
            <div class="card mb-4 right-box">
                <div class="card-header">FEATURED VIDEOS</div>
                @if($gallery->count() > 0)
                <div class="card-body">
                    @foreach($gallery as $gal)
                    <div class="image-box">
                        <a href="{{URL::to('/')}}/images_folder/gallery/{{$gal->image_name}}" target="_blank">
                            <img class="p-1 img-fluid" src="{{asset('images_folder/gallery/'.$gal->image_name)}}" alt="image">
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                    <h1 class="text-center">Empty Gallery</h1>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<!-- <footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Kttoems 2021</p></div>
</footer> -->
@endsection

@section('userdashboard')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
