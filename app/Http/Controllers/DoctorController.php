<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    //
    public function index(Request $request){
        $doctor = DB::table('doctors')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('doctor_name', 'like', '%' . $name . '%');
        }) ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.doctor.index', compact('doctor'));
    }


    // create
    public function create(){
        return view('pages.doctor.create');
    }

    // store
    public function store (Request $request){
        $request->validate([
            'doctor_name' => 'required',
            'doctor_spesialist'=> 'required',
            'doctor_phone'=> 'required',
            'doctor_email'=> 'required|email',
            'sip'=> 'required',
        ]);


        DB::table('doctors')->insert([
            'doctor_name' => $request->doctor_name,
            'doctor_spesialist'=> $request->doctor_spesialist,
            'doctor_phone'=> $request->doctor_phone,
            'doctor_email'=> $request->doctor_email,
            'sip'=> $request->sip,
        ]);

        return redirect()->route('doctor.index')->with('success', 'Doctor created successfully.');
    }


    // show
    public function show($id){
        $doctor = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctor.show', compact('doctor'));
    }

    // edit
    public function edit ($id){
        $doctor = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctor.edit', compact('doctor'));
    }

    // update
    public function update (Request $request, $id){
        $request->validate([
            'doctor_name' => 'required',
            'doctor_spesialist'=> 'required',
            'doctor_phone'=> 'required',
            'doctor_email'=> 'required|email',
            'sip'=> 'required',
        ]);


        DB::table('doctors')->where('id', $id)->update([
            'doctor_name' => $request->doctor_name,
            'doctor_spesialist'=> $request->doctor_spesialist,
            'doctor_phone'=> $request->doctor_phone,
            'doctor_email'=> $request->doctor_email,
            'sip'=> $request->sip,
        ]);

        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully.');
    }


    // destroy
    public function destroy($id){
        DB::table('doctors')->where('id', $id)->delete();
        return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfuly.');
    }





}
