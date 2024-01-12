<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function added()
    {
        return view('added');
    }
    
    public function dashboard(){
        $user = \Auth::user();
        // assign role 
        $role = Role::where('slug','admin')->first();
        // $user->roles()->attach($role);
        dd($user->hasRole('editor'));
        // 
        // check permission 
        // $permission = Permission::first();
        // $user->permissions()->attach($permission);
        // dd($user->permissions);
        // dd($user->can('add-post'));
        // 
        // 
        // 
        // 
        dd($user->roles);
        return view('dashboard');
    }

}
