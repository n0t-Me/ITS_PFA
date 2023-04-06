<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function profile()
    {
      return view('profile');
    }

    public function all()
    {
      $role = Auth::user()->role;
      if ($role === "admin") {
        $users = User::with('team')->orderBy('users.role')->get();
        $title = "All Users";
      } else if ($role === "team-admin") {
        $users = User::with('team')->where('team_id','=',Auth::user()->team_id)->orderBy('users.role')->get();
        $title = "Team Members";
      }
      return view('users.all',[
        'users' => $users,
        'title' => $title,
      ]);
    }

    public function create()
    {
      return view('users.create',
        [
          'teams' => Team::all(),
        ]);
    }

    public function store(Request $request)
    {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->team_id = $request->team_id;
      $user->role = $request->role;
      $user->save();
      return redirect(route('allUsers'));
    }

    public function update(Request $request)
    {
    }
}
