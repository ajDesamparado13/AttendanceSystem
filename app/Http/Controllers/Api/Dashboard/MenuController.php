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
        $menus = Menu::constraintRoles($roles);
        return response()->json([
            'menus' => $menus
        ]);
    }
}