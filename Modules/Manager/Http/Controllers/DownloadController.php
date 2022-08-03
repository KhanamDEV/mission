<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Service\Manager\BrandService;
use App\Service\Manager\DownloadService;
use Modules\Manager\Http\Requests\DownloadRequest;
class DownloadController extends Controller
{
    public function __construct(BrandService $brand_service, DownloadService $download_service){
        $this->brand_service = $brand_service;
        $this->download_service = $download_service;
    } 

    public function index(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['brands'] = $this->brand_service->getListWithTeams();
            return view('manager::download.index', compact(['data']));

        } catch (\Exception $e){
            abort('500');
        }
    }

    public function getCSV(DownloadRequest $request)
    {
        try {
            switch ($request->type) {
                case 'member':
                    return $this->download_service->getCSVMenber($request->all());
                case 'login_history':
                    return $this->download_service->getCSVLoginHistory($request->all());
                case 'mission_history':
                    return $this->download_service->getCSVMissions($request->all());
                default:
                    abort(404);
                    break;
            }

            return view('manager::download.index');
        } catch (\Exception $e){
            abort('500');
        }
    }
}
