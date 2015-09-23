<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cottage;

class CottageController extends Controller
{
  /**
   * Display cottages, paginated by 5
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cottages = Cottage::paginate(5);
    
    return view('cottages.index', compact('cottages'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $cottage = Cottage::findBySlug($slug);
    
    return view('cottages.show', compact('cottage'));
  }
}
