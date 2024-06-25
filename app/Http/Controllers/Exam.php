<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Upcomingexam;
use Illuminate\Support\Facades\Validator;



class Exam extends Controller
{

        public function index()
        {
            $upcomingexams = upcomingexam::all();
            return view('exam.index3',compact('upcomingexams'));
        }

        public function store(Request $request){
            $rules = [
                'examination_name' => 'required|string',
                'closing_date' => 'required|date',
                'exam_date' => 'required|date',
                'gazzete_notice'=>'required' ,
                'amendment_notice' => 'nullable',
                'apply_link' => 'nullable',
                'quick_link' => 'nullable',


            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if ($request->has('gazzete_notice')) {
                $file = $request->file('gazzete_notice');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path = 'uploads/gazzete/';
                $file->move($path, $filename);
            }

               // Handling amendment_notice file upload
    if ($request->has('amendment_notice')) {
        $amendment_file = $request->file('amendment_notice');
        $amendment_extension = $amendment_file->getClientOriginalExtension();
        $amendment_filename = time() . '_amendment.' . $amendment_extension;
        $amendment_path = 'uploads/amendment/';
        $amendment_file->move($amendment_path, $amendment_filename);
    }







            $exam =  new Upcomingexam();


            $exam->examination_name = $request->examination_name;
            $exam->closing_date = $request->closing_date;
            $exam->exam_date = $request->exam_date;
            $exam->gazzete_notice = $path . $request->file('gazzete_notice')->getClientOriginalName();
            $exam->amendment_notice = $amendment_path . $amendment_filename; // Setting amendment_notice file path


            $exam->apply_link = $request->apply_link;
            $exam->quick_link = $request->quick_link;

            $exam->save();
       }
    }


