<?php

namespace App\Http\Controllers;

use App\Mail\AssignedToIssue;
use App\Mail\IssueClosedAssignee;
use App\Mail\IssueClosedOwner;
use App\Models\Attachement;
use App\Models\Issue;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function all()
    {
      $role = Auth::user()->role;
      if ($role === "admin") {
        return view('issues.all',[
          'issues' => Issue::with('owner')
            ->withCount('comments')
            ->orderBy('issues.status')
            ->orderBy('issues.severity', 'desc')
            ->orderBy('issues.opened_at', 'desc')
            ->get(),
          'title' => 'All Reported Issues'
        ]);
      }
      if ($role === "team-admin" || $role === "member") {
        return view('issues.all',[
          'issues' => Issue::with('owner')
            ->withCount('comments')
            ->where('team_id','=',Auth::user()->team_id)
            ->orderBy('issues.status')
            ->orderBy('issues.severity', 'desc')
            ->orderBy('issues.opened_at', 'desc')
            ->get(),
          'title' => 'Reported Issues'
        ]);
      }
    }
    public function myissues()
    {
      return view('issues.all',[
        'issues' => Issue::with('owner')
          ->where('issues.owner_id', '=', Auth::user()->id)
          ->withCount('comments')
          ->orderBy('issues.status')
          ->orderBy('issues.severity', 'desc')
          ->orderBy('issues.opened_at', 'desc')
          ->get(),
        'title' => 'My Issues'
      ]);
    }
    public function assignedissues()
    {
      return view('issues.all',[
        'issues' => Issue::with(['owner', 'assignee'])
          ->where('issues.assignee_id', '=', Auth::user()->id)
          ->withCount('comments')
          ->orderBy('issues.status')
          ->orderBy('issues.severity', 'desc')
          ->orderBy('issues.opened_at', 'desc')
          ->get(),
        'title' => 'Assigned Issues'
      ]);
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('issues.create',[
        'teams' => Team::all()->where('hidden', False)
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $issue = new Issue();
      $issue->title = $request->title;
      $issue->description = $request->description;
      $issue->severity = $request->severity + 0;
      $issue->owner_id = Auth::user()->id;
      $issue->team_id = $request->team;
      $issue->save();

      $files = $request->file('files');
      # Continue from here
      if ($files) {
        foreach ($files as $file) {
          $filename = $file->getClientOriginalName();
          $path = $file->store('issues', 'public');
          $att = new Attachement();
          $att->name = $filename;
          $att->path = $path;
          $att->issue_id = $issue->getKey();
          $att->save();
        }
      }
      return redirect(route('allIssues'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
      $issue = Issue::with(['owner', 'attachements', 'comments', 'team','assignee','comments.owner', 'comments.attachements'])->find($id);
      return view('issues.show',[
        'issue' => $issue,
        'members' => User::where('team_id','=',$issue->team_id)
          ->where('role','=','member')
          ->get()
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
      $issue = Issue::find($id);
      $issue->title = $request->title;
      $issue->description = $request->description;
      $issue->severity = $request->severity;
      $issue->save();

      return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function close(int $id)
    {
      $issue = Issue::with(['owner', 'assignee'])->find($id);
      if ($issue->status === "Open") {
        $issue->status = "Closed";
        $issue->closed_at = now();
        $issue->save();
        Mail::to($issue->owner->email)->send(new IssueClosedOwner($issue->title));
        if ($issue->assignee) {
          Mail::to($issue->assignee->email)->send(new IssueClosedAssignee($issue->title));
        }
      }
      return back();
    }

    public function assign(Request $request, int $id)
    {
      $issue = Issue::find($id);
      $issue->assignee_id = $request->assignee_id;
      $issue->save();

      $user = User::find($request->assignee_id);
      Mail::to($user->email)->send(new AssignedToIssue($issue->title));
      return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
