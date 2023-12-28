<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\ValidateAddCRUD;
use App\Http\Requests\ValidateEditCRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('crud.display')->with('users', $users);
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
            $newUser->fill($request->all())->save();

            return redirect('user')->with('message', 'User Addedd!');
        } else {
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
                dd(1);
                $users->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->new_password,
                ]);
                return redirect('user')->with('flash_message', 'user Updated!');
            } else {
                dd(2);
                return redirect('user/edit')->with('message', 'Your password is incorrect!');
            }
            // $id = $request->all();
            // $users->update($id);
            // return redirect('user')->with('flash_message', 'user Updated!');
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
        $id = User::find($id);
        $id->delete();
        // notify()->success('user deleted!');
        return redirect('user')->with('flash_message', 'user deleted!');
    }
}
