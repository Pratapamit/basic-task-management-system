<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth()->user()->id;

        $data['title'] = 'Categories';
        $data['data'] = Category::where('user_id',$user_id)->orderBy('id','desc')->get();

        return view('users.categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Category';
        return view('users.categories.create',$data);
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
        ]);

        $data = $request->only('title','status','priority');
        $data['user_id'] = Auth()->user()->id;
        
        $status = Category::create($data);

        if($status){
            return redirect()->route('category.index')->with('success','Data added successfully.');
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
        $status = Category::find($id)->delete();

        if($status){
            return redirect()->route('category.index')->with('success','Data deleted successfully.');
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
        $data['title'] = 'Add Category';
        $data['data'] = Category::find($id);
        return view('users.categories.edit',$data);
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
        ]);

        $data = $request->only('title','status','priority');
        
        $status = Category::find($id)->update($data);

        if($status){
            return redirect()->route('category.index')->with('success','Data updated successfully.');
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
        $status = Category::find($id)->delete();

        if($status){
            return redirect()->route('category.index')->with('success','Data deleted successfully.');
        }

        return back()->with('error','Oops something went wrong, please try again.');
    }
}
