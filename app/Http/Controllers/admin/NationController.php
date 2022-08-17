<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nation;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class NationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nations = Nation::all();
        return view('admin.nation.list', compact('nations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required','string','unique:categories'],
        ],[
            'name.required' => "Nation name is required",
            'name.string' => "Nation name is string",
            'name.unique' => "This Nation name is already taken"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                $path = "images/nations";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);
                Nation::insert([
                    'name' => $request->name,
                    'thumbnail' => $path.'/'.$file_name,
                    'description' => $request->description,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create nation successfully"
                ]);
            } else {
                $file_name = "images/noimages.jpg";
                Nation::insert([
                    'name' => $request->name,
                    'thumbnail' => $file_name,
                    'description' => $request->description,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'code' => 1,
                    'msg' => "Create nation successfully"
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nation = Nation::findOrFail($id);

        return view('admin.nation.edit',compact('nation'));
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
        $nation = Nation::find($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
        ],[
            'name.required' => "Nation name is required",
            'name.string' => "Nation name is string"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('thumbnail')) {
                if (filter_var($nation->thumbnail, FILTER_VALIDATE_URL) === false) {
                    unlink($nation->thumbnail);
                }
                $path = "images/nations";
                $file = $request->file('thumbnail');
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move($path, $file_name);


                $nation->name = $request->name;
                $nation->thumbnail = $path.'/'.$file_name;
                $nation->description = $request->description;
                $nation->updated_at = Carbon::now();
                $nation->save();

                return response()->json([
                    'code' => 1,
                    'msg' => "Update nation successfully"
                ]);
            } else {
                $file_name = $nation->thumbnail;
                $nation->name = $request->name;
                $nation->thumbnail = $file_name;
                $nation->description = $request->description;
                $nation->updated_at = Carbon::now();
                $nation->save();
                return response()->json([
                    'code' => 1,
                    'msg' => "Update nation successfully"
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nation = Nation::find($id);
        unlink($nation->thumbnail);
        $nation->delete($id);

        return response()->json([
            'msg' => 'Record deleted successfully!'
        ]);
    }
}
