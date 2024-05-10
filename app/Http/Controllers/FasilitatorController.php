<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitatorController extends Controller
{
    public function dashboard(){
        return view('fasilitator.layouts.dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}
