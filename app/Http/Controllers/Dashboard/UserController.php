<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index(Request $request)
    {
        // Search => Local Scope
        $users = User::Search()->latest()->Paginate(10);
        return view('dashboard.users.index',compact('users'));
    }


    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        // Validation  //
        $data = $request->validate([
            'name'      => ['required' , 'max:191' , 'string'],
            'email'     => ['required' , 'email' , 'unique:users'],
            'password'  => ['required' , 'min:8' , 'confirmed'],
            'image'     => ['nullable' , 'mimes:jpg,png,jpeg' , 'dimensions:min_width=100,min_height=100']
        ]);
        // Hash Password //
        $data['password'] = bcrypt($data['password']);

        // Image Upload //
        if($request->hasFile('image')){
            $data['image'] = uploader($request , 'image');
        }

        // Create User //
        User::create($data);


        session()->flash('success' , __('app.added_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        return view('dashboard.users.edit' , compact('user'));
    }


    public function update(Request $request, User $user)
    {
        // Validation  //
        $data = $request->validate([
            'name'      => ['required' , 'max:191' , 'string'],
            'email'     => ['required' , 'email' , Rule::unique('users')->ignore($user->id)],
            'image'     => ['nullable' , 'mimes:jpg,png,jpeg' , 'dimensions:min_width=100,min_height=100']
        ]);
        // Image Upload //
        if($request->hasFile('image')){
            $data['image'] = uploader($request , 'image');
        }

        // Create User //
        $user->update($data);

        session()->flash('success' , __('app.updated_successfully'));
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        if($user->id == auth()->user()->id)
            return redirect()->back()->withErrors(__('app.delete_yourself'));
        $user->delete();
        session()->flash('success' , __('app.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
