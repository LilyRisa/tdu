<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\FieldCalculate;

class ApiController extends Controller
{
    public function SalaryCalculate(Request $request){
        $salary = (int)$request->input('salary');
        $benefit = array_sum($request->input('benefit'));
        $tax = $request->input('tax');
        $leave = (int)$request->input('leave');
        $now = Carbon::now();
        $dayofmonth = cal_days_in_month(CAL_GREGORIAN, $now->month, $now->year);
        $depenPerson = $tax['depenPerson'];
        $gtbt = $tax['reduce_yourself'];
        $salaryGross = $salary + $benefit;
        $tax_yourself = $this->tax_cal_level($this->IncomeTax($salaryGross,$depenPerson,$gtbt)['tax']);
        $salaryNet = $salaryGross - $tax_yourself - $this->IncomeTax($salaryGross,$depenPerson,$gtbt)['insurrance'];
        $salaryNetAfter = (int)($salaryNet / $dayofmonth) * ($dayofmonth - $leave);
        
        return \Response()->json([
            'gross' => $salaryGross,
            'net' => $salaryNet,
            'insurrance' => $this->IncomeTax($salaryGross,$depenPerson,$gtbt)['insurrance'],
            'tax' => $tax_yourself,
            'actual_salary_received' => $salaryNetAfter
            ]);
    }

    private function IncomeTax($total, $depenPerson, $gtbt = null){
        if($total >= 29800000 && $total < 88400000){
            $totalbh1 = 29800000;
            $totalbh2 = $total;
        }else if($total >= 88400000){
            $totalbh1 = 29800000;
            $totalbh2 = 88400000;
        }else{
            $totalbh1 = $total;
            $totalbh2 = $total;
        }

        $bhbb = ($totalbh1 * 0.08) + ($totalbh1 * 0.015) + ($totalbh2 * 0.01);
        if($gtbt == null){
            $gtbt = 11000000;
        }
        $gtpt = $depenPerson * 4400000;
        $return = $total - $bhbb - $gtbt - $gtpt;
        return ['tax' => $return, 'insurrance' => $bhbb];
    }

    private function tax_cal_level($init){
        if($init <= 0){
            return $init;
        }else if($init <= 5000000 && $init > 0){
            return $init*0.05;
        }else if($init > 5000000 && $init <= 10000000){
            return $init*0.1 - 250000;
        }else if($init > 10000000 && $init <= 18000000){
            return $init*0.15 - 750000;
        }else if($init > 18000000 && $init <= 32000000){
            return $init*0.2 - 165000000;
        }else if($init > 32000000 && $init <= 52000000){
            return $init*0.25 - 3250000;
        }else if($init > 52000000 && $init <= 80000000){
            return $init*0.3 - 5850000;
        }else {
            return $init*0.35 - 9850000;
        }
    }
}
