<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upcomingexam;
use App\Models\User;
use App\Mail\UpcomingExamNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class Exam extends Controller
{
    public function showDashboard()
    {
        return view('exam.admin_home');
    }

    public function examDashboard()
    {
        return view('exam.exam_home');
    }

    public function index()
    {
        $upcomingexams = upcomingexam::all();
        return view('exam.index3', compact('upcomingexams'));
    }

    public function store(Request $request)
{
    $rules = [
        'examination_name' => 'required|string|max:255',
        'closing_date' => 'required|date|after_or_equal:today|date_format:Y-m-d',
        'exam_date' => 'required|date|after:closing_date|date_format:Y-m-d',
        'gazzete_notice' => 'required|file',
        'amendment_notice' => 'nullable|file',
        'apply_link' => 'nullable|url',
        'quick_link' => 'nullable|url',
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Handling gazette_notice file upload
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

    // Create the upcoming exam
    $exam = new Upcomingexam();
    $exam->examination_name = $request->examination_name;
    $exam->closing_date = $request->closing_date;
    $exam->exam_date = $request->exam_date;
    $exam->gazzete_notice = $path . $filename;
    $exam->amendment_notice = isset($amendment_filename) ? $amendment_path . $amendment_filename : null;
    $exam->apply_link = $request->apply_link;
    $exam->quick_link = $request->quick_link;
    $exam->save();

    // Get all users
    $users = User::all();

    // Log user count
    Log::info('Total users: ' . $users->count());

    // Send email to all users
    foreach ($users as $user) {
        Log::info('Sending email to: ' . $user->email);
        Mail::to($user->email)->send(new UpcomingExamNotification($exam));
    }
    //return redirect()->route('admin.dashboard')->with('success', 'Upcoming exam posted successfully! Notifications sent and calendar updated.');

    return redirect()->back()->with('success', 'Upcoming exam posted successfully and notifications sent and Updated the Callendar! Post another one!');
}
    // Other methods...


 /*public function getEvent(Request $request)
{
    if ($request->ajax()) {
        $events = Upcomingexam::all();
        $eventsData = [];

        foreach ($events as $event) {
            $eventsData[] = [
                'id' => $event->id,
                'title' => $event->examination_name . ' - (Exam Date)',
                'start' => $event->exam_date,
                'end' => $event->exam_date,
                'color' => 'green', // Color for exam date
                'type' => 'exam' // Custom attribute to distinguish event type
            ];
            $eventsData[] = [
                'id' => $event->id,
                'title' => $event->examination_name . ' - (Closing Date)',
                'start' => $event->closing_date,
                'end' => $event->closing_date,
                'color' => 'red', // Color for closing date
                'type' => 'closing' // Custom attribute to distinguish event type
            ];
        }
        return response()->json($eventsData);
    }

    return view('exam.fullcalendar');
}*/

public function getEvent(Request $request)
    {
        if ($request->ajax()) {
            $events = Upcomingexam::all();
            $eventsData = [];

            foreach ($events as $event) {
                $eventsData[] = [
                    'id' => $event->id,
                    'title' => $event->examination_name . ' - (Exam Date)',
                    'start' => $event->exam_date,
                    'color' => 'green', // Color for exam date
                ];
                $eventsData[] = [
                    'id' => $event->id,
                    'title' => $event->examination_name . ' - (Closing Date)',
                    'start' => $event->closing_date,
                    'color' => 'red', // Color for closing date
                ];
            }
            return response()->json($eventsData);
        }

        return view('exam.fullcalendar');
    }
}
  /*  public function createEvent(Request $request)
    {
        $data = $request->only(['title', 'start', 'end']);
        $data['examination_name'] = $data['title'];
        $data['closing_date'] = $data['end'];
        unset($data['title'], $data['end']);
        $event = Upcomingexam::create($data);
        return response()->json($event);
    }*/



