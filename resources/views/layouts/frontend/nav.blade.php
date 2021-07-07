<body>
<div class="main-w3layouts" id="home">
	<!--top-bar-->
	<div class="top-search-bar">
		
		<div class="header-top-nav">
			<ul>
				<div class="logo">
                  <p><img src="/uploads/school_logo/{{$logo}}" class="topgrade-logo">
                  {{ config('app.name', 'Laravel') }}</p>
              </div>

			</ul>
		</div>
	</div>

			<div class="clearfix"></div>
	<!-- //Modal3 -->
<style type="text/css">
.wrap{
     padding:0;
    margin:0;
    width:100%;
}
.left_div{
    width:45%;
    display:inline-block;
    margin: 5px 20px 5px 5px;
}
.right_div{
    width:45%;
    display:inline-block;
    margin: 5px 5px 5px 5px;    
}
.right_div1{
    width:22%;
    display:inline-block;
    margin: 5px 5px 5px 5px;    
}
.right_div2{
    width:20%;
    display:inline-block;
    margin: 5px 5px 5px 5px;    
}
.pin_div{
	width: 80%;
	padding-left: 70px;
}
.submit_btn{
	width: 50%;
}
</style>
	<div class="modal fade" id="myResultChecker" tabindex="-1" role="dialog" >
			<div class="modal-dialog" role="document">
			<!-- Modal content-->
				<div class="modal-content news-w3l">
						<div class="modal-header">
							<button type="button" class="close w3l" data-dismiss="modal">&times;</button>
							<h4>Result Checker</h4>
							<!--newsletter-->
							<div class="login-main wthree wrap">
							  <form action="/view_report_card" method="get">
							  	@csrf
							  	<div class="form-group left_div">
				                  <label for="admission_number">Admission No.</label>
				                  <input type="text" name="admission_number" class="form-control">
				                  
				                  @if ($errors->has('admission_number'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('admission_number') }}</strong>
				                                    </span>
				                   @endif

				                   
				                </div>
								
				                <div class="form-group right_div1">
				                  <label for="class">Class</label>
								   <select name="class_name" class="form-control">
								   	@if($classes)
								   	@foreach($classes as $sclass)
								   	<option>{{$sclass->class_name}}</option>
								   	@endforeach
								   	@endif
								   </select>				                  
				                  @if ($errors->has('class_name'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('class_name') }}</strong>
				                                    </span>
				                   @endif

				                </div>
				                
				                <div class="form-group right_div2">
				                <label for="block">Block</label>
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
				                
				                <div class="form-group left_div">
				                  <label for="term">Term</label>
								   <select name="term_name" class="form-control">
								   	@if($terms)
								   	@foreach($terms as $term)
								   	<option>{{ucwords($term->term_name)}}</option>
								   	@endforeach
								   	@endif
								   </select>				                  
				                  @if ($errors->has('term_name'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('term_name') }}</strong>
				                                    </span>
				                   @endif
				                </div>

								<div class="form-group right_div">
				                  <label for="session">Session</label>
								   <select name="session_name" class="form-control">
								   	@if($school_sessions)
								   	@foreach($school_sessions as $school_session)
								   	<option>{{$school_session->session_name}}</option>
								   	@endforeach
								   	@endif
								   </select>				                  
				                  @if ($errors->has('session_name'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('session_name') }}</strong>
				                                    </span>
				                   @endif
				                </div>

				                <div class="form-group left_div" align="center">
				                  <label for="serial_number">Serial No.</label>
				                  <input type="text" name="serial_number" class="form-control">
				                  
				                  @if ($errors->has('serial_number'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('serial_number') }}</strong>
				                                    </span>
				                   @endif
				                </div>
				                <div class="form-group right_div">
				                  <label for="pin_number">Pin No.</label>
				                  <input type="password" name="pin_number" class="form-control">
				                  
				                  @if ($errors->has('pin_number'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('pin_number') }}</strong>
				                                    </span>
				                   @endif
				                </div>
								
								<input type="submit" value="Check Result" class="btn btn-success submit_btn">
							</form>
							</div>
						<!--//newsletter-->			
						</div>
					</div>
				</div>
			 </div>
			<div class="clearfix"></div>

	<!-- //Modal4-->
		
	<!--//top-bar-->
	<!-- navigation -->
			<div class ="top-nav">
				<nav class="navbar navbar-default">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							
						</div>
						<!-- navbar-header -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="/" class="hvr-underline-from-center active">Home</a></li>
								<li><a href="#about" class="hvr-underline-from-center scroll">About Us</a></li>
								<li><a href="#gallery" class="hvr-underline-from-center scroll">Gallery</a></li>
								<li><a href="#staff" class="hvr-underline-from-center scroll">Our Staff</a></li>
								<li><a href="#events" class="hvr-underline-from-center scroll">Events</a></li>
								<!-- <li><a href="#contact" class="hvr-underline-from-center scroll">Contact Us</a></li> -->
								<li><a class="nav-space"></a></li>
								<li><a class="phone"><i class="fa fa-phone"> 08035696184 </i></a></li>
			
								<li><a href="#" data-toggle="modal" data-target="#myResultChecker" style="color: #fff; font-weight: 600;" ><i class="fa fa-list-alt" aria-hidden="true" style="color: #fff;"></i> RESULT CHECKER</a></li>
							</ul>
						</div>
						<div class="clearfix"> </div>	
				</nav>
			</div>
	<!-- //navigation -->

