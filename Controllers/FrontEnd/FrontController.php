<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use PDF;
use App\Card;
use App\Subject;
use App\Position;
use App\ResumeDate;
use App\Teacher;
use App\FormTeacher;
use App\UsedCard;
use App\Fee;
use App\SchoolClass;
use App\Term;
use App\AddSession;
use App\SchoolLogo;
use App\PrincipalStamp;
use App\Block;


//JSS1
use App\Tbljss1studentFirstTerm;
use App\Tbljss1markFirstTerm;
use App\Tbljss1positionFirstTerm;

use App\Tbljss1studentSecondTerm;
use App\Tbljss1markSecondTerm;
use App\Tbljss1positionSecondTerm;

use App\Tbljss1studentThirdTerm;
use App\Tbljss1markThirdTerm;
use App\Tbljss1positionThirdTerm;

//JSS2
use App\Tbljss2studentFirstTerm;
use App\Tbljss2markFirstTerm;
use App\Tbljss2positionFirstTerm;

use App\Tbljss2studentSecondTerm;
use App\Tbljss2markSecondTerm;
use App\Tbljss2positionSecondTerm;

use App\Tbljss2studentThirdTerm;
use App\Tbljss2markThirdTerm;
use App\Tbljss2positionThirdTerm;

//JSS3
use App\Tbljss3studentFirstTerm;
use App\Tbljss3markFirstTerm;
use App\Tbljss3positionFirstTerm;

use App\Tbljss3studentSecondTerm;
use App\Tbljss3markSecondTerm;
use App\Tbljss3positionSecondTerm;

use App\Tbljss3studentThirdTerm;
use App\Tbljss3markThirdTerm;
use App\Tbljss3positionThirdTerm;

//SS1
use App\Tblss1studentFirstTerm;
use App\Tblss1markFirstTerm;
use App\Tblss1positionFirstTerm;

use App\Tblss1studentSecondTerm;
use App\Tblss1markSecondTerm;
use App\Tblss1positionSecondTerm;

use App\Tblss1studentThirdTerm;
use App\Tblss1markThirdTerm;
use App\Tblss1positionThirdTerm;

//SS2
use App\Tblss2studentFirstTerm;
use App\Tblss2markFirstTerm;
use App\Tblss2positionFirstTerm;

use App\Tblss2studentSecondTerm;
use App\Tblss2markSecondTerm;
use App\Tblss2positionSecondTerm;

use App\Tblss2studentThirdTerm;
use App\Tblss2markThirdTerm;
use App\Tblss2positionThirdTerm;

//SS3
use App\Tblss3studentFirstTerm;
use App\Tblss3markFirstTerm;
use App\Tblss3positionFirstTerm;

use App\Tblss3studentSecondTerm;
use App\Tblss3markSecondTerm;
use App\Tblss3positionSecondTerm;

use App\Tblss3studentThirdTerm;
use App\Tblss3markThirdTerm;
use App\Tblss3positionThirdTerm;

use App\Post;
use App\Staff;
use App\Gallery;




class FrontController extends Controller
{
    //

    public function index()
    {
    	$classes = SchoolClass::all();
    	$terms = Term::all();
    	$school_sessions = AddSession::orderby('id','DESC')->get();
        $posts =  Post::limit(3)->get();
        $block_datas = Block::all();
        $staffs = Staff::all();
        $galleries = Gallery::take(6)->orderby('created_at','DESC')->get();
        $logos = SchoolLogo::pluck('logo');
        $logo = $logos[0];

    	return view('index',['classes' => $classes, 'block_datas' => $block_datas, 'terms' => $terms, 'school_sessions' => $school_sessions,'posts' => $posts,'staffs' => $staffs,'galleries' => $galleries,'logo' => $logo]);
    }

    public function view_result(Request $request)
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        $school_sessions = AddSession::orderby('id','DESC')->get();
        $logos = SchoolLogo::all();
        $stamps = PrincipalStamp::pluck('stamp_sign');
        $stamp = $stamps[0];
        $block_datas = Block::all();
        $logos = SchoolLogo::pluck('logo');
        $logo = $logos[0];


    	$admin_no = $request->admission_number;
    	$class_n = $request->class_name;

        $class_name = $request->class_name;

        $subjects = Subject::where('category',$class_name)->get();

        $block = $request->block;
    	$term_name = $request->term_name;
    	$session_name = $request->session_name;
    	$serial_no = $request->serial_number;
    	$pin_no = $request->pin_number;

        if($class_n == 'JS1'){
                $model_class = "jss1";
                $category = "Junior";
            }elseif ($class_n == 'JS2') {
                $model_class = "jss2";
                $category = "Junior";
            }elseif ($class_n == 'JS3') {
               $model_class = "jss3";
               $category = "Junior";
            }elseif ($class_n == 'SS1') {
                $model_class = "ss1";
                $category = "Senior";
            }elseif ($class_n == 'SS2') {
                $model_class = "ss2";
                $category = "Senior";
            }elseif ($class_n == 'SS3') {
                $model_class = "ss3";
                $category = "Senior";
        }

        if ($term_name == 'First-term') {
            $term_model = 'FirstTerm';
            $table_term = 'first_terms';
        }elseif ($term_name == 'Second-term') {
            $term_model = 'SecondTerm';
            $table_term = 'second_terms';
        }elseif ($term_name == 'Third-term') {
            $term_model =='ThirdTerm';
            $table_term = 'third_terms';
        }

        //validation
        $tableStudent = "App\\Tbl".$model_class."student".$term_model;
        $tableMarks = "App\\Tbl".$model_class."mark".$term_model;
        $tablePosition = "App\\Tbl".$model_class."position".$term_model;

        $student_check = $tableStudent::where(['admission_no' => $admin_no,'session' => $session_name,'block' => $block])->first();
        $marks_check = $tableMarks::where(['admission_no' => $admin_no,'session' => $session_name,'block' => $block])->first();


        $usedcard_check = UsedCard::where(['admin_no' => $admin_no,'serial_no' => $serial_no,'pin_no' => $pin_no])->first();
        $card_check = Card::where(['serial_no' => $serial_no,'pin_no' => $pin_no])->first();
        $usedcard_exist = UsedCard::where(['serial_no' => $serial_no,'pin_no' => $pin_no])->first();

        $fees = Fee::all();
        //$usedcardempty = UsedCard::first();
        //dd($class_n);
        //dd($usedcard_exist);
        if (!$student_check) {
            $msg = 'Admission number not found!';
            return view('pages.frontend.view_report_card',['msg' => $msg,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'block_datas' => $block_datas,'logo' => $logo]);
        }elseif (!$marks_check) {
            $msg = 'Result not found!';
            return view('pages.frontend.view_report_card',['msg' => $msg,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'block_datas' => $block_datas,'logo' => $logo]);
        }elseif(!$card_check) {
            $msg = 'Wrong card details!';
            return view('pages.frontend.view_report_card',['msg' => $msg,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'block_datas' => $block_datas,'logo' => $logo]);
        }elseif($usedcard_exist && $usedcard_exist->admin_no != $admin_no) {
            $msg = 'Card details has been used by another student!';
            return view('pages.frontend.view_report_card',['msg' => $msg,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'block_datas' => $block_datas,'logo' => $logo]);
        }elseif($usedcard_check && $usedcard_check->used_count == 5){
            $msg = 'Card Usage is exhausted!';
            return view('pages.frontend.view_report_card',['msg' => $msg,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'block_datas' => $block_datas,'logo' => $logo]);
        }elseif (!$usedcard_check) {
        
        $student = $tableStudent::findOrFail($student_check->id);
        
        $students = $tableStudent::where(['session' => $request->session_name, 'block' => $request->block])->get(); 
        $resumes = ResumeDate::all();
        $formteachers = FormTeacher::where(['class' => request('class_name')])->get();        
        //dd($formteachers);
        $studentstable = "tbl".$model_class."student_".$table_term;
        $markstable = "tbl".$model_class."mark_".$table_term;
        $teachers = Teacher::where('portfolio', 'Principal')->get();
        $marks = DB::table($studentstable)
                ->join($markstable,$studentstable.".admission_no",'=',$markstable.".admission_no")
                ->where($markstable.'.session','=',request('session_name'))
                ->where($studentstable.'.session','=',request('session_name'))
                ->where($markstable.'.block','=',request('block'))
                ->where($studentstable.'.block','=',request('block'))
                ->where($markstable.".admission_no",'=',$student->admission_no)->get();

        $positions = $tablePosition::where(['admission_no' => $student->admission_no,'session' => $session_name,'block' => $block])->orderby('grandtotal','desc')->get();

        UsedCard::create(['admin_no' => $admin_no,'serial_no' => $serial_no, 'pin_no' => $pin_no, 'used_count' => 1]);

        $cardtable = Card::where(['serial_no' => $serial_no,'pin_no' => $pin_no])->update(['status' => 'used']);
        
        $card_usage = UsedCard::where(['admin_no' => $admin_no,'serial_no' => $serial_no,'pin_no' => $pin_no])->first();

        // dd($marks);

        return view('pages.frontend.view_report_card',['student_check' => $student_check,'marks_check' => $marks_check,'card_check' => $card_check,'marks' => $marks,'positions' => $positions,'student' => $student,'students' => $students,'resumes' => $resumes,'teachers' => $teachers,'formteachers' => $formteachers, 'card_usage' => $card_usage, 'fees' => $fees,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'logo' => $logo,'block_datas' => $block_datas,'stamp' => $stamp,'subjects' => $subjects]);

        }elseif ($usedcard_check && $usedcard_check->used_count != 5) {
            $student = $tableStudent::findOrFail($student_check->id);
            
            $students = $tableStudent::where(['session' => $request->session_name, 'block' => $request->block])->get();
            $resumes = ResumeDate::all();
            $formteachers = FormTeacher::where(['class' => request('class_name')])->get();        

            $studentstable = "tbl".$model_class."student_".$table_term;
            $markstable = "tbl".$model_class."mark_".$table_term;
            $teachers = Teacher::where('portfolio', 'Principal')->get();
            $marks = DB::table($studentstable)
                    ->join($markstable,$studentstable.".admission_no",'=',$markstable.".admission_no")
                ->where($markstable.'.session','=',request('session_name'))
                ->where($studentstable.'.session','=',request('session_name'))
                ->where($markstable.'.block','=',request('block'))
                ->where($studentstable.'.block','=',request('block'))
                ->where($markstable.".admission_no",'=',$student->admission_no)->get();

            $positions = $tablePosition::where(['admission_no' => $student->admission_no,'session' => $session_name,'block' => $block])->orderby('grandtotal','desc')->get();

            $usedcardexisted = UsedCard::where(['admin_no' => $admin_no,'serial_no' => $serial_no, 'pin_no' => $pin_no])->first();

            $findcard = UsedCard::findOrFail($usedcardexisted->id);
        
            $findcard->used_count = $findcard->used_count+1;
            $findcard->save();

            $cardtable = Card::where(['serial_no' => $serial_no,'pin_no' => $pin_no])->update(['status' => 'used']);

            $card_usage = UsedCard::where(['admin_no' => $admin_no,'serial_no' => $serial_no,'pin_no' => $pin_no])->first();

	    	return view('pages.frontend.view_report_card',['student_check' => $student_check,'marks_check' => $marks_check,'card_check' => $card_check,'marks' => $marks,'positions' => $positions,'student' => $student,'students' => $students,'resumes' => $resumes,'teachers' => $teachers,'formteachers' => $formteachers, 'card_usage' => $card_usage,'fees' => $fees,'classes' => $classes, 'block_datas' => $block_datas, 'terms' => $terms, 'school_sessions' => $school_sessions,'logo' => $logo,'stamp' => $stamp,'subjects' => $subjects]);
    	 
    	}
    }

    public function pdfview(Request $request)
    {
        $classes = SchoolClass::all();
        $terms = Term::all();
        $school_sessions = AddSession::all();
        $logos = SchoolLogo::all();
        $stamps = PrincipalStamp::pluck('stamp_sign');
        $stamp = $stamps[0];
        $block_datas = Block::all();
        $logos = SchoolLogo::pluck('logo');
        $logo = $logos[0];


        $admin_no = request('admission_number');
        $class_n = request('class_name');
        $class_name = request('class_name');
        $block = request('block');
        $term_name = request('term_name');
        $session_name = request('session_name');
        $serial_no = request('serial_number');
        $pin_no = request('pin_number');

        $subjects = Subject::where('category',$class_name)->get();

        //dd(request('admission_number'));

       if($class_n == 'JS1'){
                $model_class = "jss1";
                $category = "Junior";
            }elseif ($class_n == 'JS2') {
                $model_class = "jss2";
                $category = "Junior";
            }elseif ($class_n == 'JS3') {
               $model_class = "jss3";
               $category = "Junior";
            }elseif ($class_n == 'SS1') {
                $model_class = "ss1";
                $category = "Senior";
            }elseif ($class_n == 'SS2') {
                $model_class = "ss2";
                $category = "Senior";
            }elseif ($class_n == 'SS3') {
                $model_class = "ss3";
                $category = "Senior";
        }

        if ($term_name == 'First-term') {
            $term_model = 'FirstTerm';
            $table_term = 'first_terms';
        }elseif ($term_name == 'Second-term') {
            $term_model = 'SecondTerm';
            $table_term = 'second_terms';
        }elseif ($term_name == 'Third-term') {
            $term_model =='ThirdTerm';
            $table_term = 'third_terms';
        }

        //validation
        $tableStudent = "App\\Tbl".$model_class."student".$term_model;
        $tableMarks = "App\\Tbl".$model_class."mark".$term_model;
        $tablePosition = "App\\Tbl".$model_class."position".$term_model;

        $student_check = $tableStudent::where(['admission_no' => $admin_no,'session' => $session_name])->first();
        //dd($admin_no);
        $marks_check = $tableMarks::where(['admission_no' => $admin_no, 'session' => $session_name,'block' => $block])->first();
      
        $fees = Fee::all();
        
            $student = $tableStudent::findOrFail($student_check->id);

            $students = $tableStudent::where(['session' => $request->session_name, 'block' => $request->block])->get();
            $resumes = ResumeDate::all();
            $studentstable = "tbl".$model_class."student_".$table_term;
            $markstable = "tbl".$model_class."mark_".$table_term;
            $formteachers = FormTeacher::where(['class' => request('class_name')])->get();            
            //dd($formteachers);
            $teachers = Teacher::where('portfolio', 'Principal')->get();
            $marks = DB::table($studentstable)
                    ->join($markstable,$studentstable.".admission_no",'=',$markstable.".admission_no")
                ->where($markstable.'.session','=',request('session_name'))
                ->where($studentstable.'.session','=',request('session_name'))
                ->where($markstable.'.block','=',request('block'))
                ->where($studentstable.'.block','=',request('block'))
                ->where($markstable.".admission_no",'=',$student->admission_no)->get();

            $positions = $tablePosition::where(['admission_no' => $student->admission_no,'session' => $session_name,'block' => $block])->orderby('grandtotal','desc')->get();

            
            $card_usage = UsedCard::where(['admin_no' => $admin_no,'serial_no' => $serial_no,'pin_no' => $pin_no])->first();

            view()->share(['student_check' => $student_check,'marks_check' => $marks_check,'marks' => $marks,'positions' => $positions,'student' => $student,'students' => $students,'resumes' => $resumes,'teachers' => $teachers,'formteachers' => $formteachers, 'card_usage' => $card_usage,'fees' => $fees,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'term_name' => $term_name,'session_name' => $session_name,'class_name' => $class_n,'stamps' => $stamps,'block' => $block,'subjects' => $subjects,'logo' => $logo]);

            $data = array('student_check' => $student_check,'marks_check' => $marks_check,'marks' => $marks,'positions' => $positions,'student' => $student,'students' => $students,'resumes' => $resumes,'teachers' => $teachers,'formteachers' => $formteachers, 'card_usage' => $card_usage,'fees' => $fees,'classes' => $classes, 'terms' => $terms, 'school_sessions' => $school_sessions,'logo' => $logo,'term_name' => $term_name,'session_name' => $session_name,'class_name' => $class_n,'stamp' => $stamp,'block' => $block,'subjects' => $subjects);


        
            if(request('download'))
            {
                //PDF::setOptions(['dpi' => 150]);
                //dd($card_usage->used_count);

                
                $pdf = PDF::loadView('pages.frontend.pdfview',compact('data'))->setPaper('a4');

                return $pdf->download('result.pdf');
                
            }
    
            return view('pages.frontend.view_report_card');
        
         
        
    }


}
