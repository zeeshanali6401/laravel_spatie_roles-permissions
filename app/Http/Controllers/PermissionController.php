<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
//
    }
    public function store(Request $request){
        Permission::create([
            'name' => $request->name,
            'guard' => 'web'
        ]);
        return redirect()->back();
    }
}
