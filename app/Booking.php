<?php

namespace App;

class Booking extends BaseModel {
  
  const STATUS_DRAFT = 0;
  const STATUS_COMPLETED = 1;
  
  protected $table = 'bookings';

  protected $guarded = ['id'];

  protected $hidden = ['id', 'cottage_id', 'client_id', 'created_at', 'updated_at', 'amount', 'paid'];

  protected $appends = ['depart'];
  
  protected $dates = ['first_night', 'last_night'];
  
  public static function getStatuses()
  {
    return [
        'draft' => self::STATUS_DRAFT,
        'completed' => self::STATUS_COMPLETED,
    ];
  }

    /**
   * Add 1 day to the last_night for the departure date
   * 
   * @return object
   */
  public function getDepartAttribute()
  {
    return $this->last_night->copy()->addDay();
  }
  
  /**
   * One to one with Cottage
   * 
   * @return Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function cottage()
  {
    return $this->belongsTo(Cottage::class);
  }

  /**
   * One to one (child) with users
   * 
   * @return Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class); //, 'client_id', 'id');
  }
  
  /**
   * Take the payment
   * @todo set up omnipay & Stripe
   * 
   * @param Request $request
   * @return boolean
   */
  public function takePayment($request)
  {
    // Set the API key
    Stripe::setApiKey(env('stripe-api-key'));

    // Get the credit card details submitted by the form
    $token = $request->input('stripeToken');

    // Charge the card
    try
    {
      $charge = Stripe_Charge::create(array(
                  "amount" => $this->amount,
                  "currency" => "gbp",
                  "card" => $token,
                  "description" => 'Holiday Booking with '.\Config::get('cottaging.site-name'))
      );

      // If we get this far, we've charged the user successfully
      $this->paymentComplete();

      Event::fire('booking.confirm', array($booking));

      return true;
    } 
    catch (Stripe_CardError $e)
    {
      // Payment failed
      return false;
    }
  }
  
  private function paymentComplete($amount)
  {
    $this->status = self::STATUS_COMPLETE;
    $this->save();
  }

}