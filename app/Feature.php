<?php

namespace App;

class Feature extends BaseModel {
  
  protected $table = 'features';  
  
  protected $fillable = [];
    
  public function cottages()
  {
    return $this->belongsToMany(Cottage::class);
  }
}
