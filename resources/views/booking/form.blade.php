<div class="" id="booking-form">
  {{ Form::open( array('url'=> 'booking/'.$cottage->slug.'/book', 'class'=>'form')) }}

  {{ Form::hidden('cottage_id', $cottage->id) }}
  
  {{ Form::hidden('first_night', '') }}
  {{ Form::hidden('depart', '') }}
  <div class="row">
    <div class="col-sm-12">
      <h2>Make your booking now!</h2>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-3">
      {{ Form::label('name', 'Name', array('class'=>'control-label')) }}
      {{ Form::text('name', '', array('class'=> 'form-control', 'placeholder'=>'Your full name', 'required' => 'required')) }}
    </div>
    <div class="form-group col-sm-3">
      {{ Form::label('email', 'Email Address', array('class'=>'control-label')) }}
      {{ Form::text('email', '', array('class'=> 'form-control', 'placeholder'=>'name@example.com', 'required' => 'required')) }}
    </div>
    <div class="form-group col-sm-3">
      {{ Form::label('telephone', 'Phone Number', array('class'=>'control-label')) }}
      {{ Form::text('telephone', '', array('class'=> 'form-control', 'placeholder'=>'Home or mobile number', 'required' => 'required')) }}
    </div>
  </div>
  <div class="row">
    <div class="form-group col-sm-3">
      {{ Form::label('address1', 'First line of your address', array('class'=>'control-label')) }}
      {{ Form::text('address1', '', array('class'=> 'form-control', 'placeholder'=>'Address line 1', 'required' => 'required')) }}
    </div>
    <div class="form-group col-sm-3">
      {{ Form::label('address2', 'Address, line 2', array('class'=>'control-label')) }}
      {{ Form::text('address2', '', array('class'=> 'form-control', 'placeholder'=>'Address line 2')) }}
    </div>
    <div class="form-group col-sm-3">
      {{ Form::label('town', 'Post Town', array('class'=>'control-label')) }}
      {{ Form::text('town', '', array('class'=> 'form-control', 'placeholder'=>'Town', 'required' => 'required')) }}
    </div>
    <div class="form-group col-sm-3">
      {{ Form::label('postcode', 'Postcode', array('class'=>'control-label')) }}
      {{ Form::text('postcode', '', array('class'=> 'form-control', 'placeholder'=>'Postcode', 'required' => 'required')) }}
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group text-center">
        <button type="submit" class="reset-dates btn btn-primary btn-lg">Make my Booking!</button>
      </div>
    </div>
  </div>
  
{{ Form::close() }}
</div>