<?php

namespace App;

use Carbon\Carbon;

class Cottage extends BaseModel {
  
  protected $table = 'cottages';

  protected $guarded = ['id'];
  
  protected $hidden = ['id', 'created_at', 'updated_at', 'areas', 'images', 'prices'];

  /**
   * Start days is a serialized array
   * 
   * @param type $value
   * @return type
   */
  public function getStartDaysAttribute($value)
  {
    return unserialize($value);
  }

  public function setStartDaysAttribute($value)
  {
    $this->attributes['start_days'] = serialize($value);
  }

  // ############ Relationships

  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }
  
  /**
   * Get all bookings from a certain date
   * 
   * @param string $from carbon parsable string
   * @return type
   */
  public function bookingsFrom($from = 'first day of month')
  {
    return $this->hasMany(Booking::class)
            ->where('last_night', '>=', (new Carbon($from))->toDateString() );
  }

  
  public function areas()
  {
    return $this->belongsToMany(Area::class, 'cottage_area')
            ->orderBy('parent_id', 'DESC');
  }

  public function prices()
  {
    return $this->hasMany(Price::class)
              ->where('end', '>=', \DB::raw('NOW()'))
              ->orderBy('start', 'ASC');
  }

  public function images()
  {
    return $this->hasMany(Image::class)
                ->orderBy('order_val', 'ASC');
  }
  
  public function features()
  {
    return $this->belongsToMany(Feature::class);
  }
  
  // ================ custom methods
  
  /**
   * Find by slug. 
   * Includes features, bookings and images
   * 
   * @param string $slug
   * @return Eloquent Model
   */
  public function findBySlug($slug)
  {
    return self::with(['features', 'bookingsFrom', 'images'])
            ->where('slug', $slug)
            ->findOrFail();
  }
  
  public function attachBooking(\App\Booking $booking)
  {
    return self::bookings()->save($booking);
  }
  
  public function calculateByNight($request)
  {
    // http://stackoverflow.com/questions/16306404/calculate-price-between-given-dates-in-multiple-ranges
    
    $cottage = self::findOrFail($request->input('cottage_id'));
    $start = $request->input('first_night');
    $end = $request->input('depart');
    
    $price =  \DB::select(
            \DB::raw("SELECT SUM(DATEDIFF(
                LEAST(end + INTERVAL 1 DAY, :end), 
                GREATEST(start, :start)
              ) 
              * night_price) AS cost FROM prices WHERE cottage_id = :cottage_id AND end >= :start2 AND start <= :end2"), 
              ['end' => $end, 'start' => $start, 'cottage_id'=> $cottage->id, 'start2' => $start, 'end2' => $end]
            );
    
    return $price;
  }
}