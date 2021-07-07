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
        <li class="active">Edit Events</li>
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
              <h3 class="box-title">Edit Events</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
            <form role="form" method="post" action="{{ route('UpdatePost') }}" enctype="multipart/form-data" runat="server">
              @csrf
              <div class="box-body">
                  
              <input type="hidden" name="id" value="{{$post->id}}">
                 <div class="form-group">
                  
                  <label for="class">Featured Image</label>
                  <img id="blah" src="/uploads/posts/{{$post->featured_image}}" style="width: 500px; height: 200px;" alt="your image" /><br/>

                  <input type="file" id="imgInp" name="featured_image" class="form-control" value="{{old('featured_image')}}">
                  
                  @if ($errors->has('featured_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('featured_image') }}</strong>
                                    </span>
                   @endif
                </div>


                <div class="form-group">
                  <label for="class">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$post->title}}">
                  
                  @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                   @endif
                </div>


                <div class="form-group">
                  <label for="class">Body</label>
                  <textarea name="body" class="form-control">
                    {{$post->body}}
                  </textarea>
                  
                  @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                   @endif
                </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
               </form>

              </div>
              <!-- /.box-body -->
      

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