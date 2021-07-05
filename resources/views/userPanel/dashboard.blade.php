@extends('layouts.app')
@section('title')
    Event
@endsection
@section('userdashboard')
    <style>
        .galleries .card-body{
            padding: 1rem 0;
            columns: 3;
            column-gap: 10px;
        }
        .galleries .card-body .image-box {
            max-width: 60rem;
            display: column;
            gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-template-rows: masonry;
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
                <li class="nav-item"><a class="nav-link text-dark"><i class="las la-user-tie las-lg"></i></a></li>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{auth()->user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span>Logout</span> <i class="las la-sign-out-alt"></i></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
<!-- Page content-->
<div class="container-fluid py-5">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100 card-img-top" src="{{asset('images_folder/uc_background.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100 card-img-top" src="{{asset('images_folder/uc_background.jpg')}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100 card-img-top" src="{{asset('images_folder/uc_background.jpg')}}" alt="Third slide">
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
                <div class="card-body">
                    <h2 class="card-title">UC KTTO EVENT MANAGEMENT SYSTEM</h2>
                    <p class="card-text">UC KTTO Event Management System helps organizers plan, execute and report on events. Event management involves overseeing all logistics leading up to and during an event, whether a conference, wedding, or any organized gathering.</p>
                </div>
            </div>
            <!-- Nested row for non-featured blog posts-->
            <h1>EVENTS</h1>
            @if($events->count() > 0)
            <div class="row">
                @foreach ($events as $event)
                
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title h4">{{$event->title}}</h2>
                            <br />
                            @if($event->event_status == 'end')
                            <p>Event was end</p>
                            <a class="btn btn-success" href="{{URL::to('user/survey/'.$event->id)}}">Get Certificate</a>
                            @elseif(strtotime($event->start) <= strtotime(date('Y-m-d') .' '.date('H:i:s')))
                            <p>Event started</p>
                            <a class="btn btn-info text-light disabled">Certificate ready</a>
                            @else
                            <p class="card-text">Event Start on <span class="text-success">{{date('F j, Y', strtotime($event->start))}} <span class="text-danger">{{date('h:i A', strtotime($event->start))}}</span></span> until <span class="text-success">{{date('F j, Y', strtotime($event->end))}} <span class="text-danger">{{date('h:i A', strtotime($event->end))}}</span></span></p>
                            <a class="btn btn-secondary disabled">Ongoing Event</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <h4>Empty Events</h4>
            @endif
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Categories widget-->
            <div class="card mb-4 galleries">
                <div class="card-header">Galleries</div>
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
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Kttoems 2021</p></div>
</footer>
@endsection

@section('userdashboard')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
