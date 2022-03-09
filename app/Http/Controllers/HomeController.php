<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {


                $teacher = teacher::all();
                return view('user.home', compact('teacher'));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }




    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $teacher = teacher::all();
            return view('user.home', compact('teacher'));
        }
    }

    public function appointment(Request $request)
    {
        $data = new appointment;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->date = $request->date;
        $data->phone = $request->number;
        $data->message = $request->message;
        $data->teacher = $request->teacher;
        $data->status = 'In Progresss';
        if (Auth::id()) {
            $data->user_id = Auth::user()->id;
        }
        $data->save();
        return redirect()->back()->with('message', 'Appointment Request Succesful. We will contact with you soon!');
    }


    public function myappointment()
    {
        if (Auth::id()) {
            $userid = Auth::user()->id;
            $appoint = appointment::where('user_id', $userid)->get();
            return view('user.my_appointment', compact('appoint'));
        } else {
            return redirect()->back();
        }
    }

    public function cancel_appoint($id)
    {
        $data = appointment::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function about() {
        return view('user.about');
    }
}
