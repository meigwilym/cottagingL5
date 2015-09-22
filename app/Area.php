<?php

namespace App;

class Area extends BaseModel {
  
  protected $table = 'areas';

  protected $fillable = ['area', 'description'];
    
  public function cottages()
  {
    return $this->belongsToMany(Cottage::class, 'cottage_area');
  }
}