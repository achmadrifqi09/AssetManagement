<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    
    public function index(){
      
        $totalTangibleAsset = Asset::where('item_category', '=',  'Berwujud' )->count();
        $totalIntangibleAsset = Asset::where('item_category', '=',  'Tak Berwujud' )->count();
        $employee = Employee::all()->count();
        $assetsAll = Asset::all();
        $totalPrice = 0;
        foreach($assetsAll as $assetItem){
            $totalPrice += (int)$assetItem->price;
        }

        $conditonData = [];

        array_push($conditonData,   Asset::where('item_condition', '=',  'Baik' )->count());
        array_push($conditonData, Asset::where('item_condition', '=',  'Rusak Berat' )->count());
        
        $assets = Asset::groupBy('item_year')->select('item_year', DB::raw('count(*) as total'))->get();
        $label = [];
        $count = [];

        foreach ($assets as $asset){
            array_push($label, $asset->item_year);
            array_push($count, $asset->total);
        }

        return view('page/dashboard', [
            'totalAsset' => $assetsAll->count(),
            'totalTangibleAsset' => $totalTangibleAsset,
            'totalIntangibleAsset' => $totalIntangibleAsset,
            'employee' => $employee,
            'condition' => $conditonData,
            'yearLabel' =>  $label,
            'yeaCount' =>  $count,
            'totalPrice' => $totalPrice
        ]);
    }
}
