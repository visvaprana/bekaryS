<?php

namespace App\Imports;

use App\Models\City;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use DB;
use Str;

class CityImport implements ToCollection
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(collection $collection)
    {

        foreach ($collection as $key => $value) {
            if ($key>0) {

                $city = DB::table('cities')->insert([
                    'id' => $value[0],
                    'country_id' => $value[1],
                    'name' => $value[2],
                    'slug' => Str::slug($value[2]),
                    'status' => 1,
                ]);


            }

        }




    }
}
