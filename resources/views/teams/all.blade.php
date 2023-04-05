@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <p class="fs-4">All Teams</p>
    @foreach ($teams as $team)
      <div class="card card-body mb-4">
        <div class="d-flex justify-content-between">
          <a class="hover-blue" style="text-decoration: none;color: black;" href="{{url('/teams/'.$team->id)}}">{{ $team->name }}</a>
          <div class="hstack">
            @if ($team->hidden == True)
              <span class="badge bg-dark">Hidden</span>
              @endif
            @if ($team->id > 2)
            <div class="dropdown show">
              <a class="btn" id="dropdownTeam{{$team->id}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
              <div class="dropdown-menu" aria-labelledby="dropdownTeam{{$team->id}}">
                <button class="dropdown-item">Edit Team</button>
                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-teamid="{{$team->id}}">Delete Team</button>
              </div>
            </div>
            @endif
          </div>
        </div>
        <div class="d-flex justify-content-between"><div class="fs-8 fw-lighter fst-italic text-secondary">{{$team->description}}</div><div class="fs-8 fw-lighter fst-italic text-secondary"></div></div>
      </div>
    @endforeach
  </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="teamModalLabel">Delete Team </h3>
      </div>
      <div class="modal-body">
        <p>All the member of this team will be moved to the guests team.</p>
        <strong>Proceed?</strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger">Delete Team</button>
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
</script>
@endsection
