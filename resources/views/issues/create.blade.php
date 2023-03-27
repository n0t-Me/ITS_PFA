@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create Issue</div>
          <div class="card-body">
            <form method="POST" action="{{route('storeIssue')}}">
              @csrf
              <div class="form-floating mb-3">
                <input id="title" name="title" class="form-control" placeholder="" required>
                <label for="title">Title</label>
              </div>
              <div class="form-floating mb-3">
                <textarea id="description" name="description" class="form-control" placeholder="" style="height: 200px" required></textarea>
                <label for="description">Description</label>
              </div>
              <div class="mb-3">
                <label for="severity">Severity</label>
                <input id="severity" name="severity" class="form-range" type="range" min="1" max="10" step="1" list="severityTicks">
                <datalist id="severityTicks">
                  <option value="1"/>
                  <option value="2"/>
                  <option value="3"/>
                  <option value="4"/>
                  <option value="5"/>
                  <option value="6"/>
                  <option value="7"/>
                  <option value="8"/>
                  <option value="9"/>
                  <option value="10"/>
                </datalist>
              </div>
              <div class="mb-3">
                <label for="file">Attachement</label>
                <input class="form-control" name="file" id="file" type="file" multiple>
              </div>
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create Issue</button>
              <div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection