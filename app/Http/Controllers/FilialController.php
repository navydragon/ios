<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Filial;

class FilialController extends Controller
{
    public function index()
    {
        $filials = Filial::all();
        return view('admin.filials.index',compact('filials'));
    }

    public function show($filial)
    {
        $filial = Filial::findOrFail($filial);
        return view('admin.filials.show',compact('filial'));
    }

    public function edit($filial)
    {
        $filial = Filial::findOrFail($filial);
        return view('admin.filials.edit',compact('filial'));
    }

    public function update($filial, Request $request)
    {
        $filial = Filial::findOrFail($filial);
        $filial->name = $request->name;
        $filial->shortname = $request->shortname;
        $filial->save();
        return back()->with('success_update', 'Информация обновлена!');
    }

    public function store(Request $request)
    {
        $filial = new Filial;
        $filial->name = $request->name;
        $filial->shortname = $request->shortname;
        $filial->save();
        return back()->with('success_store', 'Филиал добавлен!');
    }

    public function delete( Filial $filial)
    {
        $filial->delete();
        return back()->with('success_delete', 'Филиал удален!');
    }
}
