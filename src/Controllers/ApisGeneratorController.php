<?php

namespace KMLaravel\ApiGenerator\Controllers;

use App\Http\Controllers\Controller;
use KMLaravel\ApiGenerator\Services\GeneratorService;
use KMLaravel\ApiGenerator\Requests\ApisGeneratorRequest;

class apisGeneratorController extends Controller
{
    protected $generatorService;

    public function __construct()
    {
        $this->generatorService = new GeneratorService();
    }

    public function create(ApisGeneratorRequest $request)
    {
        $this->generatorService->initialRequest($request)->generateApi();
        /** @scrutinizer ignore-call */
        session()->flash('alert_type' , 'success');
        /** @scrutinizer ignore-call */
        session()->flash('success' , 'create new api successfully');
        return /** @scrutinizer ignore-call */ redirect()->route('apisGenerator.index');
    }
}
