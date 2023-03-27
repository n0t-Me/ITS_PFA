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
  <div clas="row justify-content-center">
    <div class="card">
      <div class="d-flex card-header justify-content-between">
        {{$issue->title}}
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
        <div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Opened on {{date_format(date_create($issue->opened_at), "d-m-Y")}} by {{ $issue->getowner->name}}</div>
        {{$issue->description}}
        @if (strlen($issue->attachments) > 0)
          <div class="card">
            <div class="card-header">Attachments</div>
            <div class="card-body">
              @foreach (explode('\n',$issue->attachments) as $a)
              <p>$a</p>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
