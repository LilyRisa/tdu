<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GenerationBarcode extends Controller
{
    public function Generation(){
        $username = $this->generateBarcodeNumber();
        return response()->json(['barcode' => $username]);
    }
    private function generateBarcodeNumber() {
        $number = mt_rand(10000, 99999);

        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }
    
        return $number;
    }
    private function barcodeNumberExists($number){
        if(User::where('username', $number)->exists()){
            return true;
        }
        return false;
    }
}
