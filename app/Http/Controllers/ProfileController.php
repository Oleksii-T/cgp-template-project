<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Page;

class ProfileController extends Controller
{
    public function index()
    {
        $page = Page::get('profile');
        $user = auth()->user();
        $paymentMethods = $user->paymentMethods()->latest()->get();

        return view('profile.index', compact('page', 'paymentMethods'));
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
