<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tast Management</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</head>

<body>
<h1 class="text-center">Task Management System</h1>
<br>

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

    <div class="container">
        <h2 class="text-center my-2">Register</h2>
        <form action="{{route('register-submit')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" name="name" class="form-control" id="name" value="{{old('name')}}">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{old('email')}}">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
    
    <label for="phone" class="form-label">Phone</label>
    <input type="phone" name="phone" class="form-control" id="phone" value="{{old('phone')}}">
    @error('phone')
    <span class="text-danger">{{$message}}</span>
    @enderror

        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        @error('password')
        <span class="text-danger">{{$message}}</span>
        @enderror
    
        <br>
    <a href="{{route('login')}}">Already have an account? Please login.</a><br><br>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>

</body>

</html>