<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BrandController extends Controller
{

    public function index()
    {
        return redirect()->route('admin.user_index');
    }


}
