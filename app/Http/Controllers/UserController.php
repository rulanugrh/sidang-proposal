<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // private $rules = [
    //     'email' => 'required',
    //     'name' => 'required',
    //     'password' => 'required',
    // ];

    public function index() {
        $user = User::where("email", auth()->user()->email)->first();
        return view('user.index', compact('user'));
    }

    public function edit(User $user) {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        try {
            $user->where('email', auth()->user()->email)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])

            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data User gagal diupdate');
        }

        return redirect('/')->with('success', 'Data user berhasil diubah');
    }
}
