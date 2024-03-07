<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;

class DynamicPDFController extends Controller
{
    //

    function pdf()

    {
        $user = auth()->user();
        $pdf = PDF::loadView('user.user-card');
        return $pdf->download();
    }
}
