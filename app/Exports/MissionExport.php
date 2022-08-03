<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MissionExport implements FromView
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
    * @return View
    */
    public function view():View
    {
        return view('manager::exports.missions', [
            'missions' => $this->data
        ]);
    }
}
