@extends('layouts.app2')
<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h5><strong>Team Name:</strong> {{$team->name}}</h5>
    <div class="fst-italic fw-lighter fs-8 text-secondary"><i class="fw-bold">Team Description: </i>{{$team->description}}</div>
    <hr class="m-4"/>
    <h5 class="mb-0"><strong>Members:</strong></h5>
    @foreach($team->members as $member)
      <div class="card card-body mt-4">
        <div class="d-flex justify-content-between">
          <strong>Name: {{$member->name}}</strong>
       </div>
        <p class="text-secondary fw-lighter fst-italic"><i class="fw-bold">Email</i>: {{$member->email}}
      </div>
    @endforeach
  </div>
</div>
@endsection
