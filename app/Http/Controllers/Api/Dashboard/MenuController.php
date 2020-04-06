<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Entities\Menu;
class MenuController extends Controller
{
    
    public function index(){
        $roles = Auth::User()->roles->pluck('id');
        $menus = Menu::whereHas('roles', function($q) use ($roles) {
            $q->whereIn('role_id', $roles);
        })
        ->get()
        ->map(function($v){
            return [
                'name' => $v->name,
                'path' => $v->path
            ];
        })->values()->all();


        return response()->json([
            'menus' => $menus
        ]);
    }
}