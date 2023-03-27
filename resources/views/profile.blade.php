@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-header">Profile Settings</div>
        <div class="card-body">
          <form>
            @csrf
            <div class="form-floating mb-3">
              <input id="name" name="name" class="form-control" value="{{Auth::user()->name}}" placeholder="Name" required>
              <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
              <input id="emai" name="email" type="email" class="form-control" value="{{Auth::user()->email}}" placeholder="E-mail" required>
              <label for="email">E-mail</label>
            </div>
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Password Settings</div>
        <div class="card-body">
          <form>
            @csrf
            <div class="form-floating mb-3">
              <input id="c_pass" name="c_pass" class="form-control" placeholder="" type="password" required>
              <label for="c_pass">Current Password</label>
            </div>
            <div class="form-floating mb-3">
              <input id="n_pass" name="n_pass" type="password" class="form-control" placeholder="" required>
              <label for="n_pass">New Password</label>
            </div>
            <div class="form-floating mb-3">
              <input id="cn_pass" name="cn_pass" type="password" class="form-control" placeholder="" required>
              <label for="cn_pass">Confirm New Password</label>
            </div> 
            <div class="mb-3">
              <button type="submit" class="btn btn-danger">Change Password</button>
            </div>
          </form>
        </div>
    </div>

  </div>
</div>
@endsection
      
