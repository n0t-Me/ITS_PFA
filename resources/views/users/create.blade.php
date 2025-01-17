@extends('layouts.app2')
<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

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
