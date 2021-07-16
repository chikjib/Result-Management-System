<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB;



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
use Excel;

ini_set('max_execution_time', 300);


class MaatwebsiteController extends Controller
{
    public function importExport()
    {
        return view('importExport');
    }
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel(Request $request,$class_name,$block,$session_name,$type)
    {
        //dd($request);
        $session_name = str_replace("_", "/", $session_name);
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
                $name = $class_name.$block."_".$session_name."_".$model_term."_students";

                //View Student FirstTerm
                $data = $student_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','sex','date_of_birth','name_of_parents', 'address','state', 'phone_no','class','block','session'])->toArray();
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $name = $class_name.$block."_".$session_name."_".$model_term."_students";

                //View Student FirstTerm
                $data = $student_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','sex','date_of_birth','name_of_parents', 'address','state', 'phone_no','class','block','session'])->toArray();
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;

                $name = $class_name.$block."_".$session_name."_".$model_term."_students";

                //View Student FirstTerm
                $data = $student_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','sex','date_of_birth','name_of_parents', 'address','state', 'phone_no','class','block','session'])->toArray();
                break;

            }

            //dd($data);

            if($data == []){
                $data = collect(['surname','firstname','othername','sex','date_of_birth','name_of_parents', 'address','state', 'phone_no','class','block','session'])->toArray();
            }

    return Excel::create($name, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {

        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path, function($reader) {
        })->get();

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

        $subjects = Subject::where('category', $request->class_name)->pluck('subject_name')->toArray();

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



        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";
 

                $adminNos = $student_model::pluck('admission_no')->toArray();



                foreach ($data as  $value) {
                $reg_no = rand(1000, 9999);
                $adminno[] = $reg_no;
                $names[] = $value->surname." ".$value->firstname;
                // Skip title previously added using in_array
                if (in_array($reg_no, $adminNos))
                    continue;
//dd($value);
            $arr[] = ['admission_no' => $reg_no,'surname' => $value->surname,'firstname' => $value->firstname,'othername' => $value->othername,'sex' => $value->sex,'date_of_birth' => $value->date_of_birth,'name_of_parents' => $value->name_of_parents, 'address' => $value->address,'state' => $value->state, 'phone_no' => $value->phone_no,'class' => $value->class, 'block' => $value->block,'session' => $value->session];

                // Add new title to array
                $adminNos[] = $reg_no;

       //$admission_nos = 
       
            $student_mark_model::where('admission_no',$reg_no)->updateOrCreate(['admission_no' => $reg_no,
                'surname' => $value->surname,
                'firstname' => $value->firstname,
                'othername' => $value->othername,
                'session' => $value->session,
                'block' => $value->block,
                'marks' => serialize($datajs)]);
            $mark_modelSecondTerm::where('admission_no',$reg_no)->updateOrCreate(['admission_no' => $reg_no,
                'surname' => $value->surname,
                'firstname' => $value->firstname,
                'othername' => $value->othername,
                'session' => $value->session,
                'block' => $value->block,
                'marks' => serialize($datajs)]);
            $mark_modelThirdTerm::where('admission_no',$reg_no)->updateOrCreate(['admission_no' => $reg_no,
                'surname' => $value->surname,
                'firstname' => $value->firstname,
                'othername' => $value->othername,
                'session' => $value->session,
                'block' => $value->block,
                'marks' => serialize($datajs)]);    
            
    }
    
//dd($arr);
            if(!empty($arr)){
                for ($i=0; $i <count($arr) ; $i++) { 
                  $student_position_model::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate([
                    'admission_no' => $arr[$i]['admission_no'],
                    'session' => $arr[$i]['session'],
                    'block' => $arr[$i]['block']
                    ]);

                  $position_modelSecondTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate([
                    'admission_no' => $arr[$i]['admission_no'],
                    'session' => $arr[$i]['session'],
                    'block' => $arr[$i]['block']
                    ]);

                  $position_modelThirdTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate([
                    'admission_no' => $arr[$i]['admission_no'],
                    'session' => $arr[$i]['session'],
                    'block' => $arr[$i]['block']
                    ]);

                    $students = $student_model::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                    $students = $student_modelSecondTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                    $students = $student_modelThirdTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                }
               

            }
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                 $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";
 

                $adminNos = $student_model::pluck('admission_no')->toArray();

                foreach ($data as  $value) {
                $reg_no = rand(1000, 9999);
                $adminno[] = $reg_no;
                $names[] = $value->surname." ".$value->firstname;
                // Skip title previously added using in_array
                if (in_array($reg_no, $adminNos))
                    continue;
//dd($value);
            $arr[] = ['admission_no' => $reg_no,'surname' => $value->surname,'firstname' => $value->firstname,'othername' => $value->othername,'sex' => $value->sex,'date_of_birth' => $value->date_of_birth,'name_of_parents' => $value->name_of_parents, 'address' => $value->address,'state' => $value->state, 'phone_no' => $value->phone_no,'class' => $value->class, 'block' => $value->block, 'session' => $value->session];

                // Add new title to array
                $adminNos[] = $reg_no;

       //$admission_nos = 
       
            $student_mark_model::where('admission_no',$reg_no)->updateOrCreate(['admission_no' => $reg_no,
                'surname' => $value->surname,
                'firstname' => $value->firstname,
                'othername' => $value->othername,
                'session' => $value->session,
                'block' => $value->block,
                'marks' => serialize($datajs)
            ]);
            
            $mark_modelThirdTerm::where('admission_no',$reg_no)->updateOrCreate(['admission_no' => $reg_no,
                'surname' => $value->surname,
                'firstname' => $value->firstname,
                'othername' => $value->othername,
                'session' => $value->session,
                'block' => $value->block,
                'marks' => serialize($datajs)
            ]);    
            
    }
    
//dd($arr);
            if(!empty($arr)){
                for ($i=0; $i <count($arr) ; $i++) { 
                  $student_position_model::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate([
                    'admission_no' => $arr[$i]['admission_no'],
                    'session' => $arr[$i]['session'],
                    'block' => $arr[$i]['block']
                    ]);

                  $position_modelThirdTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate([
                    'admission_no' => $arr[$i]['admission_no'],
                    'session' => $arr[$i]['session'],
                    'block' => $arr[$i]['block']
                    ]);

                    $students = $student_model::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                    // $students = $student_modelSecondTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                    $students = $student_modelThirdTerm::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                }
               

            }
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                 $student_model = "App\\Tbl".$model_class."student".$model_term;
                
                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
               

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                
                $adminNos = $student_model::pluck('admission_no')->toArray();

                foreach ($data as  $value) {
                
                $adminno[] = $reg_no;
                $names[] = $value->surname." ".$value->firstname;
                // Skip title previously added using in_array
                if (in_array($reg_no, $adminNos))
                    continue;
//dd($value);
            $arr[] = ['admission_no' => $reg_no,'surname' => $value->surname,'firstname' => $value->firstname,'othername' => $value->othername,'sex' => $value->sex,'date_of_birth' => $value->date_of_birth,'name_of_parents' => $value->name_of_parents, 'address' => $value->address,'state' => $value->state, 'phone_no' => $value->phone_no,'class' => $value->class, 'block' => $value->block,'session' => $value->session];

                // Add new title to array
                $adminNos[] = $reg_no;

       //$admission_nos = 
       
            $student_mark_model::where('admission_no',$reg_no)->updateOrCreate(['admission_no' => $reg_no,
                'surname' => $value->surname,
                'firstname' => $value->firstname,
                'othername' => $value->othername,
                'session' => $value->session,
                'block' => $value->block,
                'marks' => serialize($datajs)
            ]);
            
        }
    
//dd($arr);
            if(!empty($arr)){
                for ($i=0; $i <count($arr) ; $i++) { 
                  $student_position_model::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate([
                    'admission_no' => $arr[$i]['admission_no'],
                    'session' => $arr[$i]['session'],
                    'block' => $arr[$i]['block']
                    ]);

                 
                    $students = $student_model::where('admission_no',$arr[$i]['admission_no'])->updateOrCreate($arr[$i]);
                    
                }
               

            }
                break;

            }
    
        return redirect()->back()->with('message','Records uploaded successfully');

        //dd($result);
        
            
        }
        
 
    }

   