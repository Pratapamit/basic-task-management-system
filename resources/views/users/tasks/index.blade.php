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
    <a href="{{route('task.create')}}" class="float-end btn btn-info">Create</a>
    <a href="{{route('task.restore')}}" class="float-end btn btn-info">Restore Data</a>
    <br><br>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Images</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data) > 0)
                @foreach($data as $key=>$value)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->title}}</td>
                    <td>{{$value->description}}</td>
                    <td>
                        @if($value->images)
                        @foreach(json_decode($value->images) as $image)
                         <img src="{{asset($image)}}" style="width:50px;">
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @php $multi_cat = DB::table('categorytasks')->where('task_id',$value->id)->get(); @endphp
                        @if(count($multi_cat) >0)
                        @foreach($multi_cat as $m_cat)
                        @php $cat = DB::table('categories')->find($m_cat->category_id); @endphp
                        {{$cat->title}} <br>
                        @endforeach
                        @endif
                        </td>
                    <td>{{$value->priority}}</td>
                    <td>
                    @if($value->status == 'active')
                        <button class="btn btn-warning">Incomplete</button>
                        @else
                        <button class="btn btn-success">Complete</button>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('task.edit',$value->id)}}" class="btn btn-warning">Edit</a>
                        <a href="{{route('task.destroy',$value->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    
</body>
</html>