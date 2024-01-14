<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    public function create()
    {
        return view('Registration.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = DB::table('users')->where('email', $request->email)->first();

            if (!$user) {
                $newUser = new User();

                if ($request->role == 'admin') {
                    $role_id = Role::where('user_name', 'admin')
                        ->first()
                        ->id;
                } elseif ($request->role == 'super_admin') {
                    $role_id = Role::where('user_name', 'super_admin')
                        ->first()
                        ->id;
                }

                $newUser->fill([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role_id' => $role_id
                ])->save();

                return redirect()->route('Registration.login')->with('message', 'You sign up sucessfully');

            } else {
                return redirect()->route('Registration.create')->with('message', 'You sign up fail');
            }

            // }
        } catch (\Exception $e) {
            \Log::error('Caught exception:', ['message' => $e->getMessage(), 'trace' => $e->getTrace()]);
        }

    }
    public function showLogin()
    {
        return view('Registration.login');
    }

    public function home(Request $request)
    {
        return view('Registration.home');
    }

    public function handleLogin(Request $request)
    {
        $check = $request->only('email', 'password');

        if (Auth::attempt($check)) {
            // kiểm tra role đăng nhập
            return redirect()->route('Registration.home');
        }
        // đăng nhập thất bại
        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function logout()
    {
        Auth::logout(); // Đăng xuất người dùng
        return redirect()->route('Registration.login'); // Điều hướng đến trang đăng nhập
    }
}
