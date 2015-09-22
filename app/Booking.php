<?php

namespace App;

class Booking extends BaseModel {
  
  const STATUS_DRAFT = 0;
  const STATUS_CONFIRMED = 1;
  
  protected $table = 'bookings';

  protected $guarded = ['id'];

  protected $hidden = ['id', 'cottage_id', 'client_id', 'created_at', 'updated_at', 'amount', 'paid'];

  protected $appends = ['depart'];
  
  protected $dates = ['first_night', 'last_night'];
  
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

}