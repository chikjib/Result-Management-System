@extends('layouts.admin.master')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Marks
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School Management</a></li>
        <li class="active">View Students</li>
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
          
            <!-- /.box-header -->
            <!-- form start -->
          
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">View <strong>{{$_GET['class_name']}}{{$_GET['block']}}_{{$_GET['session_name']}}_{{$_GET['term_name']}}</strong> Students</h3>
            <?php
            $session_name = str_replace("/", "_", $_GET['session_name']);
            ?>
            
        <a href="/admin/marks/downloadExcel/{{$_GET['class_name']}}/{{$_GET['block']}}/{{$session_name}}/{{$_GET['term_name']}}/xlsx?term_name={{$_GET['term_name']}}"><button class="btn btn-success">Download Excel xlsx</button></a>
        
        <form style="border: 4px solid grey;margin-top: 15px;padding: 10px;" action="{{ URL::to('/admin/marks/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
          @csrf
          <input type="file" name="import_file" />
          <input type="hidden" name="class_name" value="{{$_GET['class_name']}}">
          <input type="hidden" name="session_name" value="{{$session_name}}">
          <input type="hidden" name="term_name" value="{{$_GET['term_name']}}">
          <input type="hidden" name="block" value="{{$_GET['block']}}">

          <button class="btn btn-primary">Import File</button>
        </form>
        
       
            </div>

            <!-- /.box-body -->
          </div>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  @endsection