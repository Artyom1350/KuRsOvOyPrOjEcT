<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GroupsAndPostsImportHelper implements WithMultipleSheets 
{
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        return [
            'DepartmentParts' => new PostsImport(),
        ];
    }
}
