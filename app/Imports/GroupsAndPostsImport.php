<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GroupsAndPostsImport implements WithMultipleSheets 
{
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        return [
            'Departments' => new GroupsImport(),
        ];
    }
}
