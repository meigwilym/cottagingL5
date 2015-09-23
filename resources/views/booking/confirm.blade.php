@extends('layouts.default')

@section('title')
Your cottage is confirmed!
@stop

@section('main')


<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <h2>Your cottage is booked!</h2>
    <p class="lead">Payment has successfully been made. </p>
    
    <p>An email has been sent to {{ $booking->user->email }} confirming the details. </p>
        
  </div>
</div>

@stop