<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Task Management System</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('category.index')}}">Categories</a>
  </li>
  <li class="nav-item">
  <a class="nav-link" href="{{route('task.index')}}">Tasks</a>
  </li>
  <li class="nav-item float-end">
  <a class="nav-link" href="{{route('logout')}}">Logout</a>
  </li>
</ul>

<hr>

@if(session()->has('error'))
<div class="alert alert-danger" role="alert">
  {{session()->get('error')}}
</div>
@endif

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
  {{session()->get('success')}}
</div>
@endif