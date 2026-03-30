<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function index()
    {
        return User::all();
    }

    public function store(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }

    public function update(string $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete($id);
        return response()->json([
            'message' => 'Success',
        ], 200);
    }
}