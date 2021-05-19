<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\chucvu;
use App\Models\phongban;
use App\Models\phucap;
use App\Models\salary;
use App\Models\User;
use Carbon\Carbon;
use App\Models\lsSalaryOther;
use App\Models\SalaryCalculator;

class SalaryReportController extends Controller
{
    public function index(){
        $user = User::with('salary')->get();
        $lsSalaryOther = lsSalaryOther::all();
        $SalaryCalculator = SalaryCalculator::with('User')->get();
        // dd($SalaryCalculator);
        
        return view('calculate', ['user' => $user, 'salaryother' => $lsSalaryOther, 'cal_salary' => $SalaryCalculator]);
    }
}
