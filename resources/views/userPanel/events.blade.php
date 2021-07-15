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
        .event__date{
            background: #295245;
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
                <li class="nav-item"><a href="{{route('events')}}" class="nav-link text-dark">Events</a></li>
                </div>
            </ul>
        </div>
    </div>
</nav>
<!-- Page content-->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1>EVENTS</h1>
                @if($events->count() > 0)
                @foreach ($events as $event)
                <div class="card p-0 mb-2">
                        <div class="row">
                            <div class="col-lg-4 event__date">
                                <div class="p-4 d-flex justify-content-center align-items-center flex-column text-white">
                                    <h1 class="display-4 font-weight-bold">{{date('j', strtotime($event->start))}} </h1>
                                    <h1>{{date('F', strtotime($event->start))}}</h1>
                                    <p>{{date('h:i A', strtotime($event->start))}}</p>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="p-4 d-flex justify-content-center align-items-left flex-column text-dark">
                                    <h2 class="text-capitalize">{{$event->title}}</h2>
                                    <p>Event end: <span class="text-danger">{{date('F j, Y', strtotime($event->end))}} <small>{{date('h:i A', strtotime($event->end))}}</small></span></p>
                                    @if($event->event_status == 'end')
                                    <p>Event was end</p>
                                    <a class="btn btn-success w-50" href="{{URL::to('survey/'.$event->id)}}">Get Certificate</a>
                                    @elseif(strtotime($event->start) <= strtotime(date('Y-m-d') .' '.date('H:i:s')))
                                    <p>Event started</p>
                                    <a class="btn btn-secondary w-50 text-light disabled">Certificate ready</a>
                                    @else
                                    
                                    <a href="{{URL::to('pre-registration/'.$event->id)}}" class="btn btn-info text-white w-50">Pre-register</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach
                @else
                    <img class="img-fluid" src="{{asset('./images_folder/empty.png')}}" alt="empty">
                @endif
            </div>
            <div class="col-lg-4">
                <h1>PAST EVENTS</h1>
                @if($pastEvents->count() > 0)
                    @foreach ($pastEvents as $pEvent)
                        <div class="card mb-3 p-4">
                            <h4 class="text-capitalize">{{$pEvent->title}}</h4>
                            <small class="text-secondary">{{Carbon\Carbon::parse($pEvent->end)->diffForHumans()}}</small>
                            <a href="{{URL::to('survey/'.$pEvent->id)}}" class="btn btn-success my-2">Get Certificate</a>
                        </div>
                    @endforeach
                @else
                    <h3 class="text-center">Empty</h3>
                    <img class="img-fluid" src="{{asset('./images_folder/empty.png')}}" alt="empty">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('userdashboard')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
