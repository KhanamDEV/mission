<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SinglePageController extends Controller
{

    /**
     * @group SinglePage
     * api/v2/single-page
     *
     * @bodyParam page string The page get content Ex: api/v2/single-page/company, api/v2/single-page/term_privacy
     *
     * @response 200{
     *      "response" : "html content"
     * }
     *
     * @response 500{
     *      "response" : ""
     * }
     */
    public function getContentPage($page){
        try {
            return view("api::single.".$page);
        } catch (\Exception $e){
            return "";
        }
    }
}
