<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\StoreUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::query()->latest('id')->paginate(5);

        return response()->json([
            'message' => 'List Users. Page ' . request('page', 1),
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::query()->create($request->all());

        return response()->json([
            'message' => 'Create User successfully',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = User::query()->findOrFail($id);

            return response()->json([
                'message' => 'Detail User. ID = ' . $id,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'line' => $th->getLine(),
                'message' => $th->getMessage(),

            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json([
                    'message' => 'Not found user with ID = ' . $id,
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'message' => 'Not found user with ID = ' . $id,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->findOrFail($id);

        $user->update(request()->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'Delete User successfully',
        ], Response::HTTP_OK);
    }
}
