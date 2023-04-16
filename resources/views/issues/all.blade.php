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
  <div class="row justify-content-center">
    <p class="fs-4">{{$title}}</p>
    @forelse ($issues as $issue)
      <div class="card card-body mb-4">
        <div class="d-flex justify-content-between">
          <a class="hover-blue" style="text-decoration: none;color: black;" href="{{url('/issues/'.$issue->id)}}">{{ $issue->title }}</a>
          <div>
            @if ($issue->status==="Open")
              <span class="badge bg-primary">Open</span>
            @else
              <span class="badge bg-secondary">Closed</span>
              @endif

            <span class="badge {{$status[$issue->severity]}}">Severity:{{$issue->severity}}</span>
          </div>
        </div>
        <div class="d-flex justify-content-between"><div class="fs-8 fw-lighter fst-italic text-secondary">Opened on {{date_format(date_create($issue->opened_at), "d-m-Y")}} by {{ $issue->owner->name}}</div><div class="fs-8 fw-lighter fst-italic text-secondary">Comments count:{{$issue->comments_count}}</div></div>
      </div>
    <div>
      <a href="{{ route('PDF')}}" class="btn btn-primary">
        <i class="nav-icon fas fa-file-pdf"></i>
        <p>Download <b>PDF</b></p>
    </a>
    </div>

    @empty
      <h2 class="mt-4 fw-bolder text-secondary text-center">No Issues</h2>
    </div>
   @endforelse
</div>
@endsection
