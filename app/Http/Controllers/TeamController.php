<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
      return view('teams.all',[
        'teams' => Team::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $team = new Team();
      $team->name = $request->name;
      $team->description = $request->description;
      if ($request->hidden === "on") {
        $team->hidden = True;
      } else {
        $team->hidden = False;
      }
      $team->save();
      return redirect(route("allTeams"));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
      return view('teams.show',[
        'team' => Team::with('members')->find($id),
        'teams' => Team::all()
      ]);
    }

    public function changeTeam(Request $request)
    {
      $user = User::find($request->userid);
      $user->team_id = $request->team_id;
      $user->save();
      return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
      $team = Team::find($id);
      $team->name = $request->name;
      $team->description = $request->description;
      if ($request->hidden === "on") {
        $team->hidden = True;
      } else {
        $team->hidden = False;
      }
      $team->save();
      return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {
      if ($id > 2) {
        User::where('team_id', '=' ,$id)->update(['team_id' => 1]);
        Team::destroy($id);
      }
      return back();
    }
}
