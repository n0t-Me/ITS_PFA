<?php

namespace App\Http\Controllers;
use App\Models\Issue;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.home',[
            'issues' => Issue::with('owner')
              ->orderBy('issues.status')
              ->orderBy('issues.severity', 'desc')
              ->orderBy('issues.opened_at', 'desc')
              ->get()
          ]);
    }
}
