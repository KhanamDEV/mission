<?php

namespace App\Exports;

use App\Model\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    private $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('manager::exports.members', [
            'members' => $this->users
        ]);

    }
}
