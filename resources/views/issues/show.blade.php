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

@section('content')
<div class="container">
  <div class="d-flex flex-column justify-content-center gap-4">
    <div class="card">
      <div class="d-flex card-header justify-content-between">
        <strong>{{$issue->title}}</strong>
        <div class="hstack gap-1">
          @if ($issue->status === "Open")
            <span class="badge bg-primary">Open</span>
          @else
            <span class="badge bg-secondary">Closed</span>
          @endif
          <span class="badge {{ $status[$issue->severity] }}">Severity:{{$issue->severity}}</span>
          <span class="badge bg-info">Team:{{$issue->team->name}}</span>
          <div class="dropdown show">
          @if ((Auth::user()->role === "team-admin" || $issue->owner_id === Auth::user()->id || $issue->assignee_id === Auth::user()->id) && $issue->status === "Open") 
            <a class="btn p-0" id="dropdownIssue" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownIssue">
              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#issueModal">Edit Issue</button>
              @if (Auth::user()->role === "team-admin")
              <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#assignModal">Assign To</button>
              @endif
              @if (Auth::user()->role === "team-admin" || Auth::user()->id === $issue->assignee_id)
              <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#closeModal">Close Issue</button>
              @endif
            </div>
          @endif
          </div>
          
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div><div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Reported on {{date_format(date_create($issue->created_at), "d-m-Y")}} by {{ $issue->owner->name}}</div></div>
          @if($issue->assignee)
            <div><div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Assigned to <i class="fw-bold">{{$issue->assignee->name}}</i></div></div>
          @else 
            <div><div class="mt-1 fs-8 fw-lighter fst-italic text-secondary">Assigned to nobody</div></div>
          @endif
        </div>
        {{$issue->description}}
        </div>
        @if (count($issue->attachements) > 0)
          <div class="m-3 ps-2 border-start border-primary border-3">
            <strong><i class="bi bi-paperclip"></i>Attachements:</strong>
            <div class="list-group">
            @foreach ($issue->attachements as $a)
              <a class="list-group-item" href="/storage/{{$a->path}}">{{$a->name}}</a>
            @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>
      <div class="d-flex flex-row justify-content-start">
      <div class="col-md-11">
      @if (count($issue->comments) > 0)
      <hr class=""/>
      <h5>Comments</h5>
      @foreach ($issue->comments as $comment)
          <div class="card mt-3">
            <div class="card-header d-flex justify-content-between">
              <div><strong>{{$comment->owner->name}}</strong></div>
                <div class="hstack gap-1">
                <div class="fs-8 fst-italic fw-lighter text-secondary">{{$comment->created_at}}</div>
                @if ($comment->owner_id === Auth::user()->id && $issue->status === "Open")
                  <a class="btn p-0" id="dropdownComment{{$comment->id}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownComment{{$comment->id}}">
                  <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#commentModal" data-bs-commentid="{{$comment->id}}">Edit Comment</button>
                  <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deletecommentModal" data-bs-commentid="{{$comment->id}}">Delete Comment</button>
                </div>
                @endif
              </div>
            </div>
            <div class="card-body"> 
              <div id="comment{{$comment->id}}-comment">{{$comment->comment}}</div>
              @if (count($comment->attachements) > 0)
                <div class="m-3 ps-2 border-start border-primary border-3">
                  <strong><i class="bi bi-paperclip"></i>Attachements:</strong>
                  <div class="list-group">
                  @foreach ($comment->attachements as $a)
                    <a class="list-group-item" href="/storage/{{$a->path}}">{{$a->name}}</a>
                  @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>
        @endforeach
        @endif
      @if ($issue->status === "Open" && (Auth::user()->id ===  $issue->owner_id || Auth::user()->role === "member" || Auth::user()->role === "team-admin"))
        <hr class=""/>
        <form class="mt-4" method="POST" action="{{url()->current()}}/newComment" enctype="multipart/form-data">
          @csrf
          <textarea class="form-control" name="comment" placeholder="New Comment" required></textarea>
          <div class="input-group">
            <input name="files[]" class="mt-2 form-control" type="file" multiple>
            <button type="submit" class="mt-2 btn btn-primary">Comment <i class="bi bi-send"></i></button>
          </div>
        </form>
      @else 
        <hr class=""/>
        @php
          $diff = date_diff(date_create($issue->opened_at),date_create($issue->closed_at));
        @endphp
        @if ($diff->days < 1)
          <div class="fw-lighter fs-8 fst-italic text-secondary">Issue closed on {{ date_format(date_create($issue->closed_at), 'd-m-Y')}}, {{$diff->format("%H hours %I minutes")}} after reporting</div>
        @else 
          <div class="fw-lighter fs-8 fst-italic text-secondary">Issue closed on {{ date_format(date_create($issue->closed_at), 'd-m-Y')}}, {{$diff->format("%a")}} days after reporting</div>
        @endif
      @endif
      </div>
      </div>
    </div>
</div>
<div class="modal fade" id="issueModal" tabindex="-1" aria-hidden="true" aria-labelledby="issueModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="issueModalLabel">Edit Issue</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="/issues/{{$issue->id}}/edit">
          @csrf
          <div class="form-floating mb-3">
            <input id="title" name="title" class="form-control" placeholder="" value="{{$issue->title}}" required>
            <label for="title">Title</label>
          </div>
          <div class="form-floating mb-3">
            <textarea id="description" name="description" class="form-control" placeholder="" style="height: 200px" required>{{$issue->description}}</textarea>
            <label for="description">Description</label>
          </div>
          <div class="mb-3">
            <label for="severity">Severity</label>
            <input id="severity" name="severity" class="form-range" type="range" min="1" max="10" step="1" list="severityTicks" value="{{$issue->severity}}">
            <datalist id="severityTicks">
            @for ($i=1; $i <= 10; $i++)
            <option value="{{$i}}"></option>
            @endfor
            </datalist>
          </div>          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="bi bi-pen"></i> Edit Issue</button>
          </div> 
        </form>
      </div>
   </div>
  </div>
</div>
<div class="modal fade" id="closeModal" tabindex="-1" aria-hidden="true" aria-labelledby="closeModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="closeModalLabel">Close Issue</h3>
      </div>
      <div class="modal-body">
        <p>You are going to close the issue. Proceed?</p>
      </div>          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a role="button" class="btn btn-danger" href="/issues/{{$issue->id}}/close"><i class="bi bi-exclamation-triangle"></i> Close Issue</a>
      </div> 
   </div>
  </div>
</div>
<div class="modal fade" id="commentModal" tabindex="-1" aria-hidden="true" aria-labelledby="commentModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commentModalLabel">Edit Comment</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
          @csrf
          <div class="form-floating mb-3">
            <textarea id="comment" name="comment" class="form-control" placeholder="" style="height: 200px" required></textarea>
            <label for="description">Comment</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="bi bi-pen"></i> Edit Comment</button>
          </div> 
        </form>
      </div>
   </div>
  </div>
</div>
<div class="modal fade" id="deletecommentModal" tabindex="-1" aria-hidden="true" aria-labelledby="deletecommentModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletecommentModalLabel">Delete Comment</h3>
      </div>
      <div class="modal-body">
        <p>You are going to delete this comment. Proceed?</p>
      </div>          
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a role="button" class="btn btn-danger" href=""><i class="bi bi-trash"></i> Delete Comment</a>
      </div> 
   </div>
  </div>
</div>
<div class="modal fade" id="assignModal" tabindex="-1" aria-hidden="true" aria-labelledby="assignModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assignModalLabel">Assign To</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="/issues/{{$issue->id}}/assign_to">
          @csrf
          <div class="form-floating mb-3">
            <select id="assignee_id" name="assignee_id" class="form-control" placeholder="" value="" required>
              <option value="" selected disabled>-- Choose a Member --</option>
              @foreach($members as $member)
              <option value="{{$member->id}}">{{$member->name}}</option>
              @endforeach
            </select>
            <label for="assignee_id">Member Name</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus"></i> Assign</button>
          </div> 
        </form>
      </div>
   </div>
  </div>
</div>

<script type="text/javascript">
var commentModal = document.getElementById('commentModal');
var deletecommentModal = document.getElementById('deletecommentModal');
commentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-commentid')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var comment = document.getElementById('comment' + recipient + '-comment').innerText;

  var modalBodyform = commentModal.querySelector('form');
  modalBodyform.querySelector('textarea').textContent = comment;
  modalBodyform.action = "/comments/" + recipient + "/edit";
})
deletecommentModal.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var recipient = button.getAttribute('data-bs-commentid')
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  var modalLink = deletecommentModal.querySelector('a');
  modalLink.href = "/comments/" + recipient + "/delete";
})
</script>
@endsection
