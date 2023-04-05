<?php

namespace App\Http\Controllers;

use App\Models\Attachement;
use App\Models\Issue;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
      return view('issues.all',[
        'issues' => Issue::with('owner')
          ->withCount('comments')
          ->orderBy('issues.status')
          ->orderBy('issues.severity', 'desc')
          ->orderBy('issues.opened_at', 'desc')
          ->get(),
        'title' => 'All Issues'
      ]);
    }
    public function myissues()
    {
      return view('issues.all',[
        'issues' => Issue::with('owner')
          ->where('issues.owner_id', '=', Auth::user()->id)
          ->orderBy('issues.status')
          ->orderBy('issues.severity', 'desc')
          ->orderBy('issues.opened_at', 'desc')
          ->get(),
        'title' => 'My Issues'
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
      return view('issues.show',[
        'issue' => Issue::with(['owner', 'attachements', 'comments', 'comments.owner', 'comments.attachements'])->find($id)
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
