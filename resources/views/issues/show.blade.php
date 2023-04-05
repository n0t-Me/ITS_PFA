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
        <div>
          @if ($issue->status === "Open")
            <span class="badge bg-primary">Open</span>
          @else
            <span class="badge bg-secondary">Closed</span>
          @endif
          <span class="badge {{ $status[$issue->severity] }}">Severity:{{$issue->severity}}</span>
        </div>
      </div>
      <div class="card-body">
        <div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Opened on {{date_format(date_create($issue->opened_at), "d-m-Y")}} by {{ $issue->owner->name}}</div>
        {{$issue->description}}
        </div>
        @if (count($issue->attachements) > 0)
          <div class="m-3 ps-2 border-start border-primary border-3">
            <strong>Attachements:</strong>
            <div class="list-group">
            @foreach ($issue->attachements as $a)
              <a class="list-group-item" href="/storage/{{$a->path}}">{{$a->name}}</a>
            @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
    <hr class="mb-5"/>
      <div class="col-md-11">
      @if (count($issue->comments) > 0)
      @foreach ($issue->comments as $comment)
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
              <div><strong>{{$comment->owner->name}}</strong></div>
              <div class="fs-8 fst-italic fw-lighter text-secondary">{{$comment->created_at}}</div>
            </div>
            <div class="card-body"><p>{{$comment->comment}}</p></div>
          </div>
        @endforeach
        @endif
      <hr class="mb-5"/>
      <form class="mt-4" method="POST" action="{{url()->current()}}/newComment">
        @csrf
        <textarea class="form-control" name="comment" placeholder="New Comment" required></textarea>
        <input type="submit" class="btn btn-primary mt-2" value="New Comment"/>
      </form>
      </div>
    </div>
</div>
@endsection
