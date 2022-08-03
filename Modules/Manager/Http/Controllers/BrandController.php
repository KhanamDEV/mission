<?php

namespace Modules\Manager\Http\Controllers;

use App\Helpers\Helpers;
use App\Service\Manager\BrandService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\MessageBag;
use Modules\Manager\Http\Requests\CreateBrandRequest;
use Modules\Manager\Http\Requests\EditBrandRequest;
use function GuzzleHttp\Promise\all;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * List brand
     * @method GET
     */
    public function index()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            $data['brands'] = $this->brandService->getList(10);
            return view('manager::brand.index', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Create brand
     * @method GET
     */
    public function create()
    {
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::brand.create', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Create brand
     * @method POST
     */
    public function store(CreateBrandRequest $request){
        try {
            $data = $request->all();
            if ($this->brandService->store($data)){
                return redirect()->route('manager.brand_index');
            }
            $errors = new MessageBag(['createFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    /**
     * Show data brand
     * @method GET
     */
    public function show($id)
    {
        try {
            $data['brand'] = $this->brandService->findById($id);
            if (empty($data['brand'])) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::brand.show', compact('data'));
        } catch (\Exception $e) {
            abort('500');
        }
    }

    /**
     * Edit brand
     * @method GET
     */
    public function edit($id){
        try {
            $data['brand'] = $this->brandService->findById($id);
            if (empty($data['brand'])) abort(404);
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::brand.edit', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

    public function update(EditBrandRequest $request, $id){
        try {
            $data = $request->all();
            if ($this->brandService->update($id, $data)){
                return redirect()->route('manager.brand_show', ['id' => $id]);
            }
            $errors = new MessageBag(['editFailed' => 'message.response.an_error_has_occurred']);
            return redirect()->back()->withInput($data)->withErrors($errors);
        } catch (\Exception $e){
            abort('500');
        }
    }

    /**
     * Menu brand
     * @method GET
     */
    public function menu(){
        try {
            $data['common'] = Helpers::titleAction([__('layer.title_mission')]);
            return view('manager::brand.menu', compact('data'));
        } catch (\Exception $e){
            abort('500');
        }
    }

}
