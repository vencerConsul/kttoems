@extends('layouts.app')
@section('title')
    Survey
@endsection

@section('usersurvey')
    <link rel="stylesheet" href="{{asset('/css/userPanel/survey.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="card border-0">
            <div class="card-body">

            @if (\Session::has('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {!! \Session::get('success') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
                <a href="{{route('user')}}" class="btn btn-secondary my-5"><i class="las la-angle-double-left"></i> Back to Homepage</a>
                <h1 class="text-uppercase">{{ $surveys->survey_title }}</h1>
                <p>Thank you for taking the time to fill in our online feedback form. By providing us your feedback, you are helping us understand what we do well and what improvements we need to implement.</p>
                <h2>We will send your Certificate on your email after filling up this form</h2>

                <form action="{{route('submit.feedback')}}" method="post">
                    @csrf
                    <input type="hidden" name="survey_id" value="{{ $surveys->id }}">
                    <div class="form-group">
                        <label class="font-weight-bold">Title</label>
                        <input type="text" name="survey_title" value="{{old('survey_title')}}" placeholder="Survey Title" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Firstname</label>
                        <input type="text" name="firstname" value="{{old('firstname')}}" placeholder="Firstname" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Middle name</label>
                        <input type="text" name="middlename" value="{{old('middlename')}}" placeholder="Middle name" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Lastname</label>
                        <input type="text" name="lastname" value="{{old('lastname')}}" placeholder="Lastname" class="form-control @error('email') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Suffix</label>
                        <select name="suffix" class="form-control @error('suffix') is-invalid @enderror">
                            <option value="N/A">N/A</option>
                            <option value="Jr">Jr</option>
                            <option value="Sr">Sr</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Email</label>
                        <input type="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                    </div>

                    <h4>How satisfied were you with:<span>*</span></h4>
                    <!-- table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="first-col"></th>
                                <th>Very Satisfied</th>
                                <th>Satisfied</th>
                                <th>Unsatisfied</th>
                                <th>Very Unsatisfied</th>
                            </tr>
                            @php $counter = 0; @endphp
                            @foreach($questions as $ques)
                            @php 

                            $counter++;
                            $data = [
                                'key' => $ques,
                                'index' => $counter,
                            ];
                            @endphp
                            <tr class="text-center">
                                <td class="first-col text-left">{{$data['key']}}</td>
                                <td><input type="radio" value="Very Satisfied" name="key{{$data['index']}}" /></td>
                                <td><input type="radio" value="Satisfied" name="key{{$data['index']}}" /></td>
                                <td><input type="radio" value="Unsatisfied" name="key{{$data['index']}}" /></td>
                                <td><input type="radio" value="Very Unsatisfied" name="key{{$data['index']}}" /></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h4  class="font-weight-bold">Feel free to add any other comments or suggestions:</h4>
                    <textarea rows="5" class="form-control @error('email') is-invalid @enderror" name="comment" value="{{old('comment')}}"></textarea>
                    <small class="text-danger">* The information given within the Feedback Form will be used for service improvement only and are strictly confidential.</small>
                    <div class="btn-block">
                        <button type="submit" class="btn btn-success btn-block">Send Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
