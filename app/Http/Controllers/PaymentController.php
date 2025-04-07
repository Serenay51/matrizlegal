<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment'); // Asegúrate de que la vista se llame 'payment.blade.php'
    }
}