<?php

namespace App;

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

  public function areas()
  {
    return $this->belongsToMany(Area::class, 'cottage_area')->orderBy('parent_id', 'DESC'); // interestingly, laravel looked for area_cottage
  }

  public function prices()
  {
    return $this->hasMany(Price::class)
              ->where('end', '>=', \DB::raw('NOW()'))
              ->orderBy('start', 'ASC');
  }

  public function images()
  {
    return $this->hasMany(Image::class, 'cottage_id')
                ->orderBy('order_val', 'ASC');
  }
  
  public function features()
  {
    return $this->belongsToMany(Feature::class);
  }
}