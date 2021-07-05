@extends('layouts.app')
@section('title')
    Thank You
@endsection

@section('thankyou')
<style>
    .box{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endsection
@section('content')
    <div class="box text-center">
        <h1 class="display-3">Thank you for participating</h1>
        <p class="lead">
            <strong>Please check your email</strong> to download your Certificate
        </p>
        <hr>
        <p class="lead">
                <a class="btn btn-dark" href="{{route('user')}}" role="button">Home
            </a>
        </p>
    </div>
@endsection
