@extends('layouts.admin.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       View Cards
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">School Management</a></li>
        <li class="active">Card Generator</li>
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
              <h3 class="box-title">View Scratch Cards</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ url('/admin/card-generate') }}">
              @csrf
              <div class="box-body">


                <div class="form-group">
                  <label for="class">Generate Scratch Cards</label>
                  <input type="number" name="number of cards" class="form-control" placeholder="Input Number of Scratch Cards to generate">
                  
                  @if ($errors->has('cards'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cards') }}</strong>
                                    </span>
                   @endif
                </div>
                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>


<div class="box-body">
  <h3 align="center">Used Cards</h3>
              <table id="example5" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/No.</th>
                  <th>Serial Number</th>
                  <th>Pin Number</th>  
                  <th>Status</th>
                  <th>Admin no</th>
                  <th>Card Usage</th>
                  <th>Action(s)</th>
                </tr>
                </thead>
                <tbody>

                @if($cards)
                @foreach($cards as $card)
                <tr>
                  
                  <td>{{$loop->iteration}}</td>
                  <td>{{$card->serial_no}}</td>
                  <td>{{$card->pin_no}}</td>
                  <td>{{$card->status}}</td>
                  <td>{{$card->admin_no}}</td>
                  <td>{{$card->used_count}}</td>
                  <td><a href="/admin/card/delete/{{$card->id}}" onclick='return show_confirm();' class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
                @endif
                </tbody>
                
              </table>
          </div>
          <hr/>
          <div class="box-body">
            <h3 align="center">Unused Cards</h3>
              <table id="example6" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/No.</th>
                  <th>Serial Number</th>
                  <th>Pin Number</th>
                  <th>Status</th>
                  <th>Card Usage</th>
                  <th>Date Generated</th>
                  <th>Action(s)</th>
                </tr>
                </thead>
                <tbody>

                @if($unused_cards)
                @foreach($unused_cards as $unused_card)
                <tr>
                  
                  <td>{{$loop->iteration}}</td>
                  <td>{{$unused_card->serial_no}}</td>
                  <td>{{$unused_card->pin_no}}</td>                 
                  <td>{{$unused_card->status}}</td>
                  <td>0</td>
                  <td>{{date("D jS M, Y g.ia",strtotime($unused_card->created_at))}}</td>
                  <td><a href="/admin/card/delete/{{$unused_card->id}}" onclick='return show_confirm();' class="btn btn-danger">Delete</a></td>
                </tr>
                @endforeach
                @endif
                </tbody>
                
              </table>
          </div>



        </div>
          <!-- /.box -->
              
          </div>
<script type="text/javascript">
function show_confirm() {
    return confirm("Do You Really Want to delete the Entry ? ");
}
</script>

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection