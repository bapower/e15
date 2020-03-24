@extends('layouts.master')

@section('head')
<link href='css/index.css' rel='stylesheet'>
@endsection

@section('content')
<h1>E15 Project 2</h1>
<p>By: Bry Power</p>
<div class="form-wrapper">
    <form method='GET' action='/calculate' class="form">

        <h2>Savings Calculator</h2>

        <fieldset>
            <label for='startingBalance'>
                Starting Balance:
                <input type='text' name='startingBalance' value='{{ old('startingBalance', $startingBalance) }}'>
            </label>
       
            <label for='monthlyContribution'>
                Monthly Contribution ($):
                <input type='text' name='monthlyContribution' value='{{ old('monthlyContribution', $monthlyContribution) }}'>
            </label>
  
            <label for='growTime'>
                Time to Grow:
                <input type='text' name='growTime' value='{{ old('growTime', $growTime) }}'>
            </label>

            <label>
                In:
            </label>

            <input 
                type='radio' 
                name='timeUnit' 
                id='title' 
                value='years'
                {{ (old('timeUnit') == 'years' or $timeUnit == 'years') ? 'checked' : '' }}
            >
            <label for='years'> Years</label>
            
            <input 
                type='radio' 
                name='timeUnit' 
                id='months' 
                value='months'
                {{ (old('timeUnit') == 'months' or $timeUnit == 'months') ? 'checked' : '' }}
            >
            <label for='months'> Months</label>
            
            <label for='interestRate'>
                Interest Rate:
                <select name='interestRate'>
                    <option value="0" {{ (old('interestRate') == '0' or $interestRate == '0') ? 'selected' : '' }}>0%</option>
                    <option value="1" {{ (old('interestRate') == '1' or $interestRate == '1') ? 'selected' : '' }}>1%</option>
                    <option value="2" {{ (old('interestRate') == '2' or $interestRate == '2') ? 'selected' : '' }}>2%</option>
                    <option value="3" {{ (old('interestRate') == '3' or $interestRate == '3') ? 'selected' : '' }}>3%</option>
                    <option value="4" {{ (old('interestRate') == '4' or $interestRate == '4') ? 'selected' : '' }}>4%</option>
                    <option value="5" {{ (old('interestRate') == '5' or $interestRate == '5') ? 'selected' : '' }}>5%</option>
                </select>
            </label>
        </fieldset>

        <input type='submit' class="button" value='Calculate'>

        @if(count($errors) > 0)
        <ul class='alert alert-danger error'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    </form>
</div>

@if(!is_null($endBalance))
    <div class='results'>
        <h2>Ending Balance</h2>
       <p>${{ $endBalance }}</p>
    </div>
@endif

@endsection