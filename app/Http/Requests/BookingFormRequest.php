<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BookingFormRequest extends Request
{
  /**
   * Redirect to BookingController@create
   * 
   * @var string 
   */
  protected $redirectRoute = 'booking.create';

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
      return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    // also need to check if someone's already booked
    return [
      'name' => 'required|min:2',
      'email' => 'required|email',
      'telephone' => 'required',
      'address1' => 'required',
      'address2' => '',
      'town' => 'required',
      'postcode' => 'required',

      'first_night' => 'required|after:now',
      'depart' => 'required|after:first_night',
    ];
  }
}
