@extends('layouts.admin.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Teachers
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School Management</a></li>
        <li class="active">Add Teachers</li>
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
              <h3 class="box-title">Add Teachers</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ url('/admin/add-teachers') }}" enctype="multipart/form-data">
              @csrf
              <div class="box-body">

                 <div class="form-group">
                  <img id="blah" src="/uploads/teachers_passport/blank-images.jpg" style="width: 100px; height: 100px;" alt="your image" /><br/>
                  <label for="class">Passport Photograph</label>
                  <input type="file" id="imgInp" name="passport" class="form-control" value="{{old('passport')}}">
                  
                  @if ($errors->has('passport'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passport') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Signature</label>
                  <input type="file" name="signature" class="form-control">
                  
                  @if ($errors->has('signature'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('signature') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Surname:</label>
                  <input type="text" name="surname" class="form-control">
                  
                  @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Firstname:</label>
                  <input type="text" name="firstname" class="form-control">
                  
                  @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
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
                  <label for="class">Qualification:</label>
                  <input type="text" name="qualification" class="form-control">
                  
                  @if ($errors->has('qualification'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qualification') }}</strong>
                                    </span>
                   @endif
                </div>
                
                <div class="form-group">
                  <label for="class">Address:</label>
                  <textarea name="address" class="form-control">
                    
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
                    <option>Select</option>
                <option>Abia</option>
                <option>Adamawa</option>
                <option>Akwa-Ibom</option>
                <option>Anambra</option>
                <option>Bauchi</option>
                <option>Bayelsa</option>
                <option>Benue</option>
                <option>Borno</option>
                <option>Cross-River</option>
                <option>Delta</option>
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
                  <input type="text" name="phone_no" class="form-control">
                  
                  @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                   @endif
                </div>


                <div class="form-group">
                  <label for="class">Subjects Taught:</label>
                  
                  <input type="text" name="subject_taught" class="form-control">         
                  
                  @if ($errors->has('subject_taught'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject_taught') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Class</label>
                  
                  <select name="class" class="form-control" value="{{old('class')}}">
                    @if($classes)
                    @foreach($classes as $class)
                    <option>{{$class->class_name}}</option>
                    @endforeach
                    @endif
                  </select>       
                  
                  @if ($errors->has('class'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Portfolio</label>
                  
                  <select name="portfolio" class="form-control">
                    <option>Principal</option>
                    <option>Vice Principal</option>
                    <option>Teacher</option>
                  </select>         
                  
                  @if ($errors->has('portfolio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('portfolio') }}</strong>
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