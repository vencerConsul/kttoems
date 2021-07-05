@extends('layouts.app')

@section('title')
    Gallery
@endsection

@section('adminDashboardStyle')
    <link rel="stylesheet" href="{{asset('css/adminPanel/gallery.css')}}">
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
                <a>
                    <li class="sidebar__menu__active">
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
                        <span>Add Survey</span>
                    </li>
                </a>
            </ul>
        </div>
    </div>

    {{-- header --}}
    <div class="header">
        <div class="header__menu__icon">
            <i class="las la-bars"></i>
            <span>Gallery</span>
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
            <div class="alert d-none" id="alert__box">
                <span id="alert__message"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- gallery --}}
            <div class="gallery">
                <div class="gallery__cards">
                    <div class="gallery__card__header">
                        <h5>Galleries</h5>
                        <i class="las la-plus-circle" onclick="document.getElementById('addgallery').click()"></i>
                    </div>
                    <form enctype="multipart/form-data" id="formGallery">
                        @csrf
                        <input type="file" name="imageGallery" id="addgallery" class="d-none" accept="image/*" onchange="addGallery()">
                    </form>
                    
                    <div class="gallery__card__body" id="galleryBox">

                        

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

@section('galleryScript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{{asset('./js/adminPanelScript/gallery.js')}}"></script>
@endsection
