@extends('layouts.app2')
<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
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

@section('search')
<a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline" type="Get" action="{{route('search_issues')}}">
            <div class="input-group input-group-sm" >
              <input class="form-control form-control-navbar" name="I_search" type="search" placeholder="Search Issues" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
@endsection

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

    @empty
      <h2 class="mt-4 fw-bolder text-secondary text-center">No Issues</h2>
    </div>
   @endforelse
</div>
@endsection