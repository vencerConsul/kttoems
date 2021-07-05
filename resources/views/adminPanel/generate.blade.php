@extends('layouts.app')

@section('title')
    Generate Certificate
@endsection

@section('adminDashboardStyle')
    <link rel="stylesheet" href="{{asset('css/adminPanel/generate.css')}}">
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
                <a>
                    <li class="sidebar__menu__active">
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
                <a href="{{route('survey')}}">
                    <li>
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
            <span>Generate Certificate</span>
        </div>

        <div class="header__title">
            <span>University Of The Cordilleras</span>
        </div>

        <div class="header__avatar">
            <div class="header__avatar__icon">
                <i class="las la-user-tie"></i>
                <span class="dropdown-toggle" data-toggle="dropdown">{{auth()->user()->name}}</span>

                <div class="dropdown-menu mt-4">
                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span>Logout</span> <i class="las la-sign-out-alt"></i></a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- content --}}
    <div class="content">

        <div class="main__content">

            <div class="container">
                <img class="img-fluid" src="" alt="image">
            </div>

        </div>
    </div>
@endsection


