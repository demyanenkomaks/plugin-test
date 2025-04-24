<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CallbackRequest;
use App\Http\Resources\CallbackResource;
use App\Models\Callback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class CallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $callbacks = Callback::query()->paginate($request->input('per_page'));

        return CallbackResource::collection($callbacks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CallbackRequest $request
     * @return CallbackResource
     */
    public function store(CallbackRequest $request): CallbackResource
    {
        $callback = Callback::create($request->validated());

        return new CallbackResource($callback);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CallbackResource
     */
    public function show(int $id): CallbackResource
    {
        $callback = Callback::findOrFail($id);

        return new CallbackResource($callback);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CallbackRequest $request
     * @param  int  $id
     * @return CallbackResource
     */
    public function update(CallbackRequest $request, int $id): CallbackResource
    {
        $callback = Callback::findOrFail($id);

        $callback->update($request->validated());

        return new CallbackResource($callback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $callback = Callback::findOrFail($id);

        $callback->delete();

        return response()->json(['message' => 'Запись успешно удалена']);
    }
}