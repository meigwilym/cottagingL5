@extends('layouts.default')

@section('title')
Your cottage is confirmed!
@stop

@section('main')
<div class="row">
  <div class="col-sm-12">
    <h2>{{ $bkng['name'] }}</h2>
    <p class="lead">From: {{ $bkng['first_night'] }} To: {{ $bkng['depart'] }} ({{ $bkng['nights'] }} Nights) Cost: {{ $bkng['amount'] }}</p>
    
    {{ HTML::ul($errors->all(), array('class'=>'alert alert-danger')) }}
    
  </div>  
</div>

<?php echo $form; ?>

@stop