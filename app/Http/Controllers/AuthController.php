<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = new Repository($user);
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            // if (Auth::user()->role == 1) {
            //     return redirect()->route('dashboard.index');
            // }
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('auth.showLogin')->with('error', 'Email atau password salah');
        }
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'address', 'phone', 'no_ktp', 'gender']);
        $password = Hash::make($request->password);
        $payload = array_merge($data, ['password' => $password]);
        $this->model->create($payload);
        toast('Registrasi berhasil', 'success');
        return redirect()->route('auth.login');
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect()->route('auth.login');
    }
}