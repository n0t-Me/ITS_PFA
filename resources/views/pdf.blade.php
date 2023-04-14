<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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