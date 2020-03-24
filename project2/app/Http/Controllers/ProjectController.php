<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Arr;
use Str;
use URL;

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
        $endBalance = session('endBalance', null);
      
        return view('pages.index')->with([
            'startingBalance' => $startingBalance,
            'monthlyContribution' => $monthlyContribution,
            'growTime' => $growTime,
            'timeUnit' => $timeUnit,
            'interestRate' => $interestRate,
            'endBalance' => $endBalance
        ]);
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'startingBalance' => 'required',
            'monthlyContribution' => 'required',
            'growTime' => 'required',
            'timeUnit'=> 'required',
            'interestRate' => 'required'
        ]);

        $startingBalance = $request->input('startingBalance', null);
        $monthlyContribution = $request->input('monthlyContribution', null);
        $growTime = $request->input('growTime', null);
        $timeUnit = $request->input('timeUnit', null);
        $interestRate = $request->input('interestRate', null);

        ($timeUnit === 'years') ? $growTimeInMonths = $growTime*12 : $growTimeInMonths = $growTime;
        $ratePerMonth = $interestRate/12;
        $endBalance = $startingBalance;

        for($i = 1; $i <= $growTimeInMonths; $i++) {
            $endBalance += $monthlyContribution;
            $endBalance = $endBalance*(1 + ($ratePerMonth/100));

        }

        $endBalance = round($endBalance, 2);

        return redirect(URL::to('/'))->with([
            'startingBalance' => $startingBalance,
            'monthlyContribution' => $monthlyContribution,
            'growTime' => $growTime,
            'timeUnit' => $timeUnit,
            'interestRate' => $interestRate,
            'endBalance' => $endBalance
        ]);
    }
}
