<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Filial;
use App\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('filial')->latest()->get();
        $filials = Filial::all();
    	return view('admin.users.index',compact('users','filials'));
    }
    public function edit($user)
    {
        $user = User::findOrFail($user);
        $filials = Filial::all();
        $roles = Role::all();
    	return view('admin.users.edit',compact('user','filials','roles'));
    }

    public function show($user)
    {
        $user = User::findOrFail($user);
    	return view('admin.users.show',compact('user'));
    }

    public function delete($user)
    {
        $user = User::findOrFail($user);
        $user->delete();
        return back()->with('success','Пользователь успешно удален!');
    }

    public function update(User $user, Request $request)
    {
        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->name = $request->lastname." ".$request->firstname." ".$request->middlename;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->filial_id = $request->filial_id;
        $user->division = $request->division;
        $user->job = $request->job;
        $user->save();
        return back()->with('success', 'Данные успешно сохранены!'); ;
    }

    public function update_role(User $user, Request $request)
    {
        $user->role_id = $request->role_id;
        $user->save();
        return back()->with('success_role', 'Роль успешно изменена!'); ;
    }
}
