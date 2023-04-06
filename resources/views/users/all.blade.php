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
          <b id="username{{$user->id}}">{{ $user->name }}</b>
          <div class="hstack">
            <span class="badge {{$status[$user->role]}}">{{$user->role}}</span>
            <div class="dropdown show">
              <a class="btn" id="dropdownUser{{$user->id}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownUser{{$user->id}}">
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#resetModal" data-bs-userid="{{$user->id}}"><i class="bi bi-arrow-clockwise"></i> Reset Password</button>
              </div>
            </div>
          </div>
        </div>
        <div class="fs-8 fw-lighter fst-italic text-secondary"><i class="fw-bold">Team: </i>{{$user->team->name}}</div>
        <div class="fs-8 fw-lighter fst-italic text-secondary"><i class="fw-bold">Email: </i><a class="text-secondary" href="mailto:{{$user->email}}">{{$user->email}}</a></div>
      </div>
    @endforeach
  </div>
</div>
<div class="modal fade" id="resetModal" tabindex="-1" aria-hidden="true" aria-labelledby="resetModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resetModalLabel">Reset Password </h3>
      </div>
      <div class="modal-body">
        <p id="resetMsg"></p>
        <strong>Proceed?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger"><i class="bi bi-arrow-clockwise"></i> Reset Password</button>
      </div> 
   </div>
  </div>
</div>
<script type="text/javascript">
var resetModal = document.getElementById('resetModal')
resetModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-userid')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var btn = resetModal.querySelector('.modal-footer .btn-danger');
  var user_name = document.getElementById('username' + recipient).innerText;
  var msg = document.getElementById('resetMsg');
  msg.innerText = "This will reset the password of user \"" + user_name + "\"." ;
  btn.onclick = () => {
    window.location = "/users/" + recipient + "/resetPassword";
  }
})
</script>
@endsection
