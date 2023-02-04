<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class GroupsAndPosts implements WithMultipleSheets
{
    public function sheets(): array
    {
       return [
            new Sheets\UsersSheet(),
            new Sheets\AdminsSheet(),
       ];
    }
}
