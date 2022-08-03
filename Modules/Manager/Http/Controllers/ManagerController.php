<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ManagerController extends Controller
{

    public function index()
    {
        return redirect()->route('manager.brand_index');
    }


}
