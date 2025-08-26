<?php

namespace App\Imports;

use App\Models\Area;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use DB;
use Str;

class AreaImport implements ToCollection
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

                $city = DB::table('areas')->insert([
                    'id' => $value[0],
                    'country_id' => $value[1],
                    'city_id' => $value[2],
                    'name' => $value[3],
                    'slug' => Str::slug($value[3]),
                    'postcode' => $value[4] ?? '',
                    'shipping_charge' => $value[5] ?? '',
                    'status' => 1,
                ]);


            }

        }




    }
}
