@extends('layouts.admin.master')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php
              $jss1first = App\Tbljss1studentFirstTerm::all()->toArray();
              $jss1second = App\Tbljss1studentSecondTerm::all()->toArray();
              $jss1third = App\Tbljss1studentThirdTerm::all()->toArray();

              $jss2first = App\Tbljss2studentFirstTerm::all()->toArray();
              $jss2second = App\Tbljss2studentSecondTerm::all()->toArray();
              $jss2third = App\Tbljss2studentThirdTerm::all()->toArray();

              $jss3first = App\Tbljss3studentFirstTerm::all()->toArray();
              $jss3second = App\Tbljss3studentSecondTerm::all()->toArray();
              $jss3third = App\Tbljss3studentThirdTerm::all()->toArray();

              $ss1first = App\Tblss1studentFirstTerm::all()->toArray();
              $ss1second = App\Tblss1studentSecondTerm::all()->toArray();
              $ss1third = App\Tblss1studentThirdTerm::all()->toArray();

              $ss2first = App\Tblss2studentFirstTerm::all()->toArray();
              $ss2second = App\Tblss2studentSecondTerm::all()->toArray();
              $ss2third = App\Tblss2studentThirdTerm::all()->toArray();

              $ss3first = App\Tblss3studentFirstTerm::all()->toArray();
              $ss3second = App\Tblss3studentSecondTerm::all()->toArray();
              $ss3third = App\Tblss3studentThirdTerm::all()->toArray();

              $total_students = collect(array_merge($jss1first,$jss1second,$jss1third,$jss2first,$jss2second,$jss2third,$jss3first,$jss3second,$jss3third,$ss1first,$ss1second,$ss1third,$ss2first,$ss2second,$ss2third,$ss3first,$ss3second,$ss3third))->unique('admission_no');
              ?>
              <h3>{{$total_students->count()}}</h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="/admin/view-students" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          @if(Auth::user()->role==1 OR Auth::user()->role==2)
          <div class="small-box bg-green">
            <div class="inner">
              <?php
              $teachers = App\Teacher::all();
              ?>
              <h3>{{count($teachers)}}</h3>

              <p>Teachers</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="/admin/view-teachers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          @endif

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          @if(Auth::user()->role==1 OR Auth::user()->role==2)
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
              $events = App\Post::all();
              ?>
              <h3>{{count($events)}}</h3>

              <p>Posts</p>
            </div>
            <div class="icon">
              <i class="fa fa-edit"></i>
            </div>
            <a href="/admin/post" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          @endif
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
        @if(Auth::user()->role==1 OR Auth::user()->role==2)
          <div class="small-box bg-red">
            <div class="inner">
              <?php
              $unusedcards = App\Card::where('status','unused')->get();
              $total_cards = App\Card::all();
              ?>
              <h3>{{$unusedcards->count()}}/{{$total_cards->count()}}</h3>

              <p>Available Scratch Cards</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          @endif
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        
      </div>

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
 @endsection