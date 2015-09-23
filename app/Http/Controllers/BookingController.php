<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Booking, App\Cottage;
use App\Http\Requests\BookingFormRequest;

class BookingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
      $cottage = Cottage::findBySlug($slug);
      
      return view('booking.create', compact('cottage'));
    }

    /**
     * Store a newly created Booking and attach to a Cottage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingFormRequest $request, $slug)
    {
      $cottage = Cottage::findBySlug($slug);
      $booking = Booking::create($request);
      
      $cottage->attachBooking($booking);
      
      return redirect()->route('booking.payment', [$booking->id]);
    }
    
    /**
     * Show a form for payment
     * @param type $id
     * @return type
     */
    public function payment($id)
    {
      $booking = Booking::findOrFail($id);
      
      return view('booking.payment', compact('booking'));
    }
    
    /**
     * Process the payment
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function processPayment(Request $request, $id)
    {
      $booking = Booking::findOrFail($id);
      
      if($booking->takePayment($request))
      {
        return redirect()->action('booking.confirm', $id);
      }
      
      return redirect()->route('booking.payment', $id)
              ->with('message', 'Your payment was not completed.');
    }
    
    public function confirmBooking($id)
    {
      $booking = Booking::findOrFail($id);
      
      return view('booking.confirm', compact('booking'));
    }
}
