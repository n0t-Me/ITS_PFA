@extends('layouts.app')

@php
  $status = [
    "10" => "bg-danger",
    "9" => "bg-danger",
    "8" => "bg-warning",
    "7" => "bg-warning",
    "6" => "bg-warning",
    "5" => "bg-success",
    "4" => "bg-success",
    "3" => "bg-info",
    "2" => "bg-info",
    "1" => "bg-info",
  ];
@endphp

@section('content')
<div class="container">
  <div class="d-flex flex-column justify-content-center gap-4">
    <div class="card">
      <div class="d-flex card-header justify-content-between">
        <strong>{{$issue->title}}</strong>
        <div class="hstack">
          @if ($issue->status === "Open")
            <span class="badge bg-primary">Open</span>
          @else
            <span class="badge bg-secondary">Closed</span>
          @endif
          <span class="badge {{ $status[$issue->severity] }}">Severity:{{$issue->severity}}</span>
<div class="dropdown show">
@if ($issue->owner_id === Auth::user()->id) 
<!--Continue from here -->
            <a class="btn" id="dropdownIssue" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownIssue">
              <button class="dropdown-item" href="#">Edit Issue</button>
              <button class="dropdown-item" data-bs-issueid="{{$issue->id}}">Close Issue</button>
            </div>
          @endif
          </div>
          
        </div>
      </div>
      <div class="card-body">
        <div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Opened on {{date_format(date_create($issue->opened_at), "d-m-Y")}} by {{ $issue->owner->name}}</div>
        {{$issue->description}}
        </div>
        @if (count($issue->attachements) > 0)
          <div class="m-3 ps-2 border-start border-primary border-3">
            <strong><i class="bi bi-paperclip"></i>Attachements:</strong>
            <div class="list-group">
            @foreach ($issue->attachements as $a)
              <a class="list-group-item" href="/storage/{{$a->path}}">{{$a->name}}</a>
            @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
      <div class="d-flex flex-row justify-content-start">
      <div class="col-md-11">
      @if (count($issue->comments) > 0)
      <hr class=""/>
      <h5>Comments</h5>
      @foreach ($issue->comments as $comment)
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
              <div><strong>{{$comment->owner->name}}</strong></div>
              <div class="fs-8 fst-italic fw-lighter text-secondary">{{$comment->created_at}}</div>
            </div>
            <div class="card-body"> 
              {{$comment->comment}}
              @if (count($comment->attachements) > 0)
                <div class="m-3 ps-2 border-start border-primary border-3">
                  <strong><i class="bi bi-paperclip"></i>Attachements:</strong>
                  <div class="list-group">
                  @foreach ($comment->attachements as $a)
                    <a class="list-group-item" href="/storage/{{$a->path}}">{{$a->name}}</a>
                  @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endforeach
        @endif
      @if ($issue->status === "Open")
        <hr class=""/>
        <form class="mt-4" method="POST" action="{{url()->current()}}/newComment" enctype="multipart/form-data">
          @csrf
          <textarea class="form-control" name="comment" placeholder="New Comment" required></textarea>
          <div class="input-group">
            <input name="files[]" class="mt-2 form-control" type="file" multiple>
            <button type="submit" class="mt-2 btn btn-primary">Comment <i class="bi bi-send"></i></button>
          </div>
        </form>
      @endif
      </div>
      </div>
    </div>
</div>
@endsection
