<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function index($table)
    {
        try {
                $data = DB::table($table)->orderByDesc('id')->paginate(50);
                return view('manager::database.index', compact('data'));
        } catch (\Exception $e) {
            dd("Table not found");
        }
    }
}
