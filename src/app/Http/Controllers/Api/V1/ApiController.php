<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "api_version" => config('app.api.version'),
            "status" => 200,
            "date" => Carbon::now()->toDateTimeString(),
        ], 200);
    }
}
