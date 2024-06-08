<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WilayahService;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    public function provinces()
    {
        $provinces = $this->wilayahService->getProvinces();
        return response()->json($provinces);
    }

    public function regencies($provinceId)
    {
        $regencies = $this->wilayahService->getRegencies($provinceId);
        return response()->json($regencies);
    }

    public function districts($regencyId)
    {
        $districts = $this->wilayahService->getDistricts($regencyId);
        return response()->json($districts);
    }
}
