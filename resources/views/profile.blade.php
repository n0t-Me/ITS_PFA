@extends('layouts.app2')
<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mb-3">
        <div class="card-header">Profile Settings</div>
        <div class="card-body">
          <form method="POST" action="{{route('updateUserInfo')}}">
            @csrf
            <div class="form-floating mb-3">
              <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="@error('name') {{old('name')}} @else {{Auth::user()->name}} @enderror" placeholder="Name" required>
              <label for="name">Name</label>
              <div class="invalid-feedback">
                This name is taken
              </div>
            </div>
            <div class="form-floating mb-3">
              <input id="emai" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="@error('email') {{old('email')}} @else {{Auth::user()->email}} @enderror" placeholder="E-mail" required>
              <label for="email">E-mail</label>
              <div class="invalid-feedback">
                This email is taken
              </div>
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
          <form method="POST" action="{{route('updateUserPassword')}}">
            @csrf
            <div class="form-floating mb-3">
              <input id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="" type="password" required>
              <label for="password">Current Password</label>
              <div class="invalid-feedback">
                Invalid Creds
              </div>
            </div>
            <div class="form-floating mb-3">
              <input id="n_password" name="n_password" type="password" class="form-control @error('n_password') is-invalid @enderror" placeholder="" required>
              <label for="n_password">New Password</label>
              <div class="invalid-feedback">
                Password must be at least 8 characters long and contains at least 1 uppercase, 1 lowercase, 1 number, 1 symbol
              </div>
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
      
