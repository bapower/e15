<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use Validator;

class SavingsCalculatorController extends Controller
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
        $timeUnit = session('timeUnit', null);
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
        Validator::extend('currency', function($attribute, $value)
        {
            $valueWithOutCommas = str_replace(',', '', $value);
            return is_numeric($valueWithOutCommas) && $valueWithOutCommas >= 0;
        }, 'The :attribute field must be a valid positive number');

        $request->validate([
            'startingBalance' => ['required', 'min:0', 'currency'],
            'monthlyContribution' => ['required', 'min:0', 'currency'],
            'growTime' => ['required', 'min:0', 'max:1000', 'integer',],
            'timeUnit'=> 'required',
            'interestRate' => 'required'
        ]);

        $startingBalance = $request->input('startingBalance', null);
        $monthlyContribution = $request->input('monthlyContribution', null);
        $growTime = $request->input('growTime', null);
        $timeUnit = $request->input('timeUnit', null);
        $interestRate = $request->input('interestRate', null);

        ($timeUnit === 'years') ? $growTimeInMonths = $growTime*12 : $growTimeInMonths = $growTime;
        $numericStartingBalance = str_replace(',', '', $request->input('startingBalance', null));
        $numericMonthlyContribution = str_replace(',', '', $request->input('monthlyContribution', null));
        $ratePerMonth = $interestRate/12;
        $endBalance = $numericStartingBalance;

        for($i = 1; $i <= $growTimeInMonths; $i++) {
            $endBalance += $numericMonthlyContribution;
            $endBalance = $endBalance*(1 + ($ratePerMonth/100));

        }

        $endBalance = number_format($endBalance, 2);

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
