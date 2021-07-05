@extends('layouts.app')

@section('title')
    Evaluation
@endsection

@section('adminDashboardStyle')
    <link rel="stylesheet" href="{{asset('css/adminPanel/evaluation.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
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
                <a>
                    <li class="sidebar__menu__active">
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
            <span>Evaluation</span>
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

            {{-- activities --}}
            <div class="activities">
                <div class="activities__cards">
                    <div class="activities__card__header">
                        <h5>Evaluation List</h5>
                    </div>
                    <div class="activities__card__body">
                        <div class="card-body table-responsive table-buttons">
                            <table id="evaluationList" class="table dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Fullname</th>
                                        <th>Email</th>
                                        <th>key point 1</th>
                                        <th>key point 2</th>
                                        <th>key point 3</th>
                                        <th>key point 4</th>
                                        <th>key point 5</th>
                                        <th>key point 5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evaluation as $eval)
                                        <tr>
                                            <td>
                                                {{$eval->survey_title}}
                                            </td>
                                            <td class="text-capitalize">{{$eval->firstname . ' '.$eval->lastname}}</td>
                                            <td>{{$eval->email}}</td>
                                            <td>{{$eval->key1}}</td>
                                            <td>{{$eval->key2}}</td>
                                            <td>{{$eval->key3}}</td>
                                            <td>{{$eval->key4}}</td>
                                            <td>{{$eval->key5}}</td>
                                            <td>{{$eval->key6}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@section('evaluationScript')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{asset('js/adminPanelScript/evaluation.js')}}"></script>
@endsection

