<?php

namespace App\Http\Controllers;

use App\SubCounty;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

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
     * @return Renderable
     */
    public function index()
    {
        return view('dashboard');
    }


    public function sub_counties($id) {

        return response()->json(array(
            'success' => true,
            'data'   => SubCounty::where('county_id', $id)->get()
        ));

    }
}
