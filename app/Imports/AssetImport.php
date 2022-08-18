<?php

namespace App\Imports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\ToModel;

class AssetImport implements ToModel
{
    protected $request;
    function __construct($request)
    {
        $this->request = $request;
    }


    public function model(array $row)
    {
        $code = function(){
            $unique = false;
            $resultCode = 0;
            while($unique == false){
                $internalCode = rand(0, 10000);
                if(Asset::where('internal_code', '=', $internalCode)->count() == 0){
                    $unique = true;
                    if($internalCode < 1000){
                        $resultCode = str_pad((string)$internalCode, 4,"0", STR_PAD_LEFT);
                    }else{
                        $resultCode = $internalCode;
                    }

                }
            }
            return "K-{$resultCode}";
       };

        if($this->request->item_category == 'Berwujud'){
            if(str_contains($row[2], 's/d')){
                $registrationCode = explode(" ", $row[2]);
                $registrationCode[0] = ltrim($registrationCode[0], "0");
                $registrationCode[2] = ltrim($registrationCode[2], "0"); 
                
                $internalCode = $code();

                $qty = (int)$registrationCode[2] - (int)$registrationCode[0] + 1;
                $itemPrice = (int)$row[13] / $qty;
                for($i = (int)$registrationCode[0]; $i <= (int)$registrationCode[2]; $i++){
              
                    Asset::create([
                        'item_category' => 'Berwujud',
                        'internal_code' => $internalCode,
                        'item_code' => $row[1],
                        'registration' => str_pad((string)$i, 4,"0", STR_PAD_LEFT),
                        'item_name' => $row[3],
                        'brand' => $row[4],
                        'certification_number' => $row[5],
                        'ingredient' => $row[6],
                        'how_to_earn' => $row[7],
                        'item_year' => $row[8],
                        'item_size' => $row[9],
                        'unit' => $row[10],
                        'item_condition' => $row[11],
                        'total' => 1,
                        'price' => $itemPrice,
                        'description' => $row[14],
                        'used' => 0,
                    ]);
                }

            }else{
                Asset::create([
                    'item_category' => 'Berwujud',
                    'internal_code' => $code(),
                    'item_code' => $row[1],
                    'registration' => $row[2],
                    'item_name' => $row[3],
                    'brand' => $row[4],
                    'certification_number' => $row[5],
                    'ingredient' => $row[6],
                    'how_to_earn' => $row[7],
                    'item_year' => $row[8],
                    'item_size' => $row[9],
                    'unit' => $row[10],
                    'item_condition' => $row[11],
                    'total' => $row[12],
                    'price' => $row[13],
                    'description' => $row[14],
                    'used' => 0,
                ]);
            }
        }else if($this->request->item_category == 'Tak Berwujud'){

            if(str_contains($row[3], 's/d')){
                $registrationCode = explode(" ", $row[3]);
                $registrationCode[0] = ltrim($registrationCode[0], "0");
                $registrationCode[2] = ltrim($registrationCode[2], "0"); 

                $internalCode = $code();

                for($i = (int)$registrationCode[0]; $i <= (int)$registrationCode[2]; $i++){
                    Asset::create([
                        'item_category' => 'Tak Berwujud',
                        'internal_code' => $internalCode,
                        'item_name' => $row[1],
                        'item_code'=> $row[2],
                        'registration' => str_pad((string)$i, 4,"0", STR_PAD_LEFT),
                        'item_year' => $row[4],
                        'title' => $row[5],
                        'creator' => $row[6],
                        'spesification' => $row[7],
                        'item_condition' => $row[8],
                        'how_to_earn' => $row[9],
                        'price' => $row[10],
                        'description' => $row[11],
                        'used' => 0,
                        'total' => 999999
                    ]);
                }
            }else{
                Asset::create([
                        'item_category' => 'Tak Berwujud',
                        'internal_code' => $code(),
                        'item_name' => $row[1],
                        'item_code'=> $row[2],
                        'registration' => $row[3],
                        'item_year' => $row[4],
                        'title' => $row[5],
                        'creator' => $row[6],
                        'spesification' => $row[7],
                        'item_condition' => $row[8],
                        'how_to_earn' => $row[9],
                        'price' => $row[10],
                        'description' => $row[11],
                        'used' => 0,
                        'total' => 999999
                ]);
            }
        }
       
    }
}
