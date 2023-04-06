<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Attachement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $id)
    {
      $comment = new Comment();
      $comment->comment = $request->comment;
      $comment->issue_id = $id;
      $comment->owner_id = Auth::user()->id;
      $comment->save();
      $files = $request->file('files');
      # Continue from here
      if ($files) {
        foreach ($files as $file) {
          $filename = $file->getClientOriginalName();
          $path = $file->store('comments', 'public');
          $att = new Attachement();
          $att->name = $filename;
          $att->path = $path;
          $att->comment_id = $comment->getKey();
          $att->save();
        }
      }
      return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, int $id)
    {
      $comment = Comment::find($id);
      $comment->comment = $request->comment;
      $comment->save();
      return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(int $id)
    {
      Comment::destroy($id);
      $atts = Attachement::all()->where('comment_id','=',$id);
      foreach($atts as $att) {
        Storage::disk('public')->delete($att->path);
        Attachement::destroy($att->id);
      };
      return back();
    }
}
