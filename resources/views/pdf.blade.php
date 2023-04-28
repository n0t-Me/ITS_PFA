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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

<style>
  /* Style pour les balises "body" */
body {
  font-size: 16px;
  font-family: Arial, sans-serif;
  line-height: 1.5;
  color: #333;
  margin: 0;
  padding: 0;
}

/* Style pour les balises "p" */
p {
  margin: 0;
  padding: 0;
}

/* Style pour les balises "a" */
a {
  color: #007bff;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

/* Style pour les badges */
.badge {
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  margin-left: 8px;
}

/* Style pour les badges de statut */
.badge.bg-primary {
  background-color: #007bff;
  color: #fff;
}

.badge.bg-secondary {
  background-color: #6c757d;
  color: #fff;
}

/* Style pour les badges de gravité */
.badge.bg-danger {
  background-color: #dc3545;
  color: #fff;
}

.badge.bg-warning {
  background-color: #ffc107;
  color: #333;
}

.badge.bg-success {
  background-color: #28a745;
  color: #fff;
}

/* Style pour les cartes */
.card {
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  padding: 16px;
  margin-bottom: 16px;
}

.card-body {
  padding: 0;
}

/* Style pour les en-têtes de cartes */
.card .d-flex.justify-content-between {
  margin-bottom: 8px;
}

.card .d-flex.justify-content-between > div:first-child {
  flex: 1;
}

/* Style pour les éléments de texte */
.fst-italic {
  font-style: italic;
}

.fw-lighter {
  font-weight: lighter;
}

.text-secondary {
  color: #6c757d;
}

.hover-blue:hover {
  color: #007bff;
}

</style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center">
    <p class="fs-4">{{$title}}</p>
    @forelse ($issues as $issue)
      <div class="card card-body mb-4">
        <div class="d-flex justify-content-between">
          <a class="hover-blue" style="text-decoration: none;color: black;" href="{{url('/issues/'.$issue->id)}}">{{ $issue->title }}</a>
          <div>
            @if ($issue->status==="Open")
              <span class="badge bg-primary">Open</span>
            @else
              <span class="badge bg-secondary">Closed</span>
              @endif

            <span class="badge {{$status[$issue->severity]}}">Severity:{{$issue->severity}}</span>
          </div>
        </div>
        <div class="d-flex justify-content-between"><div class="fs-8 fw-lighter fst-italic text-secondary">Opened on {{date_format(date_create($issue->opened_at), "d-m-Y")}} by {{ $issue->owner->name}}</div><div class="fs-8 fw-lighter fst-italic text-secondary">Comments count:{{$issue->comments_count}}</div></div>
      </div>
    @empty
      <h2 class="mt-4 fw-bolder text-secondary text-center">No Issues</h2>
    @endforelse
  </div>
</div>
</body>
</html>
