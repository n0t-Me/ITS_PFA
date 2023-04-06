@extends('layouts.app')

@php
  $status = [
    "admin" => "bg-danger",
    "team-admin" => "bg-warning",
    "member" => "bg-primary",
    "guest" => "bg-dark",
  ];
@endphp

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <p class="fs-4">{{$title}}</p>
    @foreach ($users as $user)
      <div class="card card-body mb-4">
        <div class="d-flex justify-content-between">
          <b>{{ $user->name }}</b>
          <div>
            <span class="badge {{$status[$user->role]}}">{{$user->role}}</span>
          </div>
        </div>
        <div class="fs-8 fw-lighter fst-italic text-secondary"><i class="fw-bold">Team: </i>{{$user->team->name}}</div>
        <div class="fs-8 fw-lighter fst-italic text-secondary"><i class="fw-bold">Email: </i><a class="text-secondary" href="mailto:{{$user->email}}">{{$user->email}}</a></div>
      </div>
    @endforeach
    </table>
  </div>
</div>
@endsection
