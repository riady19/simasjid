<?php

use Illuminate\Support\Facades\Route;

use App\Models\PrayerTime;
use App\Models\FinancialReport;
use App\Models\Activity;
use App\Models\Zakat;
use Carbon\Carbon;

Route::get('/', function () {
    $today = Carbon::today();
    
    // Prayer Times (Today)
    $prayerTime = PrayerTime::whereDate('date', $today)->first();

    // Friday Infaq Totals
    $fridayInfaqTotal = \App\Models\FridayInfaq::sum('amount');
    $fridayInfaqMonth = \App\Models\FridayInfaq::whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount');
    $fridayInfaqToday = \App\Models\FridayInfaq::whereDate('date', $today)->sum('amount');

    // Financial Reports
    $incomeToday = FinancialReport::where('type', 'income')->whereDate('date', $today)->sum('amount') + $fridayInfaqToday;
    $incomeMonth = FinancialReport::where('type', 'income')->whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount') + $fridayInfaqMonth;
    $expenseMonth = FinancialReport::where('type', 'expense')->whereMonth('date', $today->month)->whereYear('date', $today->year)->sum('amount');
    
    // Calculate Balance (Total Income - Total Expense)
    $totalIncome = FinancialReport::where('type', 'income')->sum('amount') + $fridayInfaqTotal;
    $totalExpense = FinancialReport::where('type', 'expense')->sum('amount');
    $balance = $totalIncome - $totalExpense;

    // Activities (Upcoming)
    $activities = Activity::where('date', '>=', $today)->orderBy('date', 'asc')->take(5)->get();

    // Zakat Info (Example: Totals for current year)
    $zakatFitrah = Zakat::where('type', 'fitrah')->whereYear('date', $today->year)->sum('amount');
    $zakatMaal = Zakat::where('type', 'maal')->whereYear('date', $today->year)->sum('amount');

    // Sliders
    $sliders = \App\Models\Slider::all();

    // Orphan Fund Balance
    $orphanIncome = FinancialReport::where('category', 'yatim')->where('type', 'income')->sum('amount');
    $orphanExpense = FinancialReport::where('category', 'yatim')->where('type', 'expense')->sum('amount');
    $orphanBalance = $orphanIncome - $orphanExpense;

    // Running Texts
    $runningTexts = \App\Models\RunningText::where('is_active', true)->get();

    // Friday Schedule (Prefer upcoming, fallback to most recent)
    $fridaySchedule = \App\Models\FridaySchedule::where('date', '>=', $today)
        ->orderBy('date', 'asc')
        ->first();
    
    // If no upcoming schedule, get the most recent one
    if (!$fridaySchedule) {
        $fridaySchedule = \App\Models\FridaySchedule::where('date', '<', $today)
            ->orderBy('date', 'desc')
            ->first();
    }
    
    // Friday Infaq Report
    $fridayInfaq = \App\Models\FridayInfaq::orderBy('date', 'desc')->first();

    return view('welcome', compact(
        'prayerTime', 
        'incomeToday', 
        'incomeMonth', 
        'expenseMonth', 
        'balance', 
        'activities',
        'zakatFitrah',
        'zakatMaal',
        'sliders',
        'orphanBalance',
        'runningTexts',
        'runningTexts',
        'fridaySchedule',
        'fridayInfaq'
    ));
});
