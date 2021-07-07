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
            <form role="form" method="get" action="{{ url('/admin/add-students-reg') }}">
              @csrf
              <div class="box-body">

                 <div class="form-group">
                  <label for="class">Class</label>
                  <select name="class_name" class="form-control">
                    @if($class_datas)
                     @foreach($class_datas as $class_data)
                      <option>{{$class_data->class_name}}</option>
                     @endforeach
                    @endif
                  </select>
                  
                  @if ($errors->has('class_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('class_name') }}</strong>
                                    </span>
                   @endif
                </div>

                 <div class="form-group">
                  <label for="class">Block</label>
                  <select name="block" class="form-control">
                    @if($block_datas)
                     @foreach($block_datas as $block_data)
                      <option>{{$block_data->block}}</option>
                     @endforeach
                    @endif
                  </select>
                  
                  @if ($errors->has('block'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('block') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="session">Session</label>
                  <select name="session_name" class="form-control">
                    @if($session_datas)
                     @foreach($session_datas as $session_data)
                      <option>{{$session_data->session_name}}</option>
                     @endforeach
                    @endif
                  </select>
                  
                  @if ($errors->has('session_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('session_name') }}</strong>
                                    </span>
                   @endif
                </div>

                <div class="form-group">
                  <label for="class">Term</label>
                  <select name="term_name" class="form-control">
                    @if($term_datas)
                     @foreach($term_datas as $term_data)
                      <option>{{ucwords($term_data->term_name)}}</option>
                     @endforeach
                    @endif
                  </select>
                  
                  @if ($errors->has('term_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('term_name') }}</strong>
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