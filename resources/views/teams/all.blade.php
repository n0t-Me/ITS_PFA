@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <p class="fs-4">All Teams</p>
    @foreach ($teams as $team)
      <div class="card card-body mb-4">
        <div class="d-flex justify-content-between">
          <a class="hover-blue" style="text-decoration: none;color: black;" href="{{url('/teams/'.$team->id)}}" id="team{{$team->id}}-name">{{ $team->name }}</a>
          <div class="hstack">
            @if ($team->hidden == True)
              <span class="badge bg-dark" id="team{{$team->id}}-hidden">Hidden</span>
              @endif
            @if ($team->id > 2)
            <div class="dropdown show">
              <a class="btn" id="dropdownTeam{{$team->id}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownTeam{{$team->id}}">
                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-teamid={{$team->id}}><i class="bi bi-pen"></i> Edit Team</button>
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-teamid="{{$team->id}}"><i class="bi bi-trash"></i> Delete Team</button>
              </div>
            </div>
            @endif
          </div>
        </div>
        <div class="d-flex justify-content-between"><div id="team{{$team->id}}-desc"class="fs-8 fw-lighter fst-italic text-secondary">{{$team->description}}</div><div class="fs-8 fw-lighter fst-italic text-secondary"></div></div>
      </div>
    @endforeach
  </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Team </h3>
      </div>
      <div class="modal-body">
        <p>All the member of this team will be moved to the guests team.</p>
        <strong>Proceed?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i> Delete Team</button>
      </div> 
   </div>
  </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" aria-labelledby="editModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Team </h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
          @csrf
          <div class="form-floating mb-3">
            <input id="name" name="name" class="form-control" placeholder="" required>
            <label for="name">Name</label>
          </div>
          <div class="form-floating mb-3">
            <textarea id="description" name="description" class="form-control" placeholder="" style="height: 200px" required></textarea>
            <label for="description">Description</label>
          </div>
          <div class="mb-3 form-check form-switch">
            <input class="form-check-input" name="hidden" id="hidden_switch" type="checkbox">
            <label class="form-check-label" for="hidden_switch">Hidden Team</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="bi bi-pen"></i> Edit Team</button>
          </div> 
        </form>
      </div>
   </div>
  </div>
</div>

<script type="text/javascript">
var deleteModal = document.getElementById('deleteModal')
deleteModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-teamid')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var btn = deleteModal.querySelector('.modal-footer .btn-danger');
  btn.onclick = () => {
    window.location = "{{url('/teams/')}}" + "/" + recipient + "/delete";
  }
})
var editModal = document.getElementById('editModal')
editModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-teamid')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var name = document.getElementById('team' + recipient + "-name").textContent;
  var desc = document.getElementById('team' + recipient + "-desc").textContent;
  var hidden = document.getElementById('team' + recipient + '-hidden');

  var name_input = editModal.querySelector('input[name="name"]');
  var desc_input = editModal.querySelector('textarea[name="description"]');
  var switch_input = editModal.querySelector('input[name="hidden"]');

  name_input.value = name;
  desc_input.value = desc;
  if (hidden) {
    switch_input.checked = true;
  } else {
    switch_input.checked = false;
  }

  var form = editModal.querySelector('form');
  form.action = '/teams/' + recipient + '/edit';
})
</script>
</script>
@endsection
