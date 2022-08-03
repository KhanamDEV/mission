<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LoginHistoryExport implements FromView
{
    private $users;
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        return view('manager::exports.login_history', [
            'histories' => $this->users
        ]);
    }
}
