<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Arr;
use DB;
use PDF;

use App\AddSession;
use App\Term;
use App\SchoolClass; 
use App\Student;

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

use App\Subject;
use App\ResumeDate;
use App\Teacher;
use App\FormTeacher;
use App\Fee;
use App\Block;
use App\SchoolLogo;
use App\PrincipalStamp;

ini_set('max_execution_time', 300);

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        return view('admin');
    }

    public function school_setup()
    {
        $add_sessions = AddSession::get();
        $add_classes = SchoolClass::get();
        $add_subjects = Subject::get();
        $add_terms = Term::get();
        $add_resumes = ResumeDate::get();
        $add_blocks = Block::get();
        $logos = SchoolLogo::get();
        $stamps = PrincipalStamp::get();
        $fees = Fee::get();
        return view('pages.admin.school-setup',['add_sessions' => $add_sessions,'add_classes' => $add_classes,'add_subjects' => $add_subjects,'add_terms' => $add_terms,'add_resumes' => $add_resumes,'add_blocks' => $add_blocks,'logos' => $logos,'stamps' => $stamps,'fees' => $fees]);
    }


    public function add_session(Request $request)
    {
        $this->validate($request, [
            'session_name' => 'required|unique:add_sessions'
        ]);

        AddSession::create([
            'session_name' => strtoupper(request('session_name'))
        ]);

        return redirect()->back()->with('message','Session Created Successfully');

    }

    public function add_class(Request $request)
    {
        $this->validate($request, [
            'class_name' => 'required|unique:school_classes'
        ]);

        SchoolClass::create([
            'class_name' => request('class_name')
        ]);

        return redirect()->back()->with('message','Class Created Successfully');

    }

    public function add_term(Request $request)
    {
        $this->validate($request, [
            'term_name' => 'required|unique:terms'
        ]);

        Term::create([
            'term_name' => str_slug(request('term_name'),'-')
        ]);

        return redirect()->back()->with('message','Term Created Successfully');

    }

    public function add_subject(Request $request)
    {
        $this->validate($request, [
            'subject_name' => 'required'
        ]);

        Subject::create([
            'category' => request('category'),
            'subject_name' => request('subject_name')
        ]);

        return redirect()->back()->with('message','Subject Created Successfully');
    }

    public function add_resumption(Request $request)
    {
        $this->validate($request, [
            'resume' => 'required'
        ]);
        $resumesql = ResumeDate::all();

        if(count($resumesql) > 0){
        ResumeDate::where('resumption_date','<>',NULL)->update([
            'resumption_date' => request('resume')
        ]);
        }else{
        ResumeDate::create([
            'resumption_date' => request('resume')
        ]);
        }
     return redirect()->back()->with('message','Resumption Date Fixed Successfully');

    }

    public function add_fee(Request $request)
    {
        $this->validate($request, [
            'fee' => 'required'
        ]);

        $fees = Fee::all();
        if(count($fees) > 0){
        Fee::where('fee','<>',NULL)->update([
            'fee' => request('fee')
        ]);
        }else{
        Fee::create([
            'fee' => request('fee')
        ]);
        }
    return redirect()->back()->with('message','New School Fee created Successfully');
    }

    public function add_block(Request $request)
    {
        $this->validate($request, [
            'block' => 'required'
        ]);
        $blocks = Block::where('block',$request->block)->count();
        if($blocks > 0){
        return redirect()->back()->withErrors('Block already exists');
        }else{
        Block::create([
            'block' => request('block')
        ]);
        return redirect()->back()->with('message','New Block created Successfully');
        }
    
    }
    //STUDENT AREA

    public function add_students(Request $request)
    {
        $session_datas = AddSession::all();
        $term_datas = Term::all();
        $class_datas = SchoolClass::all();
        $block_datas = Block::all();
        

        return view('pages.admin.add-students',['session_datas' => $session_datas,'term_datas' => $term_datas, 'class_datas' => $class_datas,'block_datas' => $block_datas]);
    }

    public function add_students_reg(Request $request)
    {
        $session_datas = AddSession::all();
        $term_datas = Term::all();
        $class_datas = SchoolClass::all();
        
        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $ids = $student_model::pluck('admission_no')->toArray();
                //View Student FirstTerm
                // $students = $student_model::where(['session' => $session,'block' => $block])->get();
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $ids = $student_model::pluck('admission_no')->toArray();
                //View Student FirstTerm
                // $students = $student_model::where(['session' => $session,'block' => $block])->get();
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                
                $ids = $student_model::pluck('admission_no')->toArray();
                //View Student FirstTerm
                // $students = $student_model::where(['session' => $session,'block' => $block])->get();
                break;
        }
//dd($ids);

        
        

        // Generate a new unique number
        do {
            $reg_no = rand(1000, 9999);
        } while (in_array($reg_no, $ids));
        
        // echo $id . ' is unique';
        

        return view('pages.admin.add-students-reg',['session_datas' => $session_datas,'term_datas' => $term_datas, 'class_datas' => $class_datas,'reg_no' => $reg_no]);
    }

    public function add_students_submit(Request $request)
    {

         $class_name = request('class_name');
         

         if($request->class_name == 'JS1' AND $request->term_name == 'First-term')
         {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss1student_first_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS1' AND $request->term_name == 'Second-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss1student_second_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS1' AND $request->term_name == 'Third-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss1student_third_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS2' AND $request->term_name == 'First-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss2student_first_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS2' AND $request->term_name == 'Second-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss2student_second_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS2' AND $request->term_name == 'Third-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss2student_third_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS3' AND $request->term_name == 'First-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss3student_first_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS3' AND $request->term_name == 'Second-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss3student_second_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'JS3' AND $request->term_name == 'Third-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss3student_third_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS1' AND $request->term_name == 'First-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss1student_first_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS1' AND $request->term_name == 'Second-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss1student_second_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS1' AND $request->term_name == 'Third-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss1student_third_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS2' AND $request->term_name == 'First-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss2student_first_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS2' AND $request->term_name == 'Second-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss2student_second_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS2' AND $request->term_name == 'Third-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tbljss2student_third_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS3' AND $request->term_name == 'First-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss3student_first_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS3' AND $request->term_name == 'Second-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss3student_second_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }elseif ($request->class_name == 'SS3' AND $request->term_name == 'Third-term') {
             $array_validate = array(
                    'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
                    'admission_no' => 'required|unique:tblss3student_third_terms',
                    'surname' => 'required',
                    'firstname' => 'required',
                    'sex' => 'required',
                    'date_of_birth' => 'required',
                    'name_of_parents' => 'required',
                    'address' => 'required',
                    'phone_no' => 'required|string|max:16');
         }

          switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                $this->validate($request, $array_validate); 
                break;
            case 'JS2':
                $model_class = 'jss2';
                $this->validate($request, $array_validate);
                break;
            case 'JS3':
               $model_class = 'jss3';
               $this->validate($request, $array_validate);
                break;
            case 'SS1':
                $model_class = 'ss1';
                $this->validate($request, $array_validate);
                break;
            case 'SS2':
                $model_class = 'ss2';
                $this->validate($request, $array_validate);
                break;
            case 'SS3':
                $model_class = 'ss3';
                $this->validate($request, $array_validate);
                break; 
        }

                
       
        $image1 = Input::file('passport');
        if($image1 != NULL){
           $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
            $path = public_path('uploads/students_passport/'. $featured);
            Image::make($image1->getRealPath())->resize(1200, 800)->save($path);
        }else{
            $featured = NULL;
        }
        


        $student_array = array('passport' => $featured,
                    'admission_no' => request('admission_no'),
                    'surname' => request('surname'),
                    'firstname' => request('firstname'),
                    'othername' => request('othername'),
                    'sex' => request('sex'),
                    'date_of_birth' => request('date_of_birth'),
                    'name_of_parents' => request('name_of_parents'),
                    'address' => request('address'),
                    'phone_no' => request('phone_no'),
                    'state' => request('state'),
                    'class' => request('class_name'),
                    'block' => request('block'),
                    'session' => request('session_name'));

        $subjects = Subject::where('category', $class_name)->pluck('subject_name')->toArray();
        //dd(json_encode(array($subjects,[0,0,0,0,'FAIL'])));
        //dd($subjects);

        

        for ($i=0; $i < count($subjects) ; $i++) {
            //$subject = $subjects[$i];
            $first_test = 0;
            $second_test = 0;
            $exam = 0;
            $total  = 0;

            if($total >=85){
                $grade = "DISTINCTION";
            }elseif ($total >=75 && $total < 85) {
                $grade = "EXCELLENT";
            }elseif ($total >= 60 && $total < 75) {
                $grade = "GOOD";
            }elseif($total >= 50 && $total < 60){
                $grade ="CREDIT";
            }elseif ($total >= 40 && $total < 50) {
                $grade = "PASS";
            }elseif ($total >= 0 && $total < 40) {
                $grade = "FAIL";
            }

       
        $totals [] = $total;
        $grades [] = $grade;   

        $scores[$i] = $first_test.','.$second_test.','.$exam.','.$total.','.$grade; 

        $datajs [] = array($subjects[$i] => $scores[$i]);

        $grandtotal_explosion[]= explode(',',$scores[$i]);

        $grandtotals[] = $grandtotal_explosion[$i][3];

        }

        //dd($datajs);


        $student_mark_array = array(
                'admission_no' => $request->admission_no,
                'surname' => $request->surname,
                'firstname' => $request->firstname,
                'othername' => $request->othername,
                'session' => $request->session_name,
                'block' => $request->block,
                'marks' => serialize($datajs)
            );

        $student_position_array = array(
                'admission_no' => $request->admission_no,
                'session' => $request->session_name,
                'block' => $request->block,
                'grandtotal' => array_sum($grandtotals)
        );
            

        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $mark_model = "App\\Tbl".$model_class."mark".$model_term;
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";


                //Register Student FirstTerm
                $student_model::create($student_array);
                $student_modelSecondTerm::create($student_array);
                $student_modelThirdTerm::create($student_array);

                //Add Marks
                $mark_model::create($student_mark_array);
                $mark_modelSecondTerm::create($student_mark_array);
                $mark_modelThirdTerm::create($student_mark_array);

                //Add Position
                $position_model::create($student_position_array);
                $position_modelSecondTerm::create($student_position_array);
                $position_modelThirdTerm::create($student_position_array);


                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $mark_model = "App\\Tbl".$model_class."mark".$model_term;
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                //Register Student SecondTerm
                $student_model::create($student_array);
                $student_modelThirdTerm::create($student_array);

                //Add Marks
                $mark_model::create($student_mark_array);
                $mark_modelThirdTerm::create($student_mark_array);

                //Add Position
                $position_model::create($student_position_array);
                $position_modelThirdTerm::create($student_position_array);
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;

                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Register Student ThirdTerm
                $student_model::create($student_array);  

                //Add Marks
                $mark_model::create($student_mark_array);  

                //Add Position
                $position_model::create($student_position_array);     
                break;
        }

        return redirect()->back()->with('message','Student Created Successfully');
        
        
    }

    public function view_students()
    {
        $session_datas = AddSession::orderby('id','DESC')->get();
        $term_datas = Term::all();
        $class_datas = SchoolClass::all();
        $block_datas = Block::all();

        return view('pages.admin.view-students',['session_datas' => $session_datas,'term_datas' => $term_datas, 'class_datas' => $class_datas,'block_datas' => $block_datas]);
       
    }

    public function view_students_sorted(Request $request)
    {
        $class = request('class_name');
        $term = request('term_name');
        $block = request('block');
        $session =  request('session_name');

        $sessions = AddSession::all();

        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;

                //View Student FirstTerm
                $students = $student_model::where(['session' => $session,'block' => $block])->get();
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;

                //View Student FirstTerm
                $students = $student_model::where(['session' => $session,'block' => $block])->get();
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;

                //View Student FirstTerm
                $students = $student_model::where(['session' => $session,'block' => $block])->get();
                break;
            }

        //dd($students);
        return view('pages.admin.view-students-sorted',['students' => $students,'sessions' => $sessions]);
        
    }

    public function marks(Request $request,$id,$class_name)
    {
        
      
       //dd($class_name);
       $logos = SchoolLogo::get();
       

       $subjects = Subject::where('category',$request->class_name)->get();
       $session_name = request('session_name');
       $term = request('term_name');
    if($request->class == 'JS1'){
        $student = Tbljss1student::findOrFail($id);
       $check_marks = Tbljss1mark::where(['admission_no' => $student->admission_no,'session'=>$session_name,'term' => $term])->get();
    }elseif($request->class == 'JS2'){
        $student = Tbljss2student::findOrFail($id);
       $check_marks = Tbljss2mark::where(['admission_no' => $student->admission_no,'session'=>$session_name,'term' => $term])->get();
    }elseif($request->class == 'JS3'){
        $student = Tbljss3student::findOrFail($id);
       $check_marks = Tbljss3mark::where(['admission_no' => $student->admission_no,'session'=>$session_name,'term' => $term])->get();
    }elseif($request->class == 'SS1'){
        $student = Tblss1student::findOrFail($id);
       $check_marks = Tblss1mark::where(['admission_no' => $student->admission_no,'session'=>$session_name,'term' => $term])->get();
    }elseif($request->class == 'SS2'){
        $student = Tblss2student::findOrFail($id);
       $check_marks = Tblss2mark::where(['admission_no' => $student->admission_no,'session'=>$session_name,'term' => $term])->get();
    }elseif($request->class == 'SS3'){
        $student = Tblss3student::findOrFail($id);
       $check_marks = Tblss3mark::where(['admission_no' => $student->admission_no,'session'=>$session_name,'term' => $term])->get();
    }           


        return view('pages.admin.marks',['student' => $student,'subjects' => $subjects,'check_marks' => $check_marks,'logos' => $logos]);
    }

    public function add_marks(Request $request,$id)
    {

        switch ($request->class) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }


        $datas = array(
            'subject_name' => request('subject_name'),
            'first_test' => request('first_test'),
            'second_test' => request('second_test'),
            'exam' => request('exam')
        );

        $counted = count($datas['subject_name'] );
        $totals = array();
        $grades = array();
        $subjects = array();
        $first_tests = array();
        $second_tests = array();
        $exams = array();

        for ($i=0; $i < $counted ; $i++) { 
            $subject = $datas['subject_name'][$i];
            $first_test = $datas['first_test'][$i];
            $second_test = $datas['second_test'][$i];
            $exam = $datas['exam'][$i];

            $total  = $datas['first_test'][$i] + $datas['second_test'][$i] + $datas['exam'][$i];

            if($total >=85){
                $grade = "DISTINCTION";
            }elseif ($total >=75 && $total < 85) {
                $grade = "EXCELLENT";
            }elseif ($total >= 60 && $total < 75) {
                $grade = "GOOD";
            }elseif($total >= 50 && $total < 60){
                $grade ="CREDIT";
            }elseif ($total >= 40 && $total < 50) {
                $grade = "PASS";
            }elseif ($total >= 0 && $total < 40) {
                $grade = "FAIL";
            }

        $subjects [] = $subject;
        $first_tests [] = $first_test;
        $second_tests [] = $second_test;
        $exams [] = $exam;
        $totals [] = $total;
        $grades [] = $grade;   

        $scores[$i] = $datas['first_test'][$i].','.$datas['second_test'][$i].','.$datas['exam'][$i].','.$total.','.$grade; 

        $datajs [] = array($datas['subject_name'][$i] => $scores[$i]);

        $grandtotal_explosion[]= explode(',',$scores[$i]);

        $grandtotals[] = $grandtotal_explosion[$i][3];
        }



        
//dd($grandtotals);
        //dd(array_sum($grandtotals));
//dd($request->session);
        switch ($request->term) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);
                $marks = $mark_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['marks' => serialize($datajs)]);

                $positions = $position_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['grandtotal' => array_sum($grandtotals)]);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);
                $marks = $mark_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['marks' => serialize($datajs)]);

                $positions = $position_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['grandtotal' => array_sum($grandtotals)]);

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);
                $marks = $mark_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['marks' => serialize($datajs)]);

                $positions = $position_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['grandtotal' => array_sum($grandtotals)]);
                break;
            }

        return redirect()->back()->with('message','Marks Updated Successfully');
    }

    public function show_edit_marks(Request $request,$id,$class_name)
    {

        
      
        $class_name = request('class_name');
        $block = request('block');

        $term = request('term_name');
        $logos = SchoolLogo::get();

        // $user_subject_taught = Auth::user()->subjects_taught;
        // dd($user_subject_taught);

        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }



        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();
//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id); 
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id); 
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                break;
            }

        //dd($marks);
        return view('pages.admin.edit-marks',['marks' => $marks,'student' => $student, 'logos' => $logos]);
    }

    public function view_update_student(Request $request,$id,$class_name)
    {
        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

               
                $student = $student_model::findOrFail($id);
//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                 $student = $student_model::findOrFail($id);

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);

                break;
            }


        return view('pages.admin.edit-students',['student' => $student]);

    }

    public function update_student(Request $request, $id,$class_name)
    {
        $class_name = request('class_name');

         $array_validate = array(
            'passport' => 'image|mimes:jpg,jpeg,png|max:3048',
            'surname' => 'required',
            'firstname' => 'required',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'name_of_parents' => 'required',
            'address' => 'required',
            'block' => 'required',
            'phone_no' => 'required|string|max:16');


          switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                $this->validate($request, $array_validate); 
                break;
            case 'JS2':
                $model_class = 'jss2';
                $this->validate($request, $array_validate);
                break;
            case 'JS3':
               $model_class = 'jss3';
               $this->validate($request, $array_validate);
                break;
            case 'SS1':
                $model_class = 'ss1';
                $this->validate($request, $array_validate);
                break;
            case 'SS2':
                $model_class = 'ss2';
                $this->validate($request, $array_validate);
                break;
            case 'SS3':
                $model_class = 'ss3';
                $this->validate($request, $array_validate);
                break; 
        }


        

        $student_array2 = array(
                    'surname' => request('surname'),
                    'firstname' => request('firstname'),
                    'othername' => request('othername'),
                    'sex' => request('sex'),
                    'date_of_birth' => request('date_of_birth'),
                    'name_of_parents' => request('name_of_parents'),
                    'address' => request('address'),
                    'phone_no' => request('phone_no'),
                    'state' => request('state'),
                    'block' => request('block'));

            $image1 = Input::file('passport');
            $image_case = empty($image1);

            //dd($image);




        switch ($request->term) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $mark_model = "App\\Tbl".$model_class."mark".$model_term;
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $student = $student_model::findOrFail($id);
                $studentsecondterm  =$student_modelSecondTerm::findOrFail($id);
                $studentthirdterm = $student_modelThirdTerm::findOrFail($id);


                 if($image_case == false){
                    
                    $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
                    $path = public_path('uploads/students_passport/'. $featured);
                    Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

                    $student_array = array('passport' => $featured,
                    'surname' => request('surname'),
                    'firstname' => request('firstname'),
                    'othername' => request('othername'),
                    'sex' => request('sex'),
                    'date_of_birth' => request('date_of_birth'),
                    'name_of_parents' => request('name_of_parents'),
                    'address' => request('address'),
                    'phone_no' => request('phone_no'),
                    'block' => request('block'),
                    'state' => request('state'));

                    @unlink('uploads/students_passport/'. $student->passport);
                    
                    $student_model::where('id',$id)->update($student_array);
                    $student_modelSecondTerm::where('id',$id)->update($student_array);
                    $student_modelThirdTerm::where('id',$id)->update($student_array);
                }else{
                    
                    $student_model::where('id',$id)->update($student_array2);
                    $student_modelSecondTerm::where('id',$id)->update($student_array2);
                    $student_modelThirdTerm::where('id',$id)->update($student_array2);

                    // $student->update($student_array2);
                    // $studentsecondterm->update($student_array2);
                    // $studentthirdterm->update($student_array2);
                }


                $mark_model::where('admission_no',$student->admission_no)->update([
                    'surname' => request('surname'), 'firstname' => request('firstname'), 'othername' => request('othername'),'block' => request('block') 
                ]);

                $mark_modelSecondTerm::where('admission_no',$student->admission_no)->update([
                    'surname' => request('surname'), 'firstname' => request('firstname'), 'othername' => request('othername'),'block' => request('block') 
                ]);

                $mark_modelThirdTerm::where('admission_no',$student->admission_no)->update([
                    'surname' => request('surname'), 'firstname' => request('firstname'), 'othername' => request('othername'),'block' => request('block') 
                ]);
                
                //POSITION
                $position_model::where('admission_no',$student->admission_no)->update([
                    'block' => request('block') 
                ]);

                $position_modelSecondTerm::where('admission_no',$student->admission_no)->update([
                    'block' => request('block') 
                ]);

                $position_modelThirdTerm::where('admission_no',$student->admission_no)->update([
                    'block' => request('block') 
                ]);
                
                

        
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $mark_model = "App\\Tbl".$model_class."mark".$model_term;
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $student = $student_model::findOrFail($id);
                $studentthirdterm = $student_modelThirdTerm::findOrFail($id);

                if(!empty($image1)){
                    $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
                    $path = public_path('uploads/students_passport/'. $featured);
                    Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

                    $student_array = array('passport' => $featured,
                    'admission_no' => request('admission_no'),
                    'surname' => request('surname'),
                    'firstname' => request('firstname'),
                    'othername' => request('othername'),
                    'sex' => request('sex'),
                    'date_of_birth' => request('date_of_birth'),
                    'name_of_parents' => request('name_of_parents'),
                    'address' => request('address'),
                    'phone_no' => request('phone_no'),
                    'block' => request('block'),
                    'state' => request('state'));

                    @unlink('uploads/students_passport/'. $student->passport);

                    // $student->update($student_array);
                    // $student_modelThirdTerm->update($student_array);
                    
                    $student_model::where('id',$id)->update($student_array);
                   
                    $student_modelThirdTerm::where('id',$id)->update($student_array);
                }else{
                    $student_model::where('id',$id)->update($student_array2);
                    
                    $student_modelThirdTerm::where('id',$id)->update($student_array2);

                    // $student->update($student_array2);
                    // $student_modelThirdTerm->update($student_array2);
                }


                $mark_model::where('admission_no',$student->admission_no)->update([
                    'surname' => request('surname'), 'firstname' => request('firstname'), 'othername' => request('othername'),'block' => request('block') 
                ]);


                $mark_modelThirdTerm::where('admission_no',$student->admission_no)->update([
                    'surname' => request('surname'), 'firstname' => request('firstname'), 'othername' => request('othername'),'block' => request('block') 
                ]);
                
                 //POSITION
                $position_model::where('admission_no',$student->admission_no)->update([
                    'block' => request('block') 
                ]);



                $position_modelThirdTerm::where('admission_no',$student->admission_no)->update([
                    'block' => request('block') 
                ]);
                
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;

                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $student = $student_model::findOrFail($id);

                if(!empty($image1)){
                    $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
                    $path = public_path('uploads/students_passport/'. $featured);
                    Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

                    $student_array = array('passport' => $featured,
                    'admission_no' => request('admission_no'),
                    'surname' => request('surname'),
                    'firstname' => request('firstname'),
                    'othername' => request('othername'),
                    'sex' => request('sex'),
                    'date_of_birth' => request('date_of_birth'),
                    'name_of_parents' => request('name_of_parents'),
                    'address' => request('address'),
                    'phone_no' => request('phone_no'),
                    'block' => request('block'),
                    'state' => request('state'));

                    @unlink('uploads/students_passport/'. $student->passport);

                    //$student->update($student_array);
                    $student_model::where('id',$id)->update($student_array);
                   
                }else{
                    $student_model::where('id',$id)->update($student_array2);
                
                    //$student->update($student_array2);
                }


                $mark_model::where('admission_no',$student->admission_no)->update([
                    'surname' => request('surname'), 'firstname' => request('firstname'), 'othername' => request('othername'),'block' => request('block')  
                ]);
                
                 //POSITION
                $position_model::where('admission_no',$student->admission_no)->update([
                    'block' => request('block') 
                ]);

                
   
                break;
        }

        
        return back()->with('message','Student updated successfully');
    }

    public function update_marks(Request $request,$id)
    {
        switch ($request->class) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }


        $datas = array(
            'subject_name' => request('subject_name'),
            'first_test' => request('first_test'),
            'second_test' => request('second_test'),
            'exam' => request('exam')
        );

        $counted = count($datas['subject_name'] );
        $totals = array();
        $grades = array();
        $subjects = array();
        $first_tests = array();
        $second_tests = array();
        $exams = array();

        for ($i=0; $i < $counted ; $i++) { 
            $subject = $datas['subject_name'][$i];
            $first_test = $datas['first_test'][$i];
            $second_test = $datas['second_test'][$i];
            $exam = $datas['exam'][$i];

            $total  = $datas['first_test'][$i] + $datas['second_test'][$i] + $datas['exam'][$i];

            if($total >=85){
                $grade = "DISTINCTION";
            }elseif ($total >=75 && $total < 85) {
                $grade = "EXCELLENT";
            }elseif ($total >= 60 && $total < 75) {
                $grade = "GOOD";
            }elseif($total >= 50 && $total < 60){
                $grade ="CREDIT";
            }elseif ($total >= 40 && $total < 50) {
                $grade = "PASS";
            }elseif ($total >= 0 && $total < 40) {
                $grade = "FAIL";
            }

        $subjects [] = $subject;
        $first_tests [] = $first_test;
        $second_tests [] = $second_test;
        $exams [] = $exam;
        $totals [] = $total;
        $grades [] = $grade;   

        $scores[$i] = $datas['first_test'][$i].','.$datas['second_test'][$i].','.$datas['exam'][$i].','.$total.','.$grade; 

        $datajs [] = array($datas['subject_name'][$i] => $scores[$i]);

        $grandtotal_explosion[]= explode(',',$scores[$i]);

        $grandtotals[] = $grandtotal_explosion[$i][3];
        }



        
//dd($grandtotals);
        //dd(array_sum($grandtotals));
//dd($request->session);
        switch ($request->term) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);
                $marks = $mark_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['marks' => serialize($datajs)]);

                $positions = $position_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['grandtotal' => array_sum($grandtotals)]);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);
                $marks = $mark_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['marks' => serialize($datajs)]);

                $positions = $position_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['grandtotal' => array_sum($grandtotals)]);

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $student = $student_model::findOrFail($id);
                $marks = $mark_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['marks' => serialize($datajs)]);

                $positions = $position_model::where(['admission_no' => $student->admission_no,'session'=>$request->session,'block' => $request->block])->update(['grandtotal' => array_sum($grandtotals)]);
                break;
            }

        return redirect()->back()->with('message','Marks Updated Successfully');


    }

    public function view_report(Request $request,$id,$class_name)
    {
        
        $class_name = request('class_name');
        $block = request('block');

        $subjects = Subject::where('category',$class_name)->get();

        
        $resumes = ResumeDate::all();
        $fees = Fee::all();
        $logos = SchoolLogo::get();
        $stamps = PrincipalStamp::first();


        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }



        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                $students = $student_model::where(['session' => $request->session_name,'block' => $block])->get();
  
        
                $positions = $position_model::where(['admission_no' => $student->admission_no,'session' => request('session_name'),'block' => $block])->orderby('grandtotal','desc')->get();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                $students = $student_model::where(['session' => $request->session_name,'block' => $block])->get();
  
        
                $positions = $position_model::where(['admission_no' => $student->admission_no,'session' => request('session_name'),'block' => $block])->orderby('grandtotal','desc')->get();

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                $students = $student_model::where(['session' => $request->session_name,'block' => $block])->get();
  
        
                $positions = $position_model::where(['admission_no' => $student->admission_no,'session' => request('session_name'),'block' => $block])->orderby('grandtotal','desc')->get();
                break;
            }


        //dd($marks);
        return view('pages.admin.view-report',['marks' => $marks,'student' => $student,'positions' => $positions,'students' => $students,'resumes' => $resumes,'fees' => $fees,'logos' =>$logos,'stamps'=> $stamps ,'id' => $id,'subjects' => $subjects]);
    }

    public function bulk_view_report(Request $request)
    {
        $class_name = request('class_name');
        $subjects = Subject::where('category',$class_name)->get();
      
        $resumes = ResumeDate::all();
        $fees = Fee::all();
        $logos = SchoolLogo::get();
        $stamps = PrincipalStamp::first();

       switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }



        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

            
                //Add Student Marks
                $student = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get();
                $students = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get(); 

                //dd($student);          
                $positions = DB::table($table_position)->where($table_position.'.session',$request->session_name)->where($table_position.'.block',$request->block)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->join($table_student,$table_position.'.admission_no','=',$table_student.'.admission_no')
                ->where($table_student.'.session',request('session_name'))
                ->where($table_student.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->get()->toArray();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";
                $table_position = "tbl".$model_class."position_second_terms";

                //Add Student Marks
                $student = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get();
                $students = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get(); 

                //dd($student);          
                $positions = DB::table($table_position)->where($table_position.'.session',$request->session_name)->where($table_position.'.block',$request->block)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->join($table_student,$table_position.'.admission_no','=',$table_student.'.admission_no')
                ->where($table_student.'.session',request('session_name'))
                ->where($table_student.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->get()->toArray();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";
                $table_position = "tbl".$model_class."position_third_terms";

                //Add Student Marks
                $student = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get();
                $students = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get(); 

                //dd($student);          
                $positions = DB::table($table_position)->where($table_position.'.session',$request->session_name)->where($table_position.'.block',$request->block)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->join($table_student,$table_position.'.admission_no','=',$table_student.'.admission_no')
                ->where($table_student.'.session',request('session_name'))
                ->where($table_student.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->get()->toArray();

                break;
            }

        //dd($marks);
        return view('pages.admin.bulk-view-report',['student' => $student,'positions' => $positions,'students' => $students,'resumes' => $resumes,'fees' => $fees,'logos' =>$logos,'stamps' =>$stamps,'subjects' => $subjects]);
    }

    public function master_sheet()
    {
        $session_datas = AddSession::all();
        $term_datas = Term::all();
        $class_datas = SchoolClass::all();
        $block_datas = Block::all();

        return view('pages.admin.mastersheet',['session_datas' => $session_datas,'term_datas' => $term_datas, 'class_datas' => $class_datas,'block_datas' => $block_datas]);
    }

    public function view_master_sheet(Request $request)
    {
       
       $class_name = request('class_name');
        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

                $student = $student_model::where(['session' => $request->session_name,'block' => $request->block])->get();
                $subjects = Subject::where('category',$class_name)->get();

                $positions = DB::table($table_position)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->get()->toArray();
//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";
                $table_position = "tbl".$model_class."position_second_terms";

                $student = $student_model::where(['session' => $request->session_name,'block' => $request->block])->get();
                $subjects = Subject::where('category',$class_name)->get();

                $positions = DB::table($table_position)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->get()->toArray();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";
                $table_position = "tbl".$model_class."position_third_terms";

                $student = $student_model::where(['session' => $request->session_name,'block' => $request->block])->get();
                $subjects = Subject::where('category',$class_name)->get();

                $positions = DB::table($table_position)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->get()->toArray();

                break;
            }
        
        //dd($marks);
        return view('pages.admin.view-mastersheet',['positions' => $positions,'student' => $student,'subjects' => $subjects]);
    }
    public function bulkuploadmarks()
    {
        return view('pages.admin.bulkresult');
    }
    public function view_teachers(Request $request)
    {
        
        $teachers = Teacher::all();
        

        return view('pages.admin.view-teachers',['teachers' => $teachers]);
    }

    public function view_to_add()
    {
        $blocks = Block::all();
        $classes = SchoolClass::all();
        return view('pages.admin.add-teachers',['blocks' => $blocks,'classes' => $classes]);

    }

    public function add_teachers(Request $request)
    {
        $this->validate($request,[
            'passport' => 'required|image|mimes:jpg,jpeg,png|max:3048',
            'signature' => 'required|image|mimes:jpg,jpeg,png|max:3048',
            'surname' => 'required',
            'firstname' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'state' => 'required',
            'phone_no' => 'required|string|max:16',
            'portfolio' => 'required'
        ]);

        $image1 = Input::file('passport');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/teachers_passport/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        $image2 = Input::file('signature');
        $featured1 = str_random(30) . '.' . $image2->getClientOriginalExtension();
        $path = public_path('uploads/teachers_signature/'. $featured1);
        Image::make($image2->getRealPath())->resize(100, 50)->save($path);

        Teacher::create([
            'passport' => $featured,
            'signature' => $featured1,
            'surname' => request('surname'),
            'firstname' => request('firstname'),
            'sex' => request('sex'),
            'address' => request('address'),
            'phone_no' => request('phone_no'),
            'state' => request('state'),
            'qualification' => request('qualification'),
            'portfolio' => request('portfolio'),
            'class' => request('class'),
            'block' => request('block'),
            'subjects_taught' => request('subject_taught')
        ]);
        return redirect()->back()->with('message','Teacher Added Successfully');
    }

    public function view_form_teachers(Request $request)
    {
        
        $teachers = FormTeacher::all();

        return view('pages.admin.view-form-teachers',['teachers' => $teachers]);
    }

    public function view_to_add_form_teachers()
    {
        $classes = SchoolClass::all();
        $blocks = Block::all();
        return view('pages.admin.form-teachers',['classes' => $classes,'blocks' => $blocks]);

    }

    public function add_form_teachers(Request $request)
    {
        $this->validate($request,[
            'passport' => 'required|image|mimes:jpg,jpeg,png|max:3048',
            'signature' => 'required|image|mimes:jpg,jpeg,png|max:3048',
            'surname' => 'required',
            'firstname' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'state' => 'required',
            'phone_no' => 'required|string|max:16',
            'class' => 'required|unique:form_teachers',


        ]);

        $image1 = Input::file('passport');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/form_teachers_passport/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        $image2 = Input::file('signature');
        $featured1 = str_random(30) . '.' . $image2->getClientOriginalExtension();
        $path = public_path('uploads/form_teachers_signature/'. $featured1);
        Image::make($image2->getRealPath())->resize(100, 50)->save($path);

        FormTeacher::create([
            'passport' => $featured,
            'signature' => $featured1,
            'surname' => request('surname'),
            'firstname' => request('firstname'),
            'sex' => request('sex'),
            'address' => request('address'),
            'phone_no' => request('phone_no'),
            'state' => request('state'),
            'qualification' => request('qualification'),
            'class' => request('class'),
            'block' => request('block'),
            'subjects_taught' => request('subject_taught')
        ]);
        return redirect()->back()->with('message','Teacher Added Successfully');
    }



    public function add_school_logo(Request $request)
    {
        $this->validate($request,[
            'school_logo' => 'required|image|mimes:jpg,jpeg,png|max:3048',

        ]);

        $image1 = Input::file('school_logo');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/school_logo/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        SchoolLogo::updateOrCreate([
            'logo' => $featured,
        ]);
        return redirect()->back()->with('message','Logo Added Successfully');

    }

    public function add_principal_stamp(Request $request)
    {
        $this->validate($request,[
            'stamp' => 'required|image|mimes:jpg,jpeg,png|max:3048',

        ]);

        $image1 = Input::file('stamp');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/principals_stamp/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        PrincipalStamp::updateOrCreate([
            'stamp_sign' => $featured,
        ]);
        return redirect()->back()->with('message','Stamp Added Successfully');

    }


    
    
    public function promoteMultiple(Request $request){

        $ids = $request->ids;
        $present_class = $request->present_class;
        $present_block = $request->present_block;
        $new_class = $request->new_class;
        $new_block = $request->new_block;
        $new_session = $request->new_session;


        if($present_class == 'JS1'){
                $model_present_class = "jss1";
                $category = request('class_name');

            }elseif ($present_class == 'JS2') {
                $model_present_class = "jss2";
                $category = request('class_name');
            }elseif ($present_class == 'JS3') {
               $model_present_class = "jss3";
              $category = request('class_name');
            }elseif ($present_class == 'SS1') {
                $model_present_class = "ss1";
                $category = request('class_name');
            }elseif ($present_class == 'SS2') {
                $model_present_class = "ss2";
                $category = request('class_name');
            }elseif ($present_class == 'SS3') {
                $model_present_class = "ss3";
                $category = request('class_name');
        }
        if($new_class == 'JS1'){
                $model_new_class = "jss1";
            }elseif ($new_class == 'JS2') {
                $model_new_class = "jss2";
            }elseif ($new_class == 'JS3') {
               $model_new_class = "jss3";
            }elseif ($new_class == 'SS1') {
                $model_new_class = "ss1";
            }elseif ($new_class == 'SS2') {
                $model_new_class = "ss2";
            }elseif ($new_class == 'SS3') {
                $model_new_class = "ss3";
        }

        $subjects = Subject::where('category', $new_class)->pluck('subject_name')->toArray();
        //dd(json_encode(array($subjects,[0,0,0,0,'FAIL'])));
        //dd($subjects);

        

        for ($i=0; $i < count($subjects) ; $i++) {
            //$subject = $subjects[$i];
            $first_test = 0;
            $second_test = 0;
            $exam = 0;
            $total  = 0;

            if($total >=85){
                $grade = "DISTINCTION";
            }elseif ($total >=75 && $total < 85) {
                $grade = "EXCELLENT";
            }elseif ($total >= 60 && $total < 75) {
                $grade = "GOOD";
            }elseif($total >= 50 && $total < 60){
                $grade ="CREDIT";
            }elseif ($total >= 40 && $total < 50) {
                $grade = "PASS";
            }elseif ($total >= 0 && $total < 40) {
                $grade = "FAIL";
            }

       
        $totals [] = $total;
        $grades [] = $grade;   

        $scores[$i] = $first_test.','.$second_test.','.$exam.','.$total.','.$grade; 

        $datajs [] = array($subjects[$i] => $scores[$i]);

        $grandtotal_explosion[]= explode(',',$scores[$i]);

        $grandtotals[] = $grandtotal_explosion[$i][3];

        }

       


        if($request->term == 'Third-term'){
        $table1 = 'App\\Tbl'.$model_present_class.'studentThirdTerm';
        $promotions = $table1::whereIn('id',explode(",",$ids))->get();
        $promotions_others = $table1::whereIn('id',explode(",",$ids))->get();
        $promotions_others_position = $table1::whereIn('id',explode(",",$ids))->get();

        $promotions = $promotions->map(function($item,$key){
            return collect($item)->except(['id'])->toArray();
        });
        // $promotion = Arr::except($promotions,['id']);

        $promotions_others = $promotions_others->map(function($item,$key){
            return collect($item)->except(['id','passport','sex','date_of_birth','name_of_parents','address','state','phone_no','class'])->toArray();
            });

        $promotions_others_position = $promotions_others_position->map(function($item,$key){
            return collect($item)->except(['id','passport','surname','firstname','othername','sex','date_of_birth','name_of_parents','address','state','phone_no','class'])->toArray();
            });

        $promotions_others_position = $promotions_others_position->toArray();

        $promotions_others = $promotions_others->toArray();

        $promotions = $promotions->toArray();
        //dd($promotions);
        $table2first = "App\\Tbl".$model_new_class."studentFirstTerm";
        $table2second = "App\\Tbl".$model_new_class."studentSecondTerm";
        $table2third = "App\\Tbl".$model_new_class."studentThirdTerm";

        $table3markfirst = "App\\Tbl".$model_new_class."markFirstTerm";
        $table3marksecond = "App\\Tbl".$model_new_class."markSecondTerm";
        $table3markthird = "App\\Tbl".$model_new_class."markThirdTerm";

        $table4positionfirst = "App\\Tbl".$model_new_class."positionFirstTerm";
        $table4positionsecond = "App\\Tbl".$model_new_class."positionSecondTerm";
        $table4positionthird = "App\\Tbl".$model_new_class."positionThirdTerm";

        $ids = [];
        foreach ($promotions as $promotion) {
            $ids[] = $table2first::insertGetId($promotion);
            $table2second::insertGetId($promotion);
            $table2third::insertGetId($promotion);

        }

        $ids_mark = [];


        foreach ($promotions_others as $promotion_others) {
            $ids_mark[] = $table3markfirst::insertGetId($promotion_others);
            $table3marksecond::insertGetId($promotion_others);
            $table3markthird::insertGetId($promotion_others);
        }

        $ids_position = [];

        foreach ($promotions_others_position as $promotions_other_position) {
            $ids_position[] = $table4positionfirst::insertGetId($promotions_other_position);
            $table4positionsecond::insertGetId($promotions_other_position);
            $table4positionthird::insertGetId($promotions_other_position);
        }




        //$table2::pluck('admission_no');
        //$subject = Subject::where('category',$category)->pluck('subject_name');
        //$ids = array('228','227');
        $table_wt_new_ids = [];
        foreach ($ids as $id) {
        $table2first::whereIn('id',explode(",",$id))->update(['class' => $new_class, 'session' =>$new_session,'block' => $new_block]);
        $table2second::whereIn('id',explode(",",$id))->update(['class' => $new_class,'session' =>$new_session,'block' => $new_block]);
        $table2third::whereIn('id',explode(",",$id))->update(['class' => $new_class,'session' =>$new_session,'block' => $new_block]);

        $table_wt_new_ids[] = $table2first::whereIn('id',explode(",",$id))->get()->toArray();
        }

        foreach ($ids_mark as $idm) {
            $table3markfirst::whereIn('id',explode(",",$idm))->update(['session' =>$new_session,'block' => $new_block, 'marks' => serialize($datajs)]);
            $table3marksecond::whereIn('id',explode(",",$idm))->update(['session' =>$new_session,'block' => $new_block, 'marks' => serialize($datajs)]);
            $table3markthird::whereIn('id',explode(",",$idm))->update(['session' =>$new_session, 'block' => $new_block,'marks' => serialize($datajs)]);
        }

        foreach ($ids_position as $idp) {
            $table4positionfirst::whereIn('id',explode(",",$idp))->update(['session' =>$new_session,'block' => $new_block,'grandtotal' => array_sum($grandtotals)]);
            $table4positionsecond::whereIn('id',explode(",",$idp))->update(['session' =>$new_session,'block' => $new_block,'grandtotal' => array_sum($grandtotals)]);
            $table4positionthird::whereIn('id',explode(",",$idp))->update(['session' =>$new_session,'block' => $new_block,'grandtotal' => array_sum($grandtotals)]);
        }



        return response()->json(['status'=>true,'message'=>"Students promoted successfully."]);  
    }else{
        return response()->json(['status'=>true,'message'=>"Students cannot be promoted until third term."]); 
    }

    }   

    public function delete_student(Request $request,$id,$class_name)
    {
        switch ($class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $studentSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $studentThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";
                
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;
                $markSecondTerm_model = "App\\Tbl".$model_class."markSecondTerm";
                $markThirdTerm_model = "App\\Tbl".$model_class."markThirdTerm";

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_secondterm_model = "App\\Tbl".$model_class."positionSecondTerm";
                $position_thirdterm_model = "App\\Tbl".$model_class."positionThirdTerm";

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

                $student = $student_model::findOrFail($id);
                $studentSecTerm = $studentSecondTerm::where('admission_no',$student->admission_no);
                $studentThTerm = $studentThirdTerm::where('admission_no',$student->admission_no);

                $positionD = $position_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $positionsecD = $position_secondterm_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $positionthD = $position_thirdterm_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);

                $markD = $mark_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $marksecD = $markSecondTerm_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $markthD = $markThirdTerm_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);

                $markD->delete();
                $marksecD->delete();
                $markthD->delete();

                $positionD->delete();
                $positionsecD->delete();
                $positionthD->delete();

                $studentSecTerm->delete();
                $studentThTerm->delete();
                $student->delete();
//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $studentThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";
                
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;
                $markThirdTerm_model = "App\\Tbl".$model_class."markThirdTerm";

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_thirdterm_model = "App\\Tbl".$model_class."positionThirdTerm";

                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";
                $table_position = "tbl".$model_class."position_second_terms";

                $student = $student_model::findOrFail($id);
                $studentThTerm = $studentThirdTerm::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);

                $positionD = $position_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $positionthD = $position_thirdterm_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);

                $markD = $mark_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $markthD = $markThirdTerm_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);

                $markD->delete();
                $markthD->delete();

                $positionD->delete();
                $positionthD->delete();
                
                $studentThTerm->delete();
                $student->delete();

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";
                $table_position = "tbl".$model_class."position_third_terms";

                $student = $student_model::findOrFail($id); 

                $positionD = $position_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $markD = $mark_model::where(['admission_no' => $student->admission_no,'session' => $student->session,'block' => $student->block]);
                $markD->delete();
                $positionD->delete();
                $student->delete();

                break;
            }



        return back()->with('message','Student deleted successfully');
    }

    public function delete_teacher(Request $request,$id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return back()->with('message','Teacher deleted successfully');
    }

    public function delete_form_teacher(Request $request, $id)
    {
        $teacher = FormTeacher::findOrFail($id);
        $teacher->delete();

        return back()->with('message','Form Teacher deleted successfully');
    }


    public function delete_block(Request $request,$id){

        
        $block=Block::find($id);

        $block->delete();

        return back()->with('message','Block deleted successfully');

    } 

    public function delete_session(Request $request,$id){

        
        $session=AddSession::find($id);

        $session->delete();

        return back()->with('message','Session deleted successfully');

    } 

    public function delete_subjects(Request $request,$id){

        
        $subjects=Subject::find($id);

        $subjects->delete();

        return back()->with('message','Subjects deleted successfully');

    } 


    public function delete_classes(Request $request,$id){

        
        $classes=SchoolClass::find($id);

        $classes->delete();

        return back()->with('message','Class deleted successfully');

    }

    public function delete_term(Request $request,$id){

        
        $term=Term::find($id);

        $term->delete();

        return back()->with('message','Term deleted successfully');

    }

    public function delete_logo(Request $request,$id){

        
        $logo=SchoolLogo::find($id);
        @unlink('uploads/school_logo/'. $logo->logo);

        $logo->delete();

        return back()->with('message','Logo deleted successfully');

    }
    public function delete_stamp(Request $request,$id){

        
        $stamp=PrincipalStamp::find($id);
        @unlink('uploads/principals_stamp/'. $stamp->stamp_sign);

        $stamp->delete();

        return back()->with('message','Stamp deleted successfully');

    }


    public function deleteMultiple(Request $request){

       //  $ids = $request->ids;
       //  $class_name = $request->class_name;
        
       //  if($class_name == 'JS1'){
       //          $model_class = "jss1";
       //      }elseif ($class_name == 'JS2') {
       //          $model_class = "jss2";
       //      }elseif ($class_name == 'JS3') {
       //         $model_class = "jss3";
       //      }elseif ($class_name == 'SS1') {
       //          $model_class = "ss1";
       //      }elseif ($class_name == 'SS2') {
       //          $model_class = "ss2";
       //      }elseif ($class_name == 'SS3') {
       //          $model_class = "ss3";
       //  }

       //  $student_model = "App\\Tbl".$model_class."student";
       //  $marks = "App\\Tbl".$model_class."mark";
       //  $positions = "App\\Tbl".$model_class."position";
       //  $student = $student_model::whereIn('id',explode(",",$ids))->get()->toArray();
         
        
       //  //dd($student);
        
       //          print_r($student);
       //           $positions::whereIn('admission_no',$studen->admission_no)->delete();
       //          $marks::whereIn('admission_no',$studen->admission_no)->delete();
                
        
       // $student::whereIn('id',explode(",",$ids))->delete();


       //  return response()->json(['status'=>true,'message'=>"Students deleted successfully."]);   

    }
   //END OF STUDENTS AREA


public function view_report_pdf(Request $request)
    {
        $id = request('id');
        $class_name = request('class_name');
        $block = request('block');
        $term_name = request('term_name');
        $session_name = request('session_name');
        $term_name = request('term_name');

        $subjects = Subject::where('category',$class_name)->get();
        
                
        $resumes = ResumeDate::all();
        $fees = Fee::all();
        $logos = SchoolLogo::get();
        $stamps = PrincipalStamp::first();


        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }



        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                $students = $student_model::where(['session' => $request->session_name,'block' => $block])->get();
  
        
                $positions = $position_model::where(['admission_no' => $student->admission_no,'session' => request('session_name'),'block' => $block])->orderby('grandtotal','desc')->get();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                $students = $student_model::where(['session' => $request->session_name,'block' => $block])->get();
  
        
                $positions = $position_model::where(['admission_no' => $student->admission_no,'session' => request('session_name'),'block' => $block])->orderby('grandtotal','desc')->get();

                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";

                //Add Student Marks
                $student = $student_model::findOrFail($id);      
                $marks = DB::table($table_student)
                ->join($table_mark, $table_student.'.admission_no','=',$table_mark.'.admission_no')
                ->where($table_student.'.session','=',request('session_name'))
                ->where($table_student.'.block','=',request('block'))
                ->where($table_mark.'.admission_no','=',$student->admission_no)
                ->where($table_mark.'.session','=',request('session_name'))
                ->where($table_mark.'.block','=',request('block'))
               ->get();

                $students = $student_model::where(['session' => $request->session_name,'block' => $block])->get();
  
        
                $positions = $position_model::where(['admission_no' => $student->admission_no,'session' => request('session_name'),'block' => $block])->orderby('grandtotal','desc')->get();
                break;
            }
        //dd($marks);

           view()->share(['marks' => $marks,'student' => $student,'positions' => $positions,'students' => $students,'resumes' => $resumes,'fees' => $fees,'logos' =>$logos,'id' => $id, 'class_name' => $request->class_name,'block' => $request->block,'term_name' => $term_name,'session_name' => $session_name,'stamps' => $stamps,'subjects' => $subjects]);

         $data = array('marks' => $marks,'student' => $student,'positions' => $positions,'students' => $students,'resumes' => $resumes,'fees' => $fees,'logos' =>$logos,'id' => $id, 'class_name' => $request->class_name,'block' => $request->block,'term_name' => $term_name,'session_name' => $session_name,'stamps' => $stamps,'subjects' => $subjects);

         if($request->has('download'))
            {
                //PDF::setOptions(['dpi' => 150]);

                $pdf = PDF::loadView('pages.admin.reportpdf',compact('data'))->setPaper('a4');

                return $pdf->download('report.pdf');
            }


        return view('pages.admin.view-report');
    }


    public function bulk_report_pdf(Request $request)
    {
        //ini_set('max_execution_time', 3000);

        //$id = request('id');
        $class_name = request('class_name');
        $block = request('block');
        $term_name = request('term_name');
        $session_name = request('session_name');
        $term_name = request('term_name');
        
       $class_name = request('class_name');

       $subjects = Subject::where('category',$class_name)->get();
        
        $resumes = ResumeDate::all();
        $fees = Fee::all();
        $logos = SchoolLogo::get();
        $stamps = PrincipalStamp::first();

        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }



        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

            
                //Add Student Marks
                $student = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get();
                $students = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get(); 

                //dd($student);          
                $positions = DB::table($table_position)->where($table_position.'.session',$request->session_name)->where($table_position.'.block',$request->block)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->join($table_student,$table_position.'.admission_no','=',$table_student.'.admission_no')
                ->where($table_student.'.session',request('session_name'))
                ->where($table_student.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->get()->toArray();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";
                $table_position = "tbl".$model_class."position_second_terms";

                //Add Student Marks
                $student = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get();
                $students = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get(); 

                //dd($student);          
                $positions = DB::table($table_position)->where($table_position.'.session',$request->session_name)->where($table_position.'.block',$request->block)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->join($table_student,$table_position.'.admission_no','=',$table_student.'.admission_no')
                ->where($table_student.'.session',request('session_name'))
                ->where($table_student.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->get()->toArray();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;
                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";
                $table_position = "tbl".$model_class."position_third_terms";

                //Add Student Marks
                $student = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get();
                $students = $student_model::where(['session' => $request->session_name, 'block' => $request->block])->get(); 

                //dd($student);          
                $positions = DB::table($table_position)->where($table_position.'.session',$request->session_name)->where($table_position.'.block',$request->block)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->join($table_student,$table_position.'.admission_no','=',$table_student.'.admission_no')
                ->where($table_student.'.session',request('session_name'))
                ->where($table_student.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->where($table_position.'.session',request('session_name'))
                ->get()->toArray();

                break;
            }

        //dd($marks);

           view()->share(['student' => $student,'positions' => $positions,'students' => $students,'resumes' => $resumes,'fees' => $fees,'logos' =>$logos,'class_name' => $request->class_name,'block' => $request->block, 'term_name' => $term_name,'session_name' => $session_name,'stamps' => $stamps,'subjects' => $subjects]);

         $data = array('student' => $student,'positions' => $positions,'students' => $students,'resumes' => $resumes,'fees' => $fees,'logos' =>$logos,'class_name' => $request->class_name, 'block' => $request->block,'term_name' => $term_name,'session_name' => $session_name,'stamps' => $stamps,'subjects' => $subjects);

         if($request->has('download'))
            {
                //PDF::setOptions(['dpi' => 150]);

                $pdf = PDF::loadView('pages.admin.bulk-reportpdf',compact('data'))->setPaper('a4');

                return $pdf->download('bulk_report.pdf');
            }


        return view('pages.admin.view-report');
    }
    //PDF
    public function masterlist_pdf(Request $request)
    {       
       $class_name = request('class_name');
        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

                $student = $student_model::where(['session' => $request->session_name,'block' => $request->block])->get();
                $subjects = Subject::where('category',$class_name)->get();

                $positions = DB::table($table_position)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->get()->toArray();
//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_second_terms";
                $table_mark = "tbl".$model_class."mark_second_terms";
                $table_position = "tbl".$model_class."position_second_terms";

                $student = $student_model::where(['session' => $request->session_name,'block' => $request->block])->get();
                $subjects = Subject::where('category',$class_name)->get();

                $positions = DB::table($table_position)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->get()->toArray();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_third_terms";
                $table_mark = "tbl".$model_class."mark_third_terms";
                $table_position = "tbl".$model_class."position_third_terms";

                $student = $student_model::where(['session' => $request->session_name,'block' => $request->block])->get();
                $subjects = Subject::where('category',$class_name)->get();

                $positions = DB::table($table_position)->orderby($table_position.'.grandtotal','desc')
                ->join($table_mark,$table_position.'.admission_no','=',$table_mark.'.admission_no')->orderby($table_mark.'.id','asc')
                ->where($table_position.'.session',request('session_name'))
                ->where($table_position.'.block',request('block'))
                ->where($table_mark.'.session',request('session_name'))
                ->where($table_mark.'.block',request('block'))
                ->get()->toArray();

                break;
            }
        
        //dd($marks);
        view()->share(['positions' => $positions,'student' => $student,'subjects' => $subjects]);

         $data = array('positions' => $positions,'student' => $student,'subjects' => $subjects);

         if($request->has('download'))
            {
                //PDF::setOptions(['dpi' => 150]);

                $pdf = PDF::loadView('pages.admin.mastersheetpdf',compact('data'))->setPaper('a4')->setOrientation('landscape');

                return $pdf->download('mastersheet.pdf');
            }

            return view('pages.admin.view-mastersheet');
    }
    
    public function student_list(Request $request)
    {
        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

            
                $students = $student_model::where(['session' => $request->session_name,'block' => $request->block])->orderby('surname','asc')->get();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $students = $student_model::where(['session' => $request->session_name,'block' => $request->block])->orderby('surname','asc')->get();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $students = $student_model::where(['session' => $request->session_name,'block' => $request->block])->orderby('surname','asc')->get();

                break;
            }
        return view('pages.admin.student-list',['students' => $students]);
    }

    public function student_list_pdf(Request $request)
    {
        switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

            
                $students = $student_model::where(['session' => $request->session_name,'block' => $request->block])->orderby('surname','asc')->get();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                //Add Student Marks
                $students = $student_model::where(['session' => $request->session_name,'block' => $request->block])->orderby('surname','asc')->get();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $students = $student_model::where(['session' => $request->session_name,'block' => $request->block])->orderby('surname','asc')->get();

                break;
            }

        view()->share(['students' => $students]);

         $data = array('students' => $students);

         if($request->has('download'))
            {
                //PDF::setOptions(['dpi' => 150]);

                $pdf = PDF::loadView('pages.admin.student-list-pdf',compact('data'))->setPaper('a4')->setOrientation('landscape');

                return $pdf->download('student_list.pdf');
            }

            return view('pages.admin.student-list');
    }

    public function student_list_sex(Request $Request)
    {
        $session_datas = AddSession::orderby('id','DESC')->get();
        $term_datas = Term::all();
        $class_datas = SchoolClass::all();
        $block_datas = Block::all();

        return view('pages.admin.view-student-sex',['session_datas' => $session_datas,'term_datas' => $term_datas, 'class_datas' => $class_datas,'block_datas' => $block_datas]);
    }

    public function student_list_by_sex(Request $request)
    {
      switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

                $students = $student_model::where(['session' => $request->session_name,'sex' =>$request->sex,'block' => $request->block])->orderby('surname','asc')->get();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $students = $student_model::where(['session' => $request->session_name,'sex' =>$request->sex,'block' => $request->block])->orderby('surname','asc')->get();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $students = $student_model::where(['session' => $request->session_name,'sex' =>$request->sex,'block' => $request->block])->orderby('surname','asc')->get();

                break;
            }


        return view('pages.admin.student-list-by-sex',['students' => $students]);
  
    }

    public function student_list_by_sex_pdf(Request $request)
    {
      switch ($request->class_name) {
            case 'JS1':
                $model_class = 'jss1';
                break;
            case 'JS2':
                $model_class = 'jss2';
                break;
            case 'JS3':
               $model_class = 'jss3';
                break;
            case 'SS1':
                $model_class = 'ss1';
                break;
            case 'SS2':
                $model_class = 'ss2';
                break;
            case 'SS3':
                $model_class = 'ss3';
                break; 
        }

         switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $table_student = "tbl".$model_class."student_first_terms";
                $table_mark = "tbl".$model_class."mark_first_terms";
                $table_position = "tbl".$model_class."position_first_terms";

                $students = $student_model::where(['session' => $request->session_name,'sex' =>$request->sex,'block' => $request->block])->orderby('surname','asc')->get();

//dd($marks);
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $students = $student_model::where(['session' => $request->session_name,'sex' =>$request->sex,'block' => $request->block])->orderby('surname','asc')->get();


                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $mark_model = "App\\Tbl".$model_class."mark".$model_term;

                $position_model = "App\\Tbl".$model_class."position".$model_term;

                $students = $student_model::where(['session' => $request->session_name,'sex' =>$request->sex,'block' => $request->block])->orderby('surname','asc')->get();

                break;
            }

        view()->share(['students' => $students]);

         $data = array('students' => $students);

         if($request->has('download'))
            {
                //PDF::setOptions(['dpi' => 150]);

                $pdf = PDF::loadView('pages.admin.student-list-by-sex-pdf',compact('data'))->setPaper('a4')->setOrientation('landscape');

                return $pdf->download('student_list_by_sex.pdf');
            }

            return view('pages.admin.student-list-by-sex');
  
    }

}
