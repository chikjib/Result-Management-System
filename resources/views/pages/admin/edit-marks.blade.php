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
            <!-- /.box-header -->
            <!-- form start -->
            <style type="text/css">
              .result-border{
                width: 800px;
                height: auto;
                border: 3px solid grey;
                margin-left: 100px;
              }
              .imglogo {
                width: 130px;
                height: 130px;
              }
              .topgrade-heading{
                margin-top: -130px;
              }
              .student-heading {
                width: 795px;
                height: auto;
                border: 2px solid grey;
                margin-top:80px;
              }
              .stpass{
                width: 100px;
                height: 100px;
                float: right;
                margin-top: -105px;
                margin-right: 5px;
              }

              label,input,h4{
                margin: 5px 5px 5px 5px;
              }
            </style>
            
            <form role="form" method="post" action="/admin/update-marks/{{$student->id}}">
              @csrf
              <div class="box-body">
              <div class="result-border">
                <div class="logo">
                  @if($logos)
                  @foreach($logos as $logo)
                    <img src="/uploads/school_logo/{{$logo->logo}}" class="imglogo">
                  @endforeach
                  @endif                </div>
                 <div class="topgrade-heading">
                  @if(preg_match('/^Pr.*/', $_GET['class_name']))
                    <h3 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.name', 'Jibsoft Tech Ltd'))}}</h3>
                  @else
                  <h3 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.name', 'Jibsoft Tech Ltd'))}}</h3>
                  @endif
                  <h6 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.address', 'P.O.BOX 10, UMUNEDE'))}} {{ strtoupper(config('app.lga', 'P.O.BOX 10, UMUNEDE'))}}</h6>
                  <h6 align="center" style="font-weight: 600; color: black;">{{ strtoupper(config('app.slogan', ''))}}</h6>
                </div>

                <div class="student-heading">
                  <input type="hidden" name="student_id" value="{{$student->id}}">
                  <label>Surname: </label> <input type="text" name="surname" value="{{$student->surname}}" readonly> <label>Firstname: </label> <input type="text" name="firstname" value="{{$student->firstname}}" readonly><br/> <label>Admission No.: </label> <input type="text" name="admission_no" value="{{$student->admission_no}}" readonly><label>Term: </label> <input type="text" name="term" value="{{$_GET['term_name']}}" readonly><br/><label>Class:</label><input type="text" name="class" value="{{$_GET['class_name']}}" readonly><label>Block:</label><input type="text" name="block" value="{{$_GET['block']}}" size="5" readonly><label>Session:</label><input type="text" name="session" value="{{$_GET['session_name']}}" readonly>
                </div>

                <div>
                  @if($student->passport == NULL)
                  <img src="/uploads/students_passport/blank-images.jpg" class="stpass">
                  @else
                  <img src="/uploads/students_passport/{{$student->passport}}" class="stpass">
                  @endif
                </div>
                  


                  <table class="table table-bordered table-striped">
                    <tr>
                    <thead>
                    <th>Subject</th>
                    <th>1st Test</th>
                    <th>2nd Test</th>
                    <th>Exam</th>
                    </thead>
                  </tr>
                  <tbody>
                    @if($marks)
                    @php
                      $mark_arrs = unserialize($marks[0]->marks);

                      //dd($mark_arrs);
                      $m = collect($mark_arrs);
                      $mark = $m->flatten();

                    
                    foreach($mark_arrs as $mark_subject){
                          $subjects[] = array_keys($mark_subject);
                    }
                  @endphp
                    
                    @for($i=0; $i < count($mark_arrs); $i++)
                    
                    
                    @php
                    $mark_arr = $mark->values()->all();
                      $mmm[] = explode(',',$mark_arr[$i]);
                      
                    @endphp
                    <tr>
                      <td>
                        <input type="hidden" name="subject_name[]" value="{{$subjects[$i][0]}}">{{$subjects[$i][0]}}
                      </td>
                      <td>
                        <input type="text" name="first_test[]" value="{{$mmm[$i][0]}}">
                      </td>
                      <td>
                          <input type="text" name="second_test[]" value="{{$mmm[$i][1]}}">
                      </td>
                      <td>
                        <input type="text" name="exam[]" value="{{$mmm[$i][2]}}">
                      </td>
                    </tr>
                    @endfor
                    @endif
                  </tbody>

                  </table>
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </div>


                
              </div>
              <!-- /.box-body -->

              
            </form>
            
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