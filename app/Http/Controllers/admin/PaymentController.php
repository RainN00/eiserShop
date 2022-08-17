<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();

        return view('admin.payment.list',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment.create');
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
            'name' => ['required','string','unique:payments'],
            'description' => ['required']
        ],[
            'name.required' => "Payment name is required",
            'name.string' => "Payment name is string",
            'name.unique' => "This Payment name is already taken",
            'description.required' => "Payment description is required"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            Payment::insert([
                'name' => $request->name,
                'description' => $request->description,
                'status' => 1,
                'created_at' => Carbon::now()
            ]);
            return response()->json([
                'code' => 1,
                'msg' => "Create payment successfully"
            ]);
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
        $payment = Payment::find($id);

        return view('admin.payment.edit',compact('payment'));
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
        $payment = Payment::find($id);
        $validator = Validator::make($request->all(),[
            'name' => ['required','string'],
            'description' => ['required']
        ],[
            'name.required' => "Payment name is required",
            'name.string' => "Payment name is string",
            'name.unique' => "This Payment name is already taken",
            'description.required' => "Payment description is required"
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'code' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $payment->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'updated_at' => Carbon::now()
            ]);
            return response()->json([
                'code' => 1,
                'msg' => "Update payment successfully"
            ]);
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
        $payment = Payment::find($id);
        $payment->delete($id);

        return response()->json([
            'msg' => 'Record Payment successfully!'
        ]);
    }
}
