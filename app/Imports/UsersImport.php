<?php

namespace App\Imports;

use App\Helpers\Helpers;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use phpDocumentor\Reflection\Types\False_;

class UsersImport implements ToModel
{

    /**
     * @param array $row
     *
     * @return User
     */
    public function model(array $row)
    {
    }

}
