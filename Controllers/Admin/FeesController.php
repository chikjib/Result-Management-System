<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use PDF;

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

ini_set('max_execution_time', 300);


class FeesController extends Controller
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

    public function index(Request $request)
    {
        //
        $class = request('class_name');
        $term = request('term_name');
        $session = request('session_name');
        $block = request('block');


        if($request->class_name == 'JS1' AND $request->term_name == 'First-term' AND $request->session_name == $session){
            $students = collect(array());
            //dd($students);
        }elseif ($request->class_name == 'JS1' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss1student_first_terms')->orderby('tbljss1student_first_terms.surname','asc')
                        ->join('tbljss1position_first_terms','tbljss1student_first_terms.admission_no','=','tbljss1position_first_terms.admission_no')
                        ->where('tbljss1position_first_terms.session',$session)
                        ->where('tbljss1position_first_terms.block',$block)
                        ->where('tbljss1student_first_terms.session',$session)
                        ->where('tbljss1student_first_terms.block',$block)  
                        ->where('tbljss1position_first_terms.grandtotal','<>',0)
                        ->get()->unique('admission_no');            
        }elseif ($request->class_name == 'JS1' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss1student_second_terms')->orderby('tbljss1student_second_terms.surname','asc')
            ->join('tbljss1position_second_terms','tbljss1student_second_terms.admission_no','=','tbljss1position_second_terms.admission_no')
                        ->where('tbljss1position_second_terms.session',$session)
                        ->where('tbljss1student_second_terms.session',$session) 
                        ->where('tbljss1position_second_terms.block',$block)
                        ->where('tbljss1student_second_terms.block',$block) 
                        ->where('tbljss1position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);
        }elseif ($request->class_name == 'JS2' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss1student_third_terms')->orderby('tbljss1student_third_terms.surname','asc')
            ->join('tbljss1position_third_terms','tbljss1student_third_terms.admission_no','=','tbljss1position_third_terms.admission_no')
                        ->where('tbljss1position_third_terms.session',$session)
                        ->where('tbljss1student_third_terms.session',$session)
                        ->where('tbljss1position_third_terms.block',$block)
                        ->where('tbljss1student_third_terms.block',$block)  
                        ->where('tbljss1position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);
        }elseif ($request->class_name == 'JS2' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss2student_first_terms')->orderby('tbljss2student_first_terms.surname','asc')
           ->join('tbljss2position_first_terms','tbljss2student_first_terms.admission_no','=','tbljss2position_first_terms.admission_no')
                        ->where('tbljss2position_first_terms.session',$session)
                        ->where('tbljss2student_first_terms.session',$session) 
                        ->where('tbljss2position_first_terms.block',$block)
                        ->where('tbljss2student_first_terms.block',$block)
                        ->where('tbljss2position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);
        }elseif ($request->class_name == 'JS2' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss2student_second_terms')->orderby('tbljss2student_second_terms.surname','asc')
            ->join('tbljss2position_second_terms','tbljss2student_second_terms.admission_no','=','tbljss2position_second_terms.admission_no')
                        ->where('tbljss2position_second_terms.session',$session)
                        ->where('tbljss2student_second_terms.session',$session)
                        ->where('tbljss2position_second_terms.block',$block)
                        ->where('tbljss2student_second_terms.block',$block) 
                        ->where('tbljss2position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'JS3' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss2student_third_terms')->orderby('tbljss2student_third_terms.surname','asc')
            ->join('tbljss2position_third_terms','tbljss2student_third_terms.admission_no','=','tbljss2position_third_terms.admission_no')
                        ->where('tbljss2position_third_terms.session',$session)
                        ->where('tbljss2student_third_terms.session',$session)
                        ->where('tbljss2position_third_terms.block',$block)
                        ->where('tbljss2student_third_terms.block',$block)  
                        ->where('tbljss2position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);

        }elseif ($request->class_name == 'JS3' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss3student_first_terms')->orderby('tbljss3student_first_terms.surname','asc')
            ->join('tbljss3position_first_terms','tbljss3student_first_terms.admission_no','=','tbljss3position_first_terms.admission_no')
                        ->where('tbljss3position_first_terms.session',$session)
                        ->where('tbljss3student_first_terms.session',$session)
                        ->where('tbljss3position_first_terms.block',$block)
                        ->where('tbljss3student_first_terms.block',$block) 
                        ->where('tbljss3position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');


        }elseif ($request->class_name == 'SS1' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss3student_second_terms')->orderby('tbljss3student_second_terms.surname','asc')
            ->join('tbljss3position_second_terms','tbljss3student_first_terms.admission_no','=','tbljss3position_second_terms.admission_no')
                        ->where('tbljss3position_second_terms.session',$session)
                        ->where('tbljss3student_second_terms.session',$session) 
                        ->where('tbljss3position_second_terms.block',$block)
                        ->where('tbljss3student_second_terms.block',$block)
                        ->where('tbljss3position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS1' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
           $students = DB::table('tblss1student_first_terms')->orderby('tblss1student_first_terms.surname','asc')
            ->join('tblss1position_first_terms','tblss1student_first_terms.admission_no','=','tblss1position_first_terms.admission_no')
                        ->where('tblss1position_first_terms.session',$session)
                        ->where('tblss1student_first_terms.session',$session)
                        ->where('tblss1position_first_terms.block',$block)
                        ->where('tblss1student_first_terms.block',$block)  
                        ->where('tblss1position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS1' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tblss1student_second_terms')->orderby('tblss1student_second_terms.surname','asc')
            ->join('tblss1position_second_terms','tblss1student_second_terms.admission_no','=','tblss1position_second_terms.admission_no')
                        ->where('tblss1position_second_terms.session',$session)
                        ->where('tblss1student_second_terms.session',$session)
                        ->where('tblss1position_second_terms.block',$block)
                        ->where('tblss1student_second_terms.block',$block) 
                        ->where('tblss1position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS2' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tblss1student_third_terms')->orderby('tblss1student_third_terms.surname','asc')
            ->join('tblss1position_third_terms','tblss1student_third_terms.admission_no','=','tblss1position_third_terms.admission_no')
                        ->where('tblss1position_third_terms.session',$session)
                        ->where('tblss1student_third_terms.session',$session)
                        ->where('tblss1position_third_terms.block',$block)
                        ->where('tblss1student_third_terms.block',$block) 
                        ->where('tblss1position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS2' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
           $students = DB::table('tblss2student_first_terms')->orderby('tblss2student_first_terms.surname','asc')
            ->join('tblss2position_first_terms','tblss2student_first_terms.admission_no','=','tblss2position_first_terms.admission_no')
                        ->where('tblss2position_first_terms.session',$session)
                        ->where('tblss2student_first_terms.session',$session) 
                        ->where('tblss2position_first_terms.block',$block)
                        ->where('tblss2student_first_terms.block',$block) 
                        ->where('tblss2position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS2' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tblss2student_second_terms')->orderby('tblss2student_second_terms.surname','asc')
            ->join('tblss2position_second_terms','tblss2student_second_terms.admission_no','=','tblss2position_second_terms.admission_no')
                        ->where('tblss2position_second_terms.session',$session)
                        ->where('tblss2student_second_terms.session',$session)
                        ->where('tblss2position_second_terms.block',$block)
                        ->where('tblss2student_second_terms.block',$block) 
                        ->where('tblss2position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS3' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tblss2student_third_terms')->orderby('tblss2student_third_terms.surname','asc')
            ->join('tblss2position_third_terms','tblss2student_third_terms.admission_no','=','tblss2position_third_terms.admission_no')
                        ->where('tblss2position_third_terms.session',$session)
                        ->where('tblss2student_third_terms.session',$session)
                        ->where('tblss2position_third_terms.block',$block)
                        ->where('tblss2student_third_terms.block',$block) 
                        ->where('tblss2position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS3' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tblss3student_first_terms')->orderby('tblss3student_first_terms.surname','asc')
            ->join('tblss3position_first_terms','tblss3student_first_terms.admission_no','=','tblss3position_first_terms.admission_no')
                        ->where('tblss3position_first_terms.session',$session)
                        ->where('tblss3student_first_terms.session',$session)
                        ->where('tblss3position_first_terms.block',$block)
                        ->where('tblss3student_first_terms.block',$block) 
                        ->where('tblss3position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }

        return view('pages.admin.school-fees-list',['students' => $students]);
    }


    public function school_fees_list_pdf(Request $request)
    {

        //
        $class = request('class_name');
        $term = request('term_name');
        $session = request('session_name');

        if($request->class_name == 'JS1' AND $request->term_name == 'First-term' AND $request->session_name == $session){
            $students = collect(array());
            //dd($students);
        }elseif ($request->class_name == 'JS1' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss1student_first_terms')->orderby('tbljss1student_first_terms.surname','asc')
                        ->join('tbljss1position_first_terms','tbljss1student_first_terms.admission_no','=','tbljss1position_first_terms.admission_no')
                        ->where('tbljss1position_first_terms.session',$session)
                        ->where('tbljss1position_first_terms.block',$block)
                        ->where('tbljss1student_first_terms.session',$session)
                        ->where('tbljss1student_first_terms.block',$block)  
                        ->where('tbljss1position_first_terms.grandtotal','<>',0)
                        ->get()->unique('admission_no');            
        }elseif ($request->class_name == 'JS1' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss1student_second_terms')->orderby('tbljss1student_second_terms.surname','asc')
            ->join('tbljss1position_second_terms','tbljss1student_second_terms.admission_no','=','tbljss1position_second_terms.admission_no')
                        ->where('tbljss1position_second_terms.session',$session)
                        ->where('tbljss1student_second_terms.session',$session) 
                        ->where('tbljss1position_second_terms.block',$block)
                        ->where('tbljss1student_second_terms.block',$block) 
                        ->where('tbljss1position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);
        }elseif ($request->class_name == 'JS2' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss1student_third_terms')->orderby('tbljss1student_third_terms.surname','asc')
            ->join('tbljss1position_third_terms','tbljss1student_third_terms.admission_no','=','tbljss1position_third_terms.admission_no')
                        ->where('tbljss1position_third_terms.session',$session)
                        ->where('tbljss1student_third_terms.session',$session)
                        ->where('tbljss1position_third_terms.block',$block)
                        ->where('tbljss1student_third_terms.block',$block)  
                        ->where('tbljss1position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);
        }elseif ($request->class_name == 'JS2' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss2student_first_terms')->orderby('tbljss2student_first_terms.surname','asc')
           ->join('tbljss2position_first_terms','tbljss2student_first_terms.admission_no','=','tbljss2position_first_terms.admission_no')
                        ->where('tbljss2position_first_terms.session',$session)
                        ->where('tbljss2student_first_terms.session',$session) 
                        ->where('tbljss2position_first_terms.block',$block)
                        ->where('tbljss2student_first_terms.block',$block)
                        ->where('tbljss2position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);
        }elseif ($request->class_name == 'JS2' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss2student_second_terms')->orderby('tbljss2student_second_terms.surname','asc')
            ->join('tbljss2position_second_terms','tbljss2student_second_terms.admission_no','=','tbljss2position_second_terms.admission_no')
                        ->where('tbljss2position_second_terms.session',$session)
                        ->where('tbljss2student_second_terms.session',$session)
                        ->where('tbljss2position_second_terms.block',$block)
                        ->where('tbljss2student_second_terms.block',$block) 
                        ->where('tbljss2position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'JS3' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss2student_third_terms')->orderby('tbljss2student_third_terms.surname','asc')
            ->join('tbljss2position_third_terms','tbljss2student_third_terms.admission_no','=','tbljss2position_third_terms.admission_no')
                        ->where('tbljss2position_third_terms.session',$session)
                        ->where('tbljss2student_third_terms.session',$session)
                        ->where('tbljss2position_third_terms.block',$block)
                        ->where('tbljss2student_third_terms.block',$block)  
                        ->where('tbljss2position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

            //dd($students);

        }elseif ($request->class_name == 'JS3' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss3student_first_terms')->orderby('tbljss3student_first_terms.surname','asc')
            ->join('tbljss3position_first_terms','tbljss3student_first_terms.admission_no','=','tbljss3position_first_terms.admission_no')
                        ->where('tbljss3position_first_terms.session',$session)
                        ->where('tbljss3student_first_terms.session',$session)
                        ->where('tbljss3position_first_terms.block',$block)
                        ->where('tbljss3student_first_terms.block',$block) 
                        ->where('tbljss3position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');


        }elseif ($request->class_name == 'SS1' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tbljss3student_second_terms')->orderby('tbljss3student_second_terms.surname','asc')
            ->join('tbljss3position_second_terms','tbljss3student_first_terms.admission_no','=','tbljss3position_second_terms.admission_no')
                        ->where('tbljss3position_second_terms.session',$session)
                        ->where('tbljss3student_second_terms.session',$session) 
                        ->where('tbljss3position_second_terms.block',$block)
                        ->where('tbljss3student_second_terms.block',$block)
                        ->where('tbljss3position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS1' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
           $students = DB::table('tblss1student_first_terms')->orderby('tblss1student_first_terms.surname','asc')
            ->join('tblss1position_first_terms','tblss1student_first_terms.admission_no','=','tblss1position_first_terms.admission_no')
                        ->where('tblss1position_first_terms.session',$session)
                        ->where('tblss1student_first_terms.session',$session)
                        ->where('tblss1position_first_terms.block',$block)
                        ->where('tblss1student_first_terms.block',$block)  
                        ->where('tblss1position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS1' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tblss1student_second_terms')->orderby('tblss1student_second_terms.surname','asc')
            ->join('tblss1position_second_terms','tblss1student_second_terms.admission_no','=','tblss1position_second_terms.admission_no')
                        ->where('tblss1position_second_terms.session',$session)
                        ->where('tblss1student_second_terms.session',$session)
                        ->where('tblss1position_second_terms.block',$block)
                        ->where('tblss1student_second_terms.block',$block) 
                        ->where('tblss1position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS2' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tblss1student_third_terms')->orderby('tblss1student_third_terms.surname','asc')
            ->join('tblss1position_third_terms','tblss1student_third_terms.admission_no','=','tblss1position_third_terms.admission_no')
                        ->where('tblss1position_third_terms.session',$session)
                        ->where('tblss1student_third_terms.session',$session)
                        ->where('tblss1position_third_terms.block',$block)
                        ->where('tblss1student_third_terms.block',$block) 
                        ->where('tblss1position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS2' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
           $students = DB::table('tblss2student_first_terms')->orderby('tblss2student_first_terms.surname','asc')
            ->join('tblss2position_first_terms','tblss2student_first_terms.admission_no','=','tblss2position_first_terms.admission_no')
                        ->where('tblss2position_first_terms.session',$session)
                        ->where('tblss2student_first_terms.session',$session) 
                        ->where('tblss2position_first_terms.block',$block)
                        ->where('tblss2student_first_terms.block',$block) 
                        ->where('tblss2position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS2' AND $request->term_name == 'Third-term' AND $request->session_name == $session) {
            $students = DB::table('tblss2student_second_terms')->orderby('tblss2student_second_terms.surname','asc')
            ->join('tblss2position_second_terms','tblss2student_second_terms.admission_no','=','tblss2position_second_terms.admission_no')
                        ->where('tblss2position_second_terms.session',$session)
                        ->where('tblss2student_second_terms.session',$session)
                        ->where('tblss2position_second_terms.block',$block)
                        ->where('tblss2student_second_terms.block',$block) 
                        ->where('tblss2position_second_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS3' AND $request->term_name == 'First-term' AND $request->session_name == $session) {
            $students = DB::table('tblss2student_third_terms')->orderby('tblss2student_third_terms.surname','asc')
            ->join('tblss2position_third_terms','tblss2student_third_terms.admission_no','=','tblss2position_third_terms.admission_no')
                        ->where('tblss2position_third_terms.session',$session)
                        ->where('tblss2student_third_terms.session',$session)
                        ->where('tblss2position_third_terms.block',$block)
                        ->where('tblss2student_third_terms.block',$block) 
                        ->where('tblss2position_third_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }elseif ($request->class_name == 'SS3' AND $request->term_name == 'Second-term' AND $request->session_name == $session) {
            $students = DB::table('tblss3student_first_terms')->orderby('tblss3student_first_terms.surname','asc')
            ->join('tblss3position_first_terms','tblss3student_first_terms.admission_no','=','tblss3position_first_terms.admission_no')
                        ->where('tblss3position_first_terms.session',$session)
                        ->where('tblss3student_first_terms.session',$session)
                        ->where('tblss3position_first_terms.block',$block)
                        ->where('tblss3student_first_terms.block',$block) 
                        ->where('tblss3position_first_terms.grandtotal','<>',0)
            ->get()->unique('admission_no');

        }

        view()->share(['students' => $students]);

         $data = array('students' => $students);

         if($request->has('download'))
            {
                //PDF::setOptions(['dpi' => 150]);

                $pdf = PDF::loadView('pages.admin.school-fees-list-pdf',compact('data'))->setPaper('a4')->setOrientation('landscape');

                return $pdf->download('school_fees_list.pdf');
            }


        return view('pages.admin.view-report');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
