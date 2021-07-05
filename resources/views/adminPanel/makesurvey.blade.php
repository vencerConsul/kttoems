@extends('layouts.app')

@section('title')
    Add Survey
@endsection

@section('adminDashboardStyle')
    <link rel="stylesheet" href="{{asset('css/adminPanel/evaluation.css')}}">
@endsection

@section('content')
    {{-- side menu --}}
    <div class="side__menu">
        <div class="sidebar__brand">
            <img src="{{asset('./images_folder/uc_logo.png')}}" alt="uc logo">
        </div>

        <div class="sidebar__items">
            <ul>
                <a href="{{route('admin')}}">
                    <li>
                        <i class="las la-tachometer-alt"></i>
                        <span>Dashbord</span>
                    </li>
                </a>
                <a href="{{route('calendar')}}">
                    <li>
                        <i class="las la-calendar"></i>
                        <span>Calendar</span>
                    </li>
                </a>
                <a href="{{route('generate')}}">
                    <li>
                        <i class="las la-cogs"></i>
                        <span>Generate Certificate</span>
                    </li>
                </a>
                <a href="{{route('gallery')}}">
                    <li>
                        <i class="las la-photo-video"></i>
                        <span>Gallery</span>
                    </li>
                </a>
                <a href="{{route('evaluation')}}">
                    <li>
                        <i class="las la-poll"></i>
                        <span>Evaluation</span>
                    </li>
                </a>
                <a>
                    <li class="sidebar__menu__active">
                        <i class="las la-pen-square"></i>
                        <span>Survey</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>

    {{-- header --}}
    <div class="header">
        <div class="header__menu__icon">
            <i class="las la-bars"></i>
            <span>Surveys</span>
        </div>

        <div class="header__title">
            <span>University Of The Cordilleras</span>
        </div>

        <div class="header__avatar">
            <div class="header__avatar__icon">
                <i class="las la-user-tie"></i>
                {{auth()->user()->name}} | <i class="las la-sign-out-alt" onclick="event.preventDefault();document.getElementById('logout-form').submit();"></i>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    {{-- content --}}
    <div class="content">

        <div class="main__content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- activities --}}
            <div class="activities">
                <div class="activities__cards">
                    <div class="activities__card__header">
                        <h5>Make Survey for <h1 class="text-capitalize font-weight-bold">{{$events->title}}</h1></h5>
                    </div>
                    <div class="activities__card__body">
                        <form action="{{route('submit.survey')}}" method="post">
                            @csrf
                            <input type="hidden" name="event_id" value="{{$events->id}}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Survey Title</label>
                                        <input type="text" name="survey_title" class="form-control" placeholder="Survey Title">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Survey Question 1</label>
                                        <input type="text" name="survey_question1" class="form-control" placeholder="Survey question 1">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Survey Question 2</label>
                                        <input type="text" name="survey_question2" class="form-control" placeholder="Survey question 2">
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Survey Question 3</label>
                                        <input type="text" name="survey_question3" class="form-control" placeholder="Survey question 3">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Survey Question 4</label>
                                        <input type="text" name="survey_question4" class="form-control" placeholder="Survey question 4">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Survey Question 5</label>
                                        <input type="text" name="survey_question5" class="form-control" placeholder="Survey question 5">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Survey Question 6</label>
                                        <input type="text" name="survey_question6" class="form-control" placeholder="Survey question 6">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


