@extends('layouts.admin.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Marks
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School Management</a></li>
        <li class="active">Marks</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        @if (count($errors) > 0)
             <div class="alert alert-danger">
        <ul>
        <strong>Whoops!</strong> There were some problems with your input.
        <br/>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(Session::has('message')) 
    <div class="alert alert-info"> 
    {{Session::get('message')}} 
    </div> 
    @endif
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Marks</h3>
            </div>
<style type="text/css">
  .table>tbody>tr>td, 
              .table>tbody>tr>th,
              .table>thead>tr>th
              {
                line-height: 2em;
                padding: 5px;
                border-top: 1px solid #000;
                border-bottom: 2px solid #000;
              }
  .new_signature{
                height: 100px;
                width: 300px;
                position: absolute;
                margin-top:140px;
                margin-left: 400px;
                opacity: 0.5;
              }

              .watermark{
                content: "";
                display: block;
                width: 100%;
                height: 100%;
                position: absolute;
                top:480px;
                left: 280px;
                background-repeat: no-repeat;
                background-size: 100px 100px;
                background-position: 30px 30px;
                opacity: 0.1;
              }
</style>
            
        
      @if(count($positions) == 0)
                
                <div class='alert-danger'>No report found!</div>
              @else

              <?php
              $total_std = count($positions);
              // $halved = array_chunk($positions, ceil(count($positions)/$total_std));
              $student_positions = $positions;    
                  //dd($student_positions[0]->surname);
              ?>
 <a href="{{route('admin-generate-bulkreport-pdf',['download' => 'pdf','class_name' => $_GET['class_name'],'block' => $_GET['block'],'term_name' => $_GET['term_name'],'session_name' => $_GET['session_name']])}}" class="btn btn-success">Print Bulk Result </a>
              @for ($i=0; $i < $total_std; $i++)
              <div class="box-body">
              
              <div class="result-border">
                <div class="logo">
                  @if($logos)
                  @foreach($logos as $logo)
                    <img src="/uploads/school_logo/{{$logo->logo}}" class="imglogo">
                  @endforeach
                  @endif
                </div>

                <div class="topgrade-heading">
                  @if(preg_match('/^Pr.*/', $_GET['class_name']))
                    <h3 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.name', 'Jibsoft Tech Ltd'))}}</h3>
                  @else
                  <h3 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.name', 'Jibsoft Tech Ltd'))}}</h3>
                  @endif
                  <h6 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.address', 'P.O.BOX 10, UMUNEDE'))}} {{ strtoupper(config('app.lga', 'P.O.BOX 10, UMUNEDE'))}}</h6>
                  <h6 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.slogan', ''))}}</h6>
                </div>

                <h3 align="center" style="font-weight: 600; margin-top: 30px; color: black;">TERMLY REPORT SHEET</h3>

                <div class="student-heading">
                  
                   <label>Name of Student: <strong>{{strtoupper($student_positions[$i]->surname)}} {{strtoupper($student_positions[$i]->firstname)}} {{strtoupper($student_positions[$i]->othername)}}</strong></label> <br/> <label>Admission No.: {{$student_positions[$i]->admission_no}}</label> <label class="space">Term: {{$_GET['term_name']}}</label><br/><label>Class: {{$student_positions[$i]->class}}{{$student_positions[$i]->block}}</label><label class="space2">Session: {{$student_positions[$i]->session}}</label>
                </div>

                <div>
                   @if($student_positions[$i]->passport == NULL)
                  <img src="/uploads/students_passport/blank-images.jpg" class="stpass">
                  @else
                  <img src="/uploads/students_passport/{{$student_positions[$i]->passport}}" class="stpass">
                  @endif
                </div>

               

                  <table class="table" style="margin-top: 5px;">
                    <tr>
                    <thead style="background-color: lightgrey;">
                    <th>Subjects</th>
                    <th>1st Test (20%)</th>
                    <th>2nd Test (30%)</th>
                    <th>Exam (50%)</th>
                    <th>Total (100%)</th>
                    <th>Remarks</th>
                    </thead>
                  </tr>
                  <tbody>
                   @if($positions)
                    @php
                      $mark_arrs = unserialize($student_positions[$i]->marks);
                      //dd($mark_arr);
      
                    $m = collect($mark_arrs);
                      $mark = $m->flatten();

                    
                    foreach($mark_arrs as $mark_subject){
                          $subj[] = array_keys($mark_subject);
                    }

                  @endphp
                    
                    @for($j=0; $j < count($mark_arrs); $j++)
                    
                    
                    @php
                    $mark_arr = $mark->values()->all();
                      $mmm[$j] = explode(',',$mark_arr[$j]);
                      //dd($mmm);
                    @endphp

                    <tr>
                      <td>{{$subj[$j][0]}}</td><td align="center">@if($mmm[$j][0] == 0) @else{{$mmm[$j][0]}}@endif</td><td align="center">@if($mmm[$j][1] == 0) @else {{$mmm[$j][1]}}@endif</td><td align="center">@if($mmm[$j][2] == 0) @else {{$mmm[$j][2]}}@endif</td><td align="center">@if($mmm[$j][3] == 0) @else {{$mmm[$j][3]}} @endif</td><td align="center">@if($mmm[$j][3] != 0 AND $mmm[$j][4] == 'FAIL')<p style='color: red; font-weight: 600;'>{{$mmm[$j][4]}}</p> @elseif($mmm[$j][3] == 0 AND $mmm[$j][4] == 'FAIL') @else {{$mmm[$j][4]}}@endif </td>
                    </tr>
                    @endfor
                    @endif
                  </tbody>
                  </table>
                  <table class="table table-bordered table-striped">
                <tbody>
                <tr>
                  <td align="center" style="background-color: lightgrey;">STUDENT REPORT SUMMARY</td>
                </tr>
                  <img src="/uploads/principals_stamp/{{$stamps->stamp_sign}}" class="new_signature">
                <tr>
                  <td>TOTAL MARKS:{{$student_positions[$i]->grandtotal}} OUT OF @if($_GET['class_name'] == 'SS2' AND $_GET['term_name'] == 'First-term'){{10*100}}@elseif($_GET['class_name'] == 'SS2' AND $_GET['term_name'] == 'Second-term'){{10*100}}@elseif($_GET['class_name'] == 'SS2' AND $_GET['term_name'] == 'Third-term'){{10*100}}@elseif($_GET['class_name'] == 'SS3' AND $_GET['term_name'] == 'First-term'){{9*100}}@elseif($_GET['class_name'] == 'SS3' AND $_GET['term_name'] == 'Second-term'){{9*100}}@elseif($_GET['class_name'] == 'SS1') {{14*100}} @else{{count($subjects)*100}}@endif <label class="space5">POSITION IN CLASS: {{$student_positions[$i]->position}} OUT OF {{count($students)}}</label><label class="space5">RESUMPTION DATE: @if($resumes) @foreach($resumes as $resume) {{date('D jS M, Y',strtotime($resume->resumption_date))}} @endforeach @endif </label> </td>
                </tr>

                <tr>
                <td>AVERAGE SCORE: <?php if($_GET['class_name'] == 'SS2'){ $average_score = ceil($student_positions[$i]->grandtotal/10); }elseif($_GET['class_name'] == 'SS3'){ $average_score = ceil($student_positions[$i]->grandtotal/9); }elseif($_GET['class_name'] == 'SS1'){ $average_score = ceil($student_positions[$i]->grandtotal/14); } else{ $average_score = ceil($student_positions[$i]->grandtotal/count($subjects)); } ?> {{$average_score}}</label> <label class="space5">AVERAGE DIVISION/REMARK:  @if($average_score >= 70) {{'A (Excellent)'}} @elseif($average_score >= 60) {{'B (Very Good)'}} @elseif($average_score >= 50) {{'C (Credit)'}} @elseif($average_score >= 40) {{'D (Pass)'}} @elseif($average_score >= 30) <font color="red">{{'F (Fail)'}}</font> @elseif($average_score >= 0) <font color="red">{{'F (Fail)'}}</font>@endif </label> <label class="space5">NEXT TERM'S SCHOOL FEES: @if($fees) @foreach($fees as $school_fee) &#8358;{{number_format($school_fee->fee)}} @endforeach @endif</label>
                  </td>
                </tr>

               <tr>
                   @if($average_score >= 40 AND $mmm[0][3] >= 40 AND $mmm[1][3] >= 40) 
                   <?php $remark = "PASS"; ?>
                   
                   @elseif($average_score >= 0 OR $mmm[0][3] < 40 OR $mmm[1][3] < 40) 
                   <?php $remark = "<font color='red'>FAIL</font>"; ?> 
                   
                   @elseif($_GET['term_name'] == 'Third-term')
                    @if($mmm[0][3] < 40 OR $mmm[1][3] < 40)
                         <?php $remark = "<font color='red'>RESIT</font>"; ?>
                    @endif
                   @endif
                   
                   
                   
                   
                  <td>FORM MASTER'S REMARK/SIGNATURE: {!! $remark !!}
                  </td>
                  
                </tr>
                
                <tr>
                  <td>PRINCIPAL'S REMARK/SIGNATURE: </td> 
                </tr>
                
              </div>
                </tbody>
                </table>
              </div>
              
              
                
              </div>
              <!-- /.box-body -->
             
@endfor
 @endif             
            <!-- </form> -->
            
          </div>
          <!-- /.box -->
              
          </div>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection