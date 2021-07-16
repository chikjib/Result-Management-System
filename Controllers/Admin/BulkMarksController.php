<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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


class BulkMarksController extends Controller
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
    public function downloadExcel(Request $request, $class_name,$block,$session_name,$term_name,$type)
    {

        
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

        $mark_arr = [];
        $marks = [];
        $dat = [];

        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $name = $class_name.$block."_".$session_name."_".$term_name."_marks";

                $subjects = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

                $data_student_marks = $student_mark_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','admission_no','session','marks'])->toArray();



                for ($i=0; $i < count($data_student_marks); $i++) {
                    $student_surnames[$i] = $data_student_marks[$i]['surname'];
                    $student_firstnames[$i] = $data_student_marks[$i]['firstname'];
                    $student_othernames[$i] = $data_student_marks[$i]['othername'];
                    $student_admission_no[$i] = $data_student_marks[$i]['admission_no'];
                    $mark_arr[$i] = unserialize($data_student_marks[$i]['marks']);

                    $mmm[] = array_flatten($mark_arr[$i]);

                    

                    for ($j=0; $j < count($subjects) ; $j++) { 
                        //$subject_names[$i][$j] = $mark_arr[$i][$j][0];
                        
                          $sub[$i][$j] = array_keys($mark_arr[$i][$j])[0];

                          
                        $scores[$i][$j] = explode(',',$mmm[$i][$j]);
                        $scored[$i][$j] = $scores[$i][$j][0].','.$scores[$i][$j][1].','.$scores[$i][$j][2];


                        $data_results[$i][$j] = array('surname' => $student_surnames[$i],'firstname' => $student_firstnames[$i],'othername' => $student_othernames[$i], 'admission_no' => $student_admission_no[$i], $sub[$i][$j] => $scored[$i][$j]);

                       // $d[$i] = array_flatten($data_results[$i][$j]);
                    }

                    

                    
                }
//dd($scores);
            
                //$arr_comb = $subject_names+$first_tests+$second_tests+$exams;
                //$data_arrs = array_chunk($data_results, count($subjects));

//dd($data_results);
                foreach ($data_results as $key => $d) {

                    switch (count($subjects)) {
                        case '5':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4]);
                            break;
                        case '6':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5]);
                            break;
                        case '7':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6]);
                            break;
                        case '8':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7]);
                            break;
                        case '9':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8]);
                            break;
                        case '10':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9]);
                            break;
                        case '11':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10]);
                            break;
                        case '12':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11]);
                            break;
                        case '13':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12]);
                            break;
                        case '14':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13]);
                            break;
                        case '15':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14]);
                            break;
                        case '16':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15]);
                            break;
                        case '17':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16]);
                            break;
                        case '18':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17]);
                            break;
                        case '19':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17],$d[18]);
                            break;
                        case '20':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17],$d[18],$d[19]);
                            break;    
                    }

                    
                }
               

 //dd($data);

                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $name = $class_name.$block."_".$session_name."_".$term_name."_marks";

                $subjects = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

                $data_student_marks = $student_mark_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','admission_no','session','marks'])->toArray();

                  for ($i=0; $i < count($data_student_marks); $i++) {
                    $student_surnames[$i] = $data_student_marks[$i]['surname'];
                    $student_firstnames[$i] = $data_student_marks[$i]['firstname'];
                    $student_othernames[$i] = $data_student_marks[$i]['othername'];
                    $student_admission_no[$i] = $data_student_marks[$i]['admission_no'];
                    $mark_arr[$i] = unserialize($data_student_marks[$i]['marks']);

                    $mmm[] = array_flatten($mark_arr[$i]);

                    

                    for ($j=0; $j < count($subjects) ; $j++) { 
                        //$subject_names[$i][$j] = $mark_arr[$i][$j][0];
                        
                          $sub[$i][$j] = array_keys($mark_arr[$i][$j])[0];

                          
                        $scores[$i][$j] = explode(',',$mmm[$i][$j]);
                        $scored[$i][$j] = $scores[$i][$j][0].','.$scores[$i][$j][1].','.$scores[$i][$j][2];


                        $data_results[$i][$j] = array('surname' => $student_surnames[$i],'firstname' => $student_firstnames[$i],'othername' => $student_othernames[$i], 'admission_no' => $student_admission_no[$i], $sub[$i][$j] => $scored[$i][$j]);

                       // $d[$i] = array_flatten($data_results[$i][$j]);
                    }

                    

                    
                }


                foreach ($data_results as $key => $d) {

                    switch (count($subjects)) {
                        case '5':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4]);
                            break;
                        case '6':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5]);
                            break;
                        case '7':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6]);
                            break;
                        case '8':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7]);
                            break;
                        case '9':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8]);
                            break;
                        case '10':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9]);
                            break;
                        case '11':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10]);
                            break;
                        case '12':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11]);
                            break;
                        case '13':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12]);
                            break;
                        case '14':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13]);
                            break;
                        case '15':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14]);
                            break;
                        case '16':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15]);
                            break;
                        case '17':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16]);
                            break;
                        case '18':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17]);
                            break;
                        case '19':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17],$d[18]);
                            break;
                        case '20':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17],$d[18],$d[19]);
                            break;    
                    }

                    
                }
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $name = $class_name.$block."_".$session_name."_".$term_name."_marks";

                $subjects = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

                $data_student_marks = $student_mark_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','admission_no','session','marks'])->toArray();

                  for ($i=0; $i < count($data_student_marks); $i++) {
                    $student_surnames[$i] = $data_student_marks[$i]['surname'];
                    $student_firstnames[$i] = $data_student_marks[$i]['firstname'];
                    $student_othernames[$i] = $data_student_marks[$i]['othername'];
                    $student_admission_no[$i] = $data_student_marks[$i]['admission_no'];
                    $mark_arr[$i] = unserialize($data_student_marks[$i]['marks']);

                    $mmm[] = array_flatten($mark_arr[$i]);

                    

                    for ($j=0; $j < count($subjects) ; $j++) { 
                        //$subject_names[$i][$j] = $mark_arr[$i][$j][0];
                        
                          $sub[$i][$j] = array_keys($mark_arr[$i][$j])[0];

                          
                        $scores[$i][$j] = explode(',',$mmm[$i][$j]);
                        $scored[$i][$j] = $scores[$i][$j][0].','.$scores[$i][$j][1].','.$scores[$i][$j][2];


                        $data_results[$i][$j] = array('surname' => $student_surnames[$i],'firstname' => $student_firstnames[$i],'othername' => $student_othernames[$i], 'admission_no' => $student_admission_no[$i], $sub[$i][$j] => $scored[$i][$j]);

                       // $d[$i] = array_flatten($data_results[$i][$j]);
                    }
                    

                    
                }

                foreach ($data_results as $key => $d) {

                    switch (count($subjects)) {
                        case '5':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4]);
                            break;
                        case '6':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5]);
                            break;
                        case '7':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6]);
                            break;
                        case '8':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7]);
                            break;
                        case '9':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8]);
                            break;
                        case '10':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9]);
                            break;
                        case '11':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10]);
                            break;
                        case '12':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11]);
                            break;
                        case '13':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12]);
                            break;
                        case '14':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13]);
                            break;
                        case '15':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14]);
                            break;
                        case '16':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15]);
                            break;
                        case '17':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16]);
                            break;
                        case '18':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17]);
                            break;
                        case '19':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17],$d[18]);
                            break;
                        case '20':
                            $data[] = array_merge($d[0],$d[1],$d[2],$d[3],$d[4],$d[5],$d[6],$d[7],$d[8],$d[9],$d[10],$d[11],$d[12],$d[13],$d[14],$d[15],$d[16],$d[17],$d[18],$d[19]);
                            break;    
                    }

                    
                }
                break;

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

        
        $class_name = $request->class_name;
        $block = $request->block;
        $session_name = str_replace("_", "/", $request->session_name);
        $term_name = $request->term_name;
 

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

        $mark_arr = [];
        $marks = [];
        $dat = [];

        switch ($request->term_name) {
            case 'First-term':
                $model_term = 'FirstTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $name = $class_name.$session_name."_".$term_name."_marks";

                $subjects = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

                $data_student_marks = $student_mark_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','admission_no','session','marks'])->toArray();

                if(!empty($data) && $data->count()){
            $arr = array();

            

            foreach ($data as $value) {

                // Skip title previously added using in_array
                //dd();
                // if (in_array($value->admission_no, $adminNos))
                //     continue;
//dd($value->student_name);

            $arr[] = ['surname'=> $value->surname,'firstname' => $value->firstname,'othername' => $value->othername, 'admission_no' => $value->admission_no,'session' =>$value->session];

            unset($value['surname'],$value['firstname'],$value['othername'],$value['admission_no']);

            
            $subj_excel[] = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

            $marks_ex[] = array_values($value->toArray());

            // $keys = array_fill_keys($subjects, '');
            // $val[] = $value->toArray();

            //$dm[] =  array_replace_recursive($keys, array_intersect_key($val,$keys));

        }

            for ($i=0; $i < count($data) ; $i++) {
                
                // $subjec = $subjects[$i];
                for ($j=0; $j < count($subjects) ; $j++) { 
                    $marks_excel[$i][$j] = explode(',', $marks_ex[$i][$j]);

                    $total = $marks_excel[$i][$j][0] + $marks_excel[$i][$j][1] + $marks_excel[$i][$j][2];



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

                        $scores[$i][$j] = $marks_excel[$i][$j][0].','.$marks_excel[$i][$j][1].','.$marks_excel[$i][$j][2].','.$total.','.$grade; 

                    $datajs[$i][$j] = array($subj_excel[$i][$j] => $scores[$i][$j]);

                    $tot[$i][$j] = $total;

                    $grandtotals[$i][$j] = $total;

                    $grandtot = array_sum($tot[$i]);

                }

                    $d_res[$i] = $datajs[$i];

                

                $student_mark_model::where(['admission_no' => $arr[$i]['admission_no'],'session' => str_replace("_", "/", request('session_name')),'block' => request('block')])->update(['marks' => serialize($d_res[$i])]);
                    
        
            $student_position_model::where(['admission_no' => $arr[$i]['admission_no'],'session' => str_replace("_", "/", request('session_name')),'block' => request('block')])->update(['grandtotal' => array_sum($grandtotals[$i])]);

                    // $grades[$i][$j] = $grade;

                
                
            }


//dd($grandtotals);
            
}

                
                break;
            case 'Second-term':
                $model_term = 'SecondTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $name = $class_name.$session_name."_".$term_name."_marks";

                $subjects = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

                $data_student_marks = $student_mark_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','admission_no','session','marks'])->toArray();

                if(!empty($data) && $data->count()){
            $arr = array();

            

            foreach ($data as $value) {

                // Skip title previously added using in_array
                //dd();
                // if (in_array($value->admission_no, $adminNos))
                //     continue;
//dd($value->student_name);

            $arr[] = ['surname'=> $value->surname,'firstname' => $value->firstname,'othername' => $value->othername, 'admission_no' => $value->admission_no,'session' =>$value->session];

            unset($value['surname'],$value['firstname'],$value['othername'],$value['admission_no']);

            
            $subj_excel[] = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

            $marks_ex[] = array_values($value->toArray());

            // $keys = array_fill_keys($subjects, '');
            // $val[] = $value->toArray();

            //$dm[] =  array_replace_recursive($keys, array_intersect_key($val,$keys));

        }

            for ($i=0; $i < count($data) ; $i++) {
                
                // $subjec = $subjects[$i];
                for ($j=0; $j < count($subjects) ; $j++) { 
                    $marks_excel[$i][$j] = explode(',', $marks_ex[$i][$j]);

                    $total = $marks_excel[$i][$j][0] + $marks_excel[$i][$j][1] + $marks_excel[$i][$j][2];



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

                        $scores[$i][$j] = $marks_excel[$i][$j][0].','.$marks_excel[$i][$j][1].','.$marks_excel[$i][$j][2].','.$total.','.$grade; 

                    $datajs[$i][$j] = array($subj_excel[$i][$j] => $scores[$i][$j]);

                    $tot[$i][$j] = $total;

                    $grandtotals[$i][$j] = $total;

                    $grandtot = array_sum($tot[$i]);

                }

                    $d_res[$i] = $datajs[$i];

                

                $student_mark_model::where(['admission_no' => $arr[$i]['admission_no'],'session' => str_replace("_", "/", request('session_name')),'block' => request('block')])->update(['marks' => serialize($d_res[$i])]);
                    
        
            $student_position_model::where(['admission_no' => $arr[$i]['admission_no'],'session' => str_replace("_", "/", request('session_name')),'block' => request('block')])->update(['grandtotal' => array_sum($grandtotals[$i])]);

                    // $grades[$i][$j] = $grade;

                
                
            }


//dd($grandtotals);
            
}
                break;
            case 'Third-term':
                $model_term = 'ThirdTerm';
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_model = "App\\Tbl".$model_class."student".$model_term;
                $student_modelSecondTerm = "App\\Tbl".$model_class."studentSecondTerm";
                $student_modelThirdTerm = "App\\Tbl".$model_class."studentThirdTerm";

                $student_mark_model = "App\\Tbl".$model_class."mark".$model_term; 
                $mark_modelSecondTerm = "App\\Tbl".$model_class."markSecondTerm";
                $mark_modelThirdTerm = "App\\Tbl".$model_class."markThirdTerm";

                $student_position_model = "App\\Tbl".$model_class."position".$model_term;
                $position_modelSecondTerm = "App\\Tbl".$model_class."positionSecondTerm";
                $position_modelThirdTerm = "App\\Tbl".$model_class."positionThirdTerm";

                $name = $class_name.$session_name."_".$term_name."_marks";

                $subjects = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

                $data_student_marks = $student_mark_model::where(['session' => $session_name,'block' => $block])->get(['surname','firstname','othername','admission_no','session','marks'])->toArray();

                if(!empty($data) && $data->count()){
            $arr = array();

            

            foreach ($data as $value) {

                // Skip title previously added using in_array
                //dd();
                // if (in_array($value->admission_no, $adminNos))
                //     continue;
//dd($value->student_name);

            $arr[] = ['surname'=> $value->surname,'firstname' => $value->firstname,'othername' => $value->othername, 'admission_no' => $value->admission_no,'session' =>$value->session];

            unset($value['surname'],$value['firstname'],$value['othername'],$value['admission_no']);

            
            $subj_excel[] = Subject::where('category',$class_name)->pluck('subject_name')->toArray();

            $marks_ex[] = array_values($value->toArray());

            // $keys = array_fill_keys($subjects, '');
            // $val[] = $value->toArray();

            //$dm[] =  array_replace_recursive($keys, array_intersect_key($val,$keys));

        }

            for ($i=0; $i < count($data) ; $i++) {
                
                // $subjec = $subjects[$i];
                for ($j=0; $j < count($subjects) ; $j++) { 
                    $marks_excel[$i][$j] = explode(',', $marks_ex[$i][$j]);

                    $total = $marks_excel[$i][$j][0] + $marks_excel[$i][$j][1] + $marks_excel[$i][$j][2];



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

                        $scores[$i][$j] = $marks_excel[$i][$j][0].','.$marks_excel[$i][$j][1].','.$marks_excel[$i][$j][2].','.$total.','.$grade; 

                    $datajs[$i][$j] = array($subj_excel[$i][$j] => $scores[$i][$j]);

                    $tot[$i][$j] = $total;

                    $grandtotals[$i][$j] = $total;

                    $grandtot = array_sum($tot[$i]);

                }

                    $d_res[$i] = $datajs[$i];

                

                $student_mark_model::where(['admission_no' => $arr[$i]['admission_no'],'session' => str_replace("_", "/", request('session_name')),'block' => request('block')])->update(['marks' => serialize($d_res[$i])]);
                    
        
            $student_position_model::where(['admission_no' => $arr[$i]['admission_no'],'session' => str_replace("_", "/", request('session_name')),'block' => request('block')])->update(['grandtotal' => array_sum($grandtotals[$i])]);

                    // $grades[$i][$j] = $grade;

                
                
            }


//dd($grandtotals);
            
}
               break;

            }
        return redirect()->back()->with('message','Records uploaded successfully');

        //dd($result);
        
            
        }
        
 
}
