<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Price; 

class CottageAjaxController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function quote(QuoteRequest $request)
  {    
    $cost = Cottage::calculateByNight($request); // Price::calculateByNight($request);
    
    return response()->json(['status' => 'success', 'cost' => $cost[0]->cost]);
  }
}
