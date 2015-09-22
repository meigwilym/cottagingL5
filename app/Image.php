<?php

namespace App;

/**
 * Image
 *
 * @author Mei Gwilym <mei.gwilym@gmail.com>
 */
class Image extends BaseModel {
  
  protected $table = 'images';
  
  protected $fillable = ['cottage_id', 'fullpath', 'order_val'];

  protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

  public function cottage()
  {
    return $this->belongsTo(Cottage::class);
  }

}

