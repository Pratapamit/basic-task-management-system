<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Task,Category,CategoryTask};

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;

        $data['title'] = 'Tasks';
        $data['data'] = Task::where('user_id',$user_id)->orderBy('id','desc')->get();

        return view('users.tasks.index',$data);
    }

    public function restore()
    {
        $user_id = Auth()->user()->id;

        $data['title'] = 'Tasks';
        $data['data'] = Task::where('user_id',$user_id)->orderBy('id','desc')->onlyTrashed()->get();

        return view('users.tasks.restore',$data);
    }

    public function restore_data($id)
    {
        $user_id = Auth()->user()->id;

        $data['title'] = 'Tasks';
        $data['data'] = Task::where('user_id',$user_id)->orderBy('id','desc')->get();

        $task = Task::withTrashed()->findOrFail($id);
        $task->restore(); // Restore soft-deleted record

        return view('users.tasks.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Task';

        $user_id = Auth()->user()->id;
        $data['categories'] = Category::where('user_id',$user_id)->where('status','active')->orderBy('id','desc')->get();
        return view('users.tasks.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'category' => 'required',
            'description' => 'required',
            // 'images' => 'required',
        ]);

        $user_id = Auth()->user()->id;

        // dd($request->all());
        $data = $request->only('title','status','priority','description');
        $data['categories_id'] = 1;
        $data['user_id'] = $user_id;
        

        // dd($request->all());
        
        $imageName2 = [];
        
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file)
            {
                $image_name = '/uploads/tasks/'.$file->getClientOriginalName();      
                $file->move(public_path('uploads/tasks'), $image_name);      
                $imageName[] = $image_name;  
            }
            $imageName2 = str_replace("\\","",json_encode($imageName));
            $data['images'] = $imageName2;
        }

        $status = Task::create($data);

        $last_id = Task::orderBy('id','desc')->first();
        

        if($status){

            CategoryTask::where('task_id',$last_id->id)->delete();
    
            foreach ($request->category as $cat) {
                $category_data = [
                    'category_id' => $cat,
                    'task_id' => $last_id->id,
                ];
    
                CategoryTask::create($category_data);
            }
            
            return redirect()->route('task.index')->with('success','Data added successfully.');
        }

        return back()->with('error','Oops something went wrong, please try again.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Task::find($id)->delete();

        if($status){
            return redirect()->route('task.index')->with('success','Data deleted successfully.');
        }

        return back()->with('error','Oops something went wrong, please try again.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Add Task';
        $data['data'] = Task::find($id);
        $user_id = Auth()->user()->id;
        $data['categories'] = Category::where('user_id',$user_id)->where('status','active')->orderBy('id','desc')->get();
        return view('users.tasks.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'category' => 'required',
            'description' => 'required',
            // 'images' => 'required',
        ]);

        // dd($request->all());
        $data = $request->only('title','status','priority','description');
        $data['categories_id'] = 1;
        
        $imageName2 = [];
        
        if($request->hasFile('images')) {
            foreach($request->file('images') as $file)
            {
                $image_name = '/uploads/tasks/'.$file->getClientOriginalName();      
                $file->move(public_path('uploads/tasks'), $image_name);      
                $imageName[] = $image_name;  
            }
            $imageName2 = str_replace("\\","",json_encode($imageName));
            $data['images'] = $imageName2;
        }else{
            $data['images'] = $request->hidden_images;
        }
        

        $status = Task::find($id)->update($data);

        if($status){

            if(count($request->category) > 0){
                CategoryTask::where('task_id',$id)->delete();
    
                foreach ($request->category as $cat) {
                    $category_data = [
                        'category_id' => $cat,
                        'task_id' => $id,
                    ];
        
                    CategoryTask::create($category_data);
                }
            }           

            return redirect()->route('task.index')->with('success','Data udpate successfully.');
        }

        return back()->with('error','Oops something went wrong, please try again.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Task::find($id)->delete();

        if($status){
            return redirect()->route('Task.index')->with('success','Data deleted successfully.');
        }

        return back()->with('error','Oops something went wrong, please try again.');
    }
}
