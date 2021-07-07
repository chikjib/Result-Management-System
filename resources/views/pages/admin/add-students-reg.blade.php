@extends('layouts.admin.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Students
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School Management</a></li>
        <li class="active">Add Students</li>
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
              <h3 class="box-title">Add Students</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <form role="form" method="post" action="{{ url('/admin/add-students') }}" enctype="multipart/form-data" runat="server">
              @csrf
              <div class="box-body">
                  

              
                 <div class="form-group">
                  <img id="blah" src="/uploads/students_passport/blank-images.jpg" style="width: 100px; height: 100px;" alt="your image" /><br/>
                  <label for="class">Passport Photograph</label>
                  <input type="file" id="imgInp" name="passport" class="form-control" value="{{old('passport')}}">
                  
                  @if ($errors->has('passport'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                   @endif
                </div>

                 <div class="form-group">
                  <label for="class">Admission No.</label>
                  <input type="text" name="admission_no" value="{{$reg_no}}" class="form-control" readonly>
                  
                  @if ($errors->has('admission_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('admission_no') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Surname:</label>
                  <input type="text" name="surname" class="form-control" value="{{old('surname')}}">
                  
                  @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Firstname:</label>
                  <input type="text" name="firstname" class="form-control" value="{{old('firstname')}}">
                  
                  @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Othername:</label>
                  <input type="text" name="othername" class="form-control" value="{{old('othername')}}">
                  
                  @if ($errors->has('othername'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('othername') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Sex:</label>
                  <select name="sex" class="form-control">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  
                  @if ($errors->has('sex'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
                                    </span>
                   @endif
                </div>

                 <div class="form-group">
                  <label for="class">Date of Birth:</label>
                  <input type="date" name="date_of_birth" class="form-control">
                  
                  @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Name of Parents:</label>
                  <input type="text" name="name_of_parents" class="form-control" value="{{old('name_of_parents')}}">
                  
                  @if ($errors->has('name_of_parents'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name_of_parents') }}</strong>
                                    </span>
                   @endif
                </div>
                
                <div class="form-group">
                  <label for="class">Address:</label>
                  <textarea name="address" class="form-control">
                    {{old('address')}}
                  </textarea>
                  
                  @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                   @endif
                </div>


                <div class="form-group">
                  <label for="class">State:</label>
                  <select name="state" class="form-control">
                <option>Abia</option>
                <option>Adamawa</option>
                <option>Akwa-Ibom</option>
                <option>Anambra</option>
                <option>Bauchi</option>
                <option>Bayelsa</option>
                <option>Benue</option>
                <option>Borno</option>
                <option>Cross-River</option>
                <option selected>Delta</option>
                <option>Ebonyi</option>
                <option>Edo</option>
                <option>Ekiti</option>
                <option>Ebonyi</option>
                <option>Enugu</option>
                <option>Gombe</option>
                <option>Imo</option>
                <option>Jigawa</option>
                <option>Kaduna</option>
                <option>Kano</option>
                <option>Katsina</option>
                <option>Kebbi</option>
                <option>Kogi</option>
                <option>Kwara</option>
                <option>Lagos</option>
                <option>Nasarawa</option>
                <option>Niger</option>
                <option>Ogun</option>
                <option>Ondo</option>
                <option>Osun</option>
                <option>Oyo</option>
                <option>Plateau</option>
                <option>Rivers</option>
                <option>Sokoto</option>
                <option>Taraba</option>
                <option>Yobe</option>
                <option>Zamfara</option>
                <option>FCT</option>
                  </select>
                  
                  @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                   @endif
                </div>
                <div class="form-group">
                  <label for="class">Phone No.:</label>
                  <input type="text" name="phone_no" class="form-control" value="{{old('phone_no')}}">
                  
                  @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Class Admitted:</label>
                  @if($_GET['class_name'])
                  <input type="text" name="class_name" class="form-control" value="{{$_GET['class_name']}}" readonly>
                  @endif
                  
                  @if ($errors->has('class_admitted'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class_admitted') }}</strong>
                                    </span>
                   @endif
                </div>

                  <div class="form-group">
                  <label for="class">Block</label>
                  @if($_GET['block'])
                  <input type="text" name="block" class="form-control" value="{{$_GET['block']}}" readonly>
                  @endif
                  
                  @if ($errors->has('block'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('block') }}</strong>
                                    </span>
                   @endif
                </div>
                
                <input type="hidden" name="term_name" value="{{$_GET['term_name']}}">

                
                <div class="form-group">
                  <label for="class">Session:</label>
                  @if($_GET['session_name'])
                  <input type="text" name="session_name" class="form-control" value="{{$_GET['session_name']}}" readonly>
                  @endif
                  
                  
                  @if ($errors->has('session_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('session_name') }}</strong>
                                    </span>
                   @endif
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
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