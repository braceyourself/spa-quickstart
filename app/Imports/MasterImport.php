<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasterImport implements ToCollection {

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection) {
        foreach($collection as $row){
            echo $row . "<br>";
        }
    }

    public function model(array $row) {

        dd($row);
    }
}
