<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use App\Mail\PasswordReset;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

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
      $rand_pass = User::random_password();
      $user->password = Hash::make($rand_pass);
      $user->team_id = $request->team_id;
      $user->role = $request->role;
      $user->save();

      Mail::to($user->email)->send(new AccountCreated($user->name, $rand_pass, $user->role, Team::find($request->team_id)->name));
      return redirect(route('allUsers'));
    }

    public function updateInfo(Request $request)
    {
      $validated = $request->validate([
        'name' => 'required|unique:users',
        'email' => 'required|unique:users'
      ]);
      $user = User::find(Auth::user()->id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();
      return back();
    }

    public function updatePassword(Request $request)
    {
      if (!Hash::check($request->password, $request->user()->password)) {
        return back()->withErrors([
          'password' => 'Invalid Creds'
        ]);
      }
      $request->validate([
        'n_password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()]
      ]);
      $user = User::find($request->user()->id);
      $user->password = Hash::make($request->password);
      return back();
    }

    public function resetPassword(int $id)
    {
      $user = User::find($id);

      $rand_pass  = User::random_password();
      $user->password = Hash::make($rand_pass);
      $user->save();

      Mail::to($user->email)->send(new PasswordReset($rand_pass));
      return back();
    }
}
