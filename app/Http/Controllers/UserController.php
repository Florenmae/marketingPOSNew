<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function createUser(Request $request){
        $newUser = new User();

        $newUser->id = $request->id;
        $newUser->role = $request->role;
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->password = $request->password;

        $res = $newUser->save();

        return $res;
    }

    public function getUsers(){
        return User::all();
        }

        public function updateUser(Request $request, $id = null)
        {
            // Validation logic (customize as needed)
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . ($id ? $id : 'NULL') . ',id',
                'role' => 'required|string|max:255',
                // Add more validation rules as needed
            ]);

            // Logic for storing/updating a user in the database
            $user = $id ? User::findOrFail($id) : new User;
            $user->fill($request->except($id ? ['password'] : []));

            // Set password only if provided and not empty
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->save();

            // Redirect to the user list view
            return redirect('/user');
        }

    public function deleteUser(Request $request){
        // dd($request->id);
        $deleteUser = User::find($request->id);

        $res = $deleteUser->delete();
        return $res;
    }

}
