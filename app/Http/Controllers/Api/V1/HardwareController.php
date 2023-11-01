<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Hardware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class HardwareController extends Controller
{
    /**
     * Retrieve a list of hardware.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['Hardware'])]
    public function index()
    {
        $hardware = Hardware::all();

        return response()->json($hardware, Response::HTTP_OK);
    }

    /**
     * Store a new hardware item.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['Hardware'])]
    public function store(Request $request)
    {
        $hardware = Hardware::create($request->all());

        return response()->json($hardware, Response::HTTP_CREATED);
    }

    /**
     * Retrieve a specific hardware item by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['Hardware'])]
    public function show($id)
    {
        $hardware = Hardware::findOrFail($id);

        return response()->json($hardware, Response::HTTP_OK);
    }

    /**
     * Update a specific hardware item by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['Hardware'])]
    public function update(Request $request, $id)
    {
        $hardware = Hardware::findOrFail($id);
        $hardware->update($request->all());

        return response()->json($hardware, Response::HTTP_OK);
    }

    /**
     * Delete a specific hardware item by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    #[OpenApi\Operation(tags: ['Hardware'])]
    public function destroy($id)
    {
        $hardware = Hardware::findOrFail($id);
        $hardware->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
