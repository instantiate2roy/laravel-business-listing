<?php

namespace App\Http\Controllers;

use App\CustomClasses\NavMenu;
use Illuminate\Http\Request;
use stdClass;

class HomeController extends Controller
{
    protected  $navBar;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NavMenu $navMenu)
    {
        $this->middleware('auth');
        $this->navBar  = new stdClass;
        $this->navBar->right = $navMenu::get('TOP_RIGHT_NAV_BAR', 'ACTV');
        $this->navBar->left = $navMenu::get('TOP_LEFT_NAV_BAR', 'ACTV');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $navBar = $this->navBar;
        return view('home', compact('navBar'));
    }
}
