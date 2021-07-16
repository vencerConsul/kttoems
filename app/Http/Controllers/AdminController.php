<?php

namespace App\Http\Controllers;

use App\Event;
use App\Gallery;
use App\Survey;
use App\User;
use App\Evaluation;
use Illuminate\Http\Request;
use Redirect,Response;
use Validator;
use URL;

class AdminController extends Controller
{
    public function index(){

        $number_of_events = Event::count();
        $number_of_photo = Gallery::count();
        $evaluate = Evaluation::count();
        return view('adminPanel.dashboard', compact(['number_of_events', 'number_of_photo','evaluate']));
    }

    // Calerndar
    public function calendar(Request $request){
        if($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                    ->whereDate('end',   '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end', 'color']);

            return response()->json($data);
        }
        return view('adminPanel.calendar');
    }
    // generate
    public function generate(){

        return view('adminPanel.generate');
    }
    // gallery
    public function gallery(){
        return view('adminPanel.gallery');
    }

    public function addGallery(Request $request){

        $validator = Validator::make($request->all(), [
            'imageGallery' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return $validator->messages()->all()[0];
        }

        $imageName = uniqid() . '.' . $request->imageGallery->extension();
        $request->imageGallery->move(public_path('images_folder/gallery'), $imageName);

        $upload = Gallery::create([
            'image_name' => $imageName
        ]);
        if($upload){
            return 'Upload successfully';
        }
        
    }
    public function getGallery(){
        $gallery = Gallery::orderBy('id', 'DESC')->get();

        if($gallery->count() > 0){
            foreach($gallery as $img){
                $card = '<div class="image-box">
                            <a href="'.URL::to('/').'/images_folder/gallery/'.$img->image_name.'" target="_blank">
                                <img class="pt-2" src="'.URL::to('/').'/images_folder/gallery/'.$img->image_name.'" alt="image">
                            </a>
                        </div>';

                echo $card;
            }
        }else{
            echo '<div class="image-box">
                    <h1>Empty</h1>
                </div>';
        }
        
    }
    // evaluation
    public function evaluation(){

        $evaluation = Evaluation::all();
        
        return view('adminPanel.evaluation', compact('evaluation'));
    }

    public function survey(){

        $events = Event::all();
        $surveys = Survey::all();
        
        return view('adminPanel.survey', compact(['events']));
    }

    //make survey 
    public function makeSurvey($id){

        $events = Event::find($id);
        return view('adminPanel.makesurvey', compact('events'));
    }

    // submit survey
    public function submitSurvey(Request $request){

        $questions = ''.$request->survey_question1.'|'.$request->survey_question2.'|'.$request->survey_question3.'|'.$request->survey_question4.'|'.$request->survey_question5.'|'.$request->survey_question6.'';

        $validatedData = $request->validate([
            'survey_title' => 'required',
            'survey_question1' => 'required',
            'survey_question2' => 'required',
            'survey_question3' => 'required',
            'survey_question4' => 'required',
            'survey_question5' => 'required',
            'survey_question6' => 'required',
        ]);

        if($validatedData){
            $survey = Survey::create([
                'event_id' => $request->event_id,
                'survey_title' => $request->survey_title,
                'survey_questions' => $questions
            ]);
            Event::where('id', $request->event_id)->update(['event_status' => 'done']);
        }

        if($survey){
            
            return redirect()->route('survey');
        }
    }
    

    // full calendar
    public function ajax(Request $request)
    {
        
    switch ($request->type) {
        
        case 'add':
            // dd($request->all());
            $event = Event::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
                'starttime' => strtotime($request->starttime),
                'endtime' => strtotime($request->endtime),
                'color' => $request->color,
                'description' => $request->description
            ]);

            return response()->json($event);
            break;

        case 'update':
            $event = Event::find($request->id)->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            return response()->json($event);
            break;

        case 'delete':
            $event = Event::find($request->id)->delete();

            return response()->json($event);
            break;
            
        default:
            # code...
            break;
    }
    }
}
