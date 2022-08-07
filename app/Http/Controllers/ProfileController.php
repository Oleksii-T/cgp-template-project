<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
    public function update(ProfileRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();

        if ($data['password']??null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return $this->jsonSuccess('Profile updated successfully');
    }
}
