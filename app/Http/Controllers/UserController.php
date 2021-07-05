<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Survey;
use App\Evaluation;
use App\Gallery;
use Illuminate\Support\Facades\Mail;
use App\Mail\GenerateCertificate;

class UserController extends Controller
{
    public function index(){
        $events = Event::orderBy('id', 'desc')->where('event_status', 'done')->orwhere('event_status', 'end')->get();

        date_default_timezone_set('Asia/Manila');   
        // date and time now
        $string_dateNow = date('Y-m-d');
        $string_hourNow = date('H:i');
        $dateTodal =  $string_dateNow . ' ' . $string_hourNow;
        // dd(date('Y-m-d').' '.date('H:i:s'));
        Event::where('endtime', '<=', strtotime($dateTodal))->where('event_status', 'done')->update(['event_status' => 'end']);

        $gallery = Gallery::orderBy('id', 'DESC')->get();
        $checkEvent = Event::count();

        return view('userPanel.dashboard', compact(['events', 'gallery']));
    }

    public function evaluate($id){
        $surveys = Survey::where('event_id',$id)->firstOrFail();
        $questions = explode('|',$surveys->survey_questions);

        return view('userPanel.survey', compact(['surveys', 'questions']));
    }

    public function submitFeedback(Request $request){

        $validatedData = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'survey_title' => 'required',
            'comment' => 'required',
            'key1' => 'required',
            'key2' => 'required',
            'key3' => 'required',
            'key4' => 'required',
            'key5' => 'required',
            'key6' => 'required',
        ]);

        $hasCertificate = Evaluation::where('user_id', auth()->user()->id)->where('survey_id', $request->survey_id)->first();
        if($hasCertificate){
            return redirect()->back()->with('success', 'You already evaluated this event'); 
        }

        date_default_timezone_set('Asia/Manila');

        $image = imagecreatefromjpeg('images_folder/certificateformat.jpg');
        $font = realpath('fonts/Rufina-Regular.ttf');
        $color = imagecolorallocate($image, 51, 51, 51);

        // DATE KUNG KELAN NA RECEIVE ANG CERTIFICATE
        $date = date("F j, Y, g:i a"); 
        imagettftext($image, 24, 0, 340, 1000, $color, $font, $date);

        // NAME NG USER
        $name = ucwords($request->firstname .' '. $request->middlename .' '. $request->lastname . '' . (($request->suffix == 'N/A') ? '' :', ' . $request->suffix .'.'));
        // THE IMAGE SIZE
        $width = imagesx($image);
        $height = imagesy($image);

        // NAME SIZE
        $text_size = imagettfbbox(80, 8, $font, $name);
        $text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
        $text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);

        // CENTERING NG NAME
        $centerX = CEIL(($width - $text_width) / 2);
        $centerX = $centerX<0 ? 0 : $centerX;
        $centerY = CEIL(($height - $text_height) / 2);
        $centerY = $centerY<0 ? 0 : $centerY;

        $fileNameToSave = 'images_folder/certificates/'.strtotime(date('Y-m-d H:i')) .'.jpg';

        imagettftext($image, 80, 0, $centerX, $centerY, $color, $font, $name);
        header('Content-Type: image/jpeg');
        imagejpeg($image, $fileNameToSave, 100);
        imagedestroy($image);

        $data = [
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'survey_title' => $request->survey_title,
                'url' => $fileNameToSave,
            ];

        Mail::to($request->email)->send(new GenerateCertificate($data));

        Evaluation::create(
                [
                    'firstname' => $request->firstname,
                    'middlename' => $request->middlename,
                    'lastname' => $request->lastname,
                    'suffix' => $request->suffix,
                    'email' => $request->email,
                    'survey_title' => $request->survey_title,
                    'user_id' => auth()->user()->id,
                    'survey_id' => $request->survey_id,
                    'key1' => $request->key1,
                    'key2' => $request->key2,
                    'key3' => $request->key3,
                    'key4' => $request->key4,
                    'key5' => $request->key5,
                    'key6' => $request->key6,
                    'comment' => $request->comment,
                ]
            );
            return redirect()->route('thankyou');
    }

    public function tankYou(){
        return view('userPanel.thankyou');
    }
}
