<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addview()
    {
        return view("admin.add_teacher");
    }

    public function upload(Request $request)
    {
        $teacher = new teacher;

        $image = $request->file;
        $imagename = time() . '.' . $image->getClientoriginalExtension();
        $request->file->move('teacherimage', $imagename);
        $teacher->image = $imagename;
        $teacher->name = $request->name;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->password = $request->password;

        $teacher->speciality = $request->speciality;


        $teacher->save();
        return redirect()->back()->with('message', 'Teacher Add Successfully!');
    }

    public function showappointment()
    {
        $data = appointment::all();
        return view('admin.showappointment', compact('data'));
    }

    public function approved($id)
    {
        $data = appointment::find($id);
        $data->status = 'approved';
        $data->save();
        return redirect()->back();
    }

    public function cancelled($id)
    {
        $data = appointment::find($id);
        $data->status = 'cancelled';
        $data->save();
        return redirect()->back();
    }

    public function showteacher()
    {
        $data = teacher::all();
        return view('admin.showteacher', compact('data'));
    }

    public function deleteteacher($id)
    {
        $data = teacher::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updateteacher($id)
    {
        $data = teacher::find($id);
        return view('admin.updateteacher', compact('data'));
    }

    public function editteacher(Request $request, $id)
    {
        $teacher = teacher::find($id);
        $teacher->name = $request->name;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;
        $teacher->speciality = $request->speciality;
        $image = $request->file;
        if ($image) {
            $imagename = time() . '.' . $image->getClientoriginalExtension();
            $request->file->move('teacherimage', $imagename);
            $teacher->image = $imagename;
        }

        $teacher->save();
        return redirect()->back()->with('message', 'Teacher Update Successfully!');
    }
}
