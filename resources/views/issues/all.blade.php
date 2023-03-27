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
    <table class="col-md-8 table table-hover">
    <th class="border-dark">{{$title}}</th>
    @foreach ($issues as $issue)
      <tr><td>
      <div>
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
        <div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Opened on {{date_format(date_create($issue->opened_at), "d-m-Y")}} by {{ $issue->getowner->name}}</div>
      </div>
      </td></tr>
    @endforeach
    </table>
  </div>
</div>
@endsection
