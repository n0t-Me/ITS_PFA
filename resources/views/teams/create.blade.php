@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Team</div>
          <div class="card-body">
            <form method="POST" action="{{route('storeTeam')}}">
              @csrf
              <div class="form-floating mb-3">
                <input id="name" name="name" class="form-control" placeholder="" required>
                <label for="name">Title</label>
              </div>
              <div class="form-floating mb-3">
                <textarea id="description" name="description" class="form-control" placeholder="" style="height: 200px" required></textarea>
                <label for="description">Description</label>
              </div>
              <div class="mb-3 form-check form-switch">
                <input class="form-check-input" name="hidden" id="hidden" type="checkbox">
                <label class="form-check-label" for="hidden">Hidden Team</label>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create Team</button>
              <div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
