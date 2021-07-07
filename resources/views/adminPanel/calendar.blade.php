@extends('layouts.app')

@section('title')
    Calendar
@endsection

@section('adminDashboardStyle')
    <link rel="stylesheet" href="{{asset('css/adminPanel/calendar.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <a>
                    <li class="sidebar__menu__active">
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
            <span>Calendar</span>
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
                    <div id="calendar"></div> 
                </div>
            </div>

            <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Event title</label>
                        <input type="text" id="event-title" class="form-control" placeholder="Event Title">
                    </div>
                    <div class="form-group">
                        <label>Start of Event | Time</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text" id="startDate"></div>
                            </div>
                            <input type="time" id="event-start" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                    <label>End of Event</label>
                        <input type="datetime-local" id="event-end" class="form-control" min="2021-07-04">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="eventAdd">Add Event</button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    @section('fullcalendarscript')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script>
    
    $(document).ready(function () {

        var SITEURL = "{{ url('/') }}";
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var today = new Date();
        today.setDate(today.getDate() - 1);

        // elem = document.getElementById("event-end")
        // var minDate = moment().format("YYYY-MM-DDThh:mm:ss");
        // elem.min = minDate

        var calendar = $('#calendar').fullCalendar({ 
            editable: true,
            header:{
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: SITEURL + "/admin/calendar",
            editable: true,
            displayEventTime: false,
            editable: true,
            selectHelper: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                        event.allDay = true;
                } else {
                        event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            // validRange: {
            //     start: today
            // },
            select: function (start, end, allDay) {

                
                $('#eventModal').modal('show');

                // START EVENT
                var startEvent = moment(start._d).format('LL')
                document.getElementById('startDate').innerHTML = startEvent;

                // CALENDAR BOX CLICK
                document.querySelector('#eventAdd').addEventListener('click', function(){
                    // TITLE EVENT
                    let title = document.querySelector('#event-title').value

                    // original value of event start time
                    let getStartEventTime = document.getElementById('event-start').value

                    // get am and pm
                    let timeSplit = getStartEventTime.split(':'),
                        hours,
                        minutes,
                        meridian;
                    hours = timeSplit[0];
                    minutes = timeSplit[1];
                    if (hours > 12) {
                        meridian = 'PM';
                        hours -= 12;
                    } else if (hours < 12) {
                        meridian = 'AM';
                        if (hours == 0) {
                        hours = 12;
                        }
                    } else {
                        meridian = 'PM';
                    }

                    // final start time
                    let startEventTime = hours + ':' + minutes
                    // END EVENT
                    let endEvent = document.querySelector('#event-end').value

                    let toStartTimeTwentyFourHours = startEventTime + ' ' + meridian;
                    let toEndTimeTwentyFourHours = moment(endEvent).format('hh:mm a');

                    let starttime = moment(toStartTimeTwentyFourHours, "h:mm A").format("HH:mm")
                    let endtime = moment(toEndTimeTwentyFourHours, "h:mm A").format("HH:mm")

                    let st = moment(start._d).format('YYYY-MM-DD') + ' ' + starttime
                    let en = moment(endEvent).format('YYYY-MM-DD') + ' ' + endtime

                    if (title != '' && endEvent != '') {
                        
                        $.ajax({
                            url: SITEURL + "/admin/fullcalenderAjax",
                            data: {
                                title: title,
                                start: st,
                                end: en,
                                starttime: st,
                                endtime: en,
                                type: "add"
                            },
                            type: "POST",
                            success: function(data) {
                                $('#eventModal').modal('hide');
                                displayMessage("Event Created Successfully, Make a Survey to post it");

                                calendar.fullCalendar(
                                    "renderEvent",
                                    {
                                        id: data.id,
                                        title: title,
                                        start: st,
                                        end: en,
                                        allDay: allDay,
                                    },
                                    true
                                );

                                calendar.fullCalendar("unselect");
                            }
                        });
                    }else{
                        alert('fill all field')
                    }
                })
            },
            eventDrop: function (event, delta) {
                console.log(event);

                let st = moment(event.start._d).format('YYYY-MM-DD') + ' ' + moment(moment(event.start._d).format('YYYY-MM-DD') + ' ' + event.starttime).format('hh:mm')
                let en = moment(event.end._d).format('YYYY-MM-DD') + ' ' + moment(moment(event.end._d).format('YYYY-MM-DD') + ' ' + event.endtime).format('hh:mm')
                

                // console.log(st, en); 
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                $.ajax({
                    url: SITEURL + '/admin/fullcalenderAjax',
                    data: {
                        title: event.title,
                        start: st,
                        end: en,
                        id: event.id,
                        type: 'update'
                    },
                    type: "POST",
                    success: function (response) {
                        displayMessage("Event Updated Successfully");
                    }
                });
            },
            eventClick: function (event) {
                var deleteMsg = confirm("Do you really want to delete?");
                if (deleteMsg) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + '/admin/fullcalenderAjax',
                        data: {
                                id: event.id,
                                type: 'delete'
                        },
                        success: function (response) {
                            calendar.fullCalendar('removeEvents', event.id);
                            displayMessage("Event Deleted Successfully");
                        }
                    });
                }
            }
        });
    });
        function displayMessage(message) {
            toastr.success(message, 'Event');
        } 

    </script>
    @endsection

@endsection
