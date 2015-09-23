@extends('layouts.default')

@section('title')
Pay for your holiday
@stop

@section('js-head')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
@stop

@section('js-foot')
<script>
Stripe.setPublishableKey('@stripeKey');

$('#payment-form').submit(function(e) {
  e.preventDefault();
  
  var $form = $(this);
  $form.find('.payment-errors').hide();
  $form.find('button').prop('disabled', true);
  
  Stripe.createToken($form, stripeResponseHandler);
});

// handle stripe response
function stripeResponseHandler(status, response) 
{
  var $form = $('#payment-form');

  if (response.error) 
  {
    $form.find('.payment-errors').text(response.error.message).show();
    $form.find('button').prop('disabled', false);
  } 
  else 
  {

    var token = response.id;
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    $form.get(0).submit();
  }
}
</script>
@stop

@section('main')

<div class="row">
  <div class="col-sm-12">
    <h2>Confirm and Pay</h2>
    <p>Confirm your holiday's dates, and pay with a credit or debit card. </p>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    
    <h4>Your Details</h4>
    <table class="table">
      <tr>
        <td>Name</td>
        <td>{{ $booking->user->first_name }} {{ $booking->user->last_name }}</td>
      </tr>
      <tr>
        <td>Address</td>
        <td>{{ $booking->user->address1.', ' }} 
            <?php echo ($booking->user->address2 == '') ? '' : $booking->user->address2.', '; ?>
            {{ $booking->user->town.', '.$booking->user->postcode }}</td>
      </tr>
      <tr>
        <td>Phone Number</td>
        <td>{{ $booking->user->telephone }}</td>
      </tr>

    </table>

    <h4>Holiday Details</h4>
    <table class="table">
      <tr>
        <td>Staying at</td>
        <td>{{ $booking->cottage->name }} &mdash;
          @foreach($booking->cottage->areas as $a) {{ $a->area.', ' }} @endforeach</td>
      </tr>
      <tr>
        <td style="width:30%">Arriving</td>
        <td>{{ $booking->first_night->format('l, F jS, Y') }}</td>
      </tr>
      <tr>
        <td>Departing</td>
        <td>{{ $booking->last_night->format('l, F jS, Y') }}</td>
      </tr>
      <tr>
        <td>Number of Nights</td>
        <td>{{ $booking->nights }}</td>
      </tr>
      <tr>
        <td>Cost</td>
        <td>£{{ $booking->amount }}.00</td>
      </tr>
    </table>
  </div>
    
  <div class="col-sm-6" id="payment">
    <h4>Your Payment Details</h4>
    {{ Form::open( array('action'=> array('BookingController@processPayment', $booking->id), 'id'=>'payment-form', 'class'=>'form')) }}

    <div class="payment-errors alert alert-danger" style="display:none;"></div>

    {{ Form::hidden('booking_id', $booking->id) }}
    {{ Form::hidden('amount', $booking->amount) }}

    <div class="row">
      <div class="form-group col-sm-8 col-xs-12">
        <label>Card Number</label>
        <input type="text" size="20" data-stripe="number" class="form-control" required="required">
        <p class="help-block">The long 16 digit number on your card</p>
      </div>
    </div>

    <div class="row">
      <div class="form-group col-sm-6 col-xs-12">
        <label>CVC</label>
        <input type="text" size="4" data-stripe="cvc" class="form-control"  required="required">
        <p class="help-block">The last three digits on the back of your card.</p>
      </div>
    </div>

    <div class="form-group">  
      <label>Expires</label>
      <div class="row">
        <div class="col-sm-2 col-xs-6">
          <input type="text" size="2" data-stripe="exp-month" class="form-control" placeholder="MM" required="required">
        </div>  
        <div class="col-sm-2 col-xs-6">
          <input type="text" size="4" data-stripe="exp-year" class="form-control" placeholder="YYYY" required="required">
        </div>
        <p class="help-block">For example 05 and 2015</p>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label">
        <input type="checkbox" name="termconfirm" value="1" required="required"> I have read and agree to the {{ Config::get('cottaging.site-name') }} terms and conditions.
      </label>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg">Submit Payment</button>
    </div>
    {{ Form::close() }}
  </div>
</div>
@stop