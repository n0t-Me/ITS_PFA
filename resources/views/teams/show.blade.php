@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h5><strong>Team Name:</strong> {{$team->name}}</h5>
    <div class="fst-italic fw-lighter fs-8 text-secondary"><i class="fw-bold">Team Description: </i>{{$team->description}}</div>
    @foreach($team->members as $member)
      <div class="card card-body mt-4">
        <div class="d-flex justify-content-between">
          <strong>Name: {{$member->name}}</strong>
          <div class="dropdown show">
            <a class="btn" id="dropdownUser{{$member->id}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownUser{{$member->id}}">
              <button class="dropdown-item" href="#">Edit User</button>
              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#teamModal" data-bs-userid="{{$member->id}}">Change Team</button>
            </div>
          </div>
        </div>
        <p class="text-secondary fw-lighter fst-italic"><i class="fw-bold">Email</i>: {{$member->email}}
      </div>
    @endforeach
  </div>
</div>
<div class="modal fade" id="teamModal" tabindex="-1" aria-hidden="true" aria-labelledby="teamModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teamModalLabel">Change Team</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('changeTeam')}}">
          @csrf
          <input type="hidden" name="userid" value="">
          <div class="mb-3">
            <select class="form-select" name="team_id" required>
              <option value="" selected>-- Choose a Team --</option>
              @foreach ($teams as $t)
                @if ($t->id === $team->id)
              <option value="{{$team->id}}" disabled>{{$team->name}}</option>
                @else 
              <option value="{{$t->id}}">{{$t->name}}</option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Change Team</button>
          </div> 
        </form>
      </div>
   </div>
  </div>
</div>
<script type="text/javascript">
var teamModal = document.getElementById('teamModal')
teamModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-userid')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalBodyInput = teamModal.querySelector('.modal-body input[name="userid"]')
  console.log(modalBodyInput)

  modalBodyInput.value = recipient
})
</script>
@endsection
