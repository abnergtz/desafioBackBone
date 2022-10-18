<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\ZipCode;
use App\Models\Settlement;
use App\Models\Municipality;
use App\Models\FederalEntity;
use App\Models\SettlementType;


class ZipCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //data[0] = zip_code
    //data[5] = locality
    
    //data[1] = settlements_name
    //data[9] = settlements_zone_type   
    //data[8] = settlements_key

    //data[3] = municipalities_name
    //data[7] = municipalities_key

    //data[4] = federal_entity_name
    //data[6] = federal_entity_key
 
    //data[2] = settlements_type


    public function run()
    {
   
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); //close foreign_key limit
        ZipCode::truncate();
        Settlement::truncate();
        Municipality::truncate();
        FederalEntity::truncate();
        SettlementType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); //open foreign_key limit

        $csvFile = fopen(base_path("database/seeders/data_main.csv"), "r");
        
        $i=0;
        $firstline = true;
        while (($data = fgetcsv($csvFile, 1000, ";")) !== FALSE) {
            if (!$firstline) {

                $data = array_map(function($value) {
                    return $this->quitar_tildes($value);
                }, $data);

                if (!SettlementType::where('name', $data[2])->exists()) {
                    SettlementType::create([
                        'name' => $data[2],
                    ]);
                }

                if (!Municipality::where('name', $data[3])->exists()) {
                    Municipality::create([
                        'name' => $data[3],
                        'key' => $data[7],
                    ]);
                }

                if (!FederalEntity::where('name', $data[4])->exists()) {
                    FederalEntity::create([
                        'name' => $data[4],
                        'key' => $data[6],
                    ]);
                }

                if (!ZipCode::where('zip_code', $data[0])->exists()) {
                    ZipCode::create([
                        'zip_code' => $data[0],
                        'locality' => $data[5],
                        'municipality_id' => Municipality::where('name', $data[3])->first()->id,
                        'federal_entity_id' => FederalEntity::where('name', $data[4])->first()->id,
                    ]);
                }

                Settlement::create([
                    'name' => $data[1],
                    'key' => $data[8],
                    'zone_type' => $data[9],
                    'settlement_type_id' => SettlementType::where('name', $data[2])->first()->id,
                    'zip_code_id' => ZipCode::where('zip_code', $data[0])->first()->id,
                ]);


            }
            $firstline = false;
            $i++;
            //if $i can be divided by 1000, then show the number of rows processed
            if ($i % 1000 == 0) {
                echo $i . " rows processed \n";
            }
        }
   
        fclose($csvFile);
    }

    public function quitar_tildes($cadena) {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","ü","Ü");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","u","U");
        $texto = str_replace($no_permitidas, $permitidas ,$cadena);
        return $texto;
    }
}
