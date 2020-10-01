<?php


namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->fullname = $request->fullname;
        $customer->email = $request->email;
        $customer->phone_number = $request->phone_number;
        $customer->address = $request->address;
        $customer->postcode = $request->postcode;
        $customer->district = $request->district;
        $customer->city = $request->city;
        $customer->province = $request->province;
        $customer->save();
    }
}