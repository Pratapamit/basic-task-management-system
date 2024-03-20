<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
<body>

@include('users.layout.nav')

<div class="container">
    <a href="{{route('category.create')}}" class="float-end btn btn-info">Create</a>
    <br><br>
   

    <form action="{{route('category.update',$data->id)}}" method="post">
    @csrf
    @method('patch')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="title" name="title" class="form-control" id="title" value="{{$data->title}}">
            @error('title')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="priority" class="form-label">Priority</label>
            <select name="priority" id="priority" class="form-control">
                <option value="low" @if($data->priority == 'low') selected @endif>Low</option>
                <option value="medium" @if($data->priority == 'medium') selected @endif>Medium</option>
                <option value="high" @if($data->priority == 'high') selected @endif>High</option>
            </select>
            @error('priority')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active" selected>Active</option>
                <option value="inactive" @if($data->status == 'inactive') selected @endif>InActive</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>

</div>
    
</body>
</html>