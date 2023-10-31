<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hardware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HardwareController extends Controller
{
    public function index()
    {
        $hardware = Hardware::all();
        return response()->json($hardware, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $hardware = Hardware::create($request->all());
        return response()->json($hardware, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $hardware = Hardware::findOrFail($id);
        return response()->json($hardware, Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $hardware = Hardware::findOrFail($id);
        $hardware->update($request->all());
        return response()->json($hardware, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $hardware = Hardware::findOrFail($id);
        $hardware->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
