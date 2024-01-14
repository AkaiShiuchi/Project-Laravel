<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ValidateAddCRUD;
use App\Http\Requests\ValidateEditCRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $isSuperAdmin = Auth::User()->role_id == User::SUPER_ADMIN;
        return view('crud.display')
            ->with('users', $users)
            ->with('is_super_admin', $isSuperAdmin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateAddCRUD $request)
    {
        $input = DB::table('users')->where('email', $request->email)->first();

        if (!$input) {
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

            toastr()->success('User Addedd!');
            return redirect('user')->with('message', 'User Addedd!');
        } else {
            toastr()->error('Add failed!');
            return redirect('user/create')->with('message', 'Add failed!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        return view('crud.show')->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        return view('crud.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateEditCRUD $request, $id)
    {
        $users = User::find($id);

        if ($users) {

            if (Hash::check($request->current_password, $users->password)) {
                $users->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->new_password),
                ]);
                toastr()->success('User Updated!');
                return redirect('user')->with('message', 'User Updated!');
            } else {
                toastr()->error('Your password is incorrect!');
                return redirect()->back();
            }
        } else {
            return redirect('user/edit')->with('message', 'user update failded!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idUser = User::find($id);
        $idUser->delete();
        toastr()->success('User deleted!');
        return redirect('user')->with('flash_message', 'user deleted!');
    }
}
