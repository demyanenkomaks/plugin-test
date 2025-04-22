<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CallbackRequest;
use App\Http\Resources\CallbackResource;
use App\Models\Callback;
use Illuminate\Routing\Controller;

class CallbackController extends Controller
{
    public function __invoke(CallbackRequest $request)
    {
        $validated = $request->validated();

        $callback = Callback::create($validated);

        return response()->json([
            'message' => 'Обратная связь успешно сохранена',
            'data' => CallbackResource::make($callback),
        ], 201);
    }
}
