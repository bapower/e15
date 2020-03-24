<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Str;

class ProjectController extends Controller
{
    /**
     * GET /
     * 
     */
    public function index()
    {
        $startingBalance = session('startingBalance', null);
        $monthlyContribution = session('monthlyContribution', null);
        $growTime = session('growTime', null);
        $timeUnit = session('timeBalance', null);
        $interestRate = session('interestRate', null);
      
        return view('pages.index')->with([
            'startingBalance' => $startingBalance,
            'monthlyContribution' => $monthlyContribution,
            'growTime' => $growTime,
            'timeUnit' => $timeUnit,
            'interestRate' => $interestRate
        ]);
    }
}
