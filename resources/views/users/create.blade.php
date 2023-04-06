@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Create User</div>
          <div class="card-body">
            <form method="POST" action="{{route('storeUser')}}">
              @csrf
              <div class="form-floating mb-3">
                <input id="name" name="name" class="form-control" placeholder="" required>
                <label for="name">Name</label>
              </div>
              <div class="form-floating mb-3">
                <input id="email" name="email" type="email" class="form-control" placeholder="" required>
                <label for="description">Email</label>
              </div>
              <div class="input-group mb-3">
                <div class="form-floating">
                  <input id="password" name="password" type="password" class="form-control" placeholder="" required>
                  <label for="password">Password</label>
                </div>
                <button id="showPasswordBtn" class="btn btn-primary"><i class="bi bi-eye-fill"></i></button>
              </div>
              <div class="mb-3">
                <select class="form-select" name="team_id" required>
                  <option value="" selected disabled>-- Choose a Team --</option>
                  @foreach ($teams as $t)
                  <option value="{{$t->id}}">{{$t->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <select class="form-select" name="role" required>
                  <option value="" selected disabled>-- Choose a Role --</option>
                  @foreach (['admin', 'team-admin', 'member','guest'] as $r)
                  <option value="{{$r}}">{{$r}}</option>
                  @endforeach
                </select>
              </div>
 
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create User</button>
              <div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script defer>
var btn = document.getElementById("showPasswordBtn");
btn.onclick = (e) => {
  e.preventDefault();
  var pwd = document.getElementById('password');
  var is_pwd = pwd.type === 'password';
  var eye = btn.children[0];
  eye.attributes.class.nodeValue = is_pwd ? 'bi bi-eye-fill' : 'bi bi-eye-slash-fill';
  pwd.type = is_pwd ? 'text' : 'password';
}
const team_select = document.querySelector('select[name="team_id"]');
const role_select = document.querySelector('select[name="role"]');
const checkNDisable = () => {
  if (team_select.value === "1") {
    role_select.value="guest";
    [...role_select.children].forEach((el) => {
      if (el.value !== "guest") {
        el.disabled = true;
      }
    })
  } else if(team_select.value === "2") {
    role_select.value="admin";
    [...role_select.children].forEach((el) => {
      if (el.value !== "admin") {
        el.disabled = true;
      }
    })
  } else {
    role_select.value="member";
    [...role_select.children].forEach((el) => {
      el.disabled = false;
      if (el.value === "guest" || el.value === "admin" || el.value === "") {
        el.disabled = true;
      }
    })
  }
}
checkNDisable();
team_select.onchange = () => {
  checkNDisable();
}
</script>
@endsection
