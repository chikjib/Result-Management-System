@extends('layouts.frontend.master')
@section('content')
	<div class="header">
		<!-- Slider -->
			<div class="slider">
				<div class="callbacks_container">
					<ul class="rslides" id="slider">
					
						<li>
						
							<div class="slider-info">
								<p>Education is a vaccine for violence.</p>
								<h3><a href="/"><span>Topgrade College</span> Umunede</a></h3>
								<h6>first and best.</h6>
							</div>
						</li>
						
						<li>
						
							<div class="slider-info">
								<p>Learning never exhausts the mind.</p>
								<h3><a href="/"><span>Topgrade College</span> Umunede</a></h3>
								<h6>first and best.</h6>
							</div>
						</li>
							
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		<!-- //Slider -->
	</div>
</div>
<!--main-content-->
<!---728x90--->

<!--about-->
<div id="about" class="about">
	<div class="container">
			<h1>About <span>us</span></h1>
			<h2 style="font-family: inherit;">
			Topgrade College is a private secondary school located in Umunede, Delta State, Nigeria. It was founded by Mr Mathew Omueguchulam in the year 2000.

			The school was founded to imbibe knowledge, discipline, respect and self awareness in every young generation.

			The school is a government licensed school with the authority to operate in both the junior secondary and senior secondary level.
			</h2>
			<h1>Aims and Objectives</h1>
			 <ul style="color: #000; border: thin; font-family: inherit; text-align: justify; font-size: 20px; list-style:circle;">
                        <li>To provide qualitative education for the total child regardless of their class or background.</li>
                        <li>To produce students who are morally and intellectually sound to become the leaders of tomorrow</li>
                        
                        <li>To provide knowledge and skills that will equip students to live effectively in our modern age of science and technology.</li>
                        <li>To expose our students to their immediate environment through excursions to various companies, tourist centres and other places of historical importance.</li>
                        <li>To develop the personality, character and interest of all students so that their responsibility and usefulness as citizens are enhanced.</li>

                        <li>To provide high quality instruction for all its students.</li>
                        <li>To provide the students with appropriate skills, abilities and competence both mental and physical for maximum self actualization.</li>
                        <li>To provide guidance and counseling to students to help them select career choices based on areas of interest and talent.</li>
                        <li>To raise a generation of honest, principled, broadminded Nigerians who can think for themselves and respect the views and feelings of others.</li>
                        <li>To involve our students in co-operative activities thereby creating opportunity for leadership roles to be identified and encouraged.</li>
                        <li>To produce individuals who will contribute meaningfully towards the development of our rich cultural heritage, art and language.</li>
                        <li>To help our students develop competitive spirit by training them to be good sportsmen and women through the provision of adequate sports facilities.</li>

                </ul>
      

			<div class="specialty-grids-top">
				<div class="col-md-4 service-box" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<figure class="icon">
						<span class="glyphicon glyphicon-education a1" aria-hidden="true"></span>
					</figure>
					<h5>Awesome Education</h5>
					<p>To provide qualitative education for the total child regardless of their class or background.</p>
				</div>
				<div class="col-md-4 service-box wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<figure class="icon">
						<span class="glyphicon glyphicon-home a2" aria-hidden="true"></span>
					</figure>
					<h5>Awesome classes</h5>
					<p>To expose our students to their immediate environment through excursions to various companies, tourist centres and other places of historical importance.</p>
				</div>
				<div class="col-md-4 service-box wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<figure class="icon">
						 <span class="glyphicon glyphicon-leaf a3" aria-hidden="true"></span>						
					</figure>
					<h5>Awesome Teachings</h5>
					<p>To provide guidance and counselling to students to help them select career choices based on areas of interest and talent.</p>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

<!-- gallery -->
<div class="portfolio" id="gallery">
	<h3>Gallery</h3>
		
		<div class="portfolio-top wow fadeInDown animated" data-wow-delay=".5s">
		 @if($galleries)
		 @foreach($galleries as $gallery)
			<div class="col-md-4 grid slideanim">
				<figure class="effect-jazz">
				<a href="#portfolioModal1"  data-toggle="modal">

					<img src="/uploads/school_gallery/{{$gallery->image}}" alt="img25" class="img-responsive"/>
						<figcaption>
							<h4>{{$gallery->caption}}</h4>
							<p> {{$gallery->description}}</p>
						</figcaption>
					</a>						
				</figure>
			</div>
		@endforeach
		@endif
<div class="clearfix"></div>
		 </div>
	</div>

<!-- team -->
<div class="team" id="staff">
	<div class="container">
		<h3 class="title"><span>Administrative Officers</span></h3>
		<div class="team_gds">
			@if($staffs)
			@foreach($staffs as $staff)
			<div class="col-md-3 team_gd1 wow zoomIn" data-wow-duration="1.5s" data-wow-delay="0.1s">
				<div class="team_pos">
					<div class="team_back"></div>
					<img class="img-responsive" src="/uploads/admin_staff/{{$staff->image}}" alt=" ">
					<div class="team_info">
						<a href="#"  class="face_one"><i class=" so1 fa fa-facebook fc1" aria-hidden="true"></i></a>
						<a href="#"  class="face_one"><i class=" so2 fa fa-twitter fc2" aria-hidden="true"></i></a>
						<a href="#"  class="face_one"><i class=" so3 fa fa-google fc3" aria-hidden="true"></i></a>
					</div>
				</div>
				<h4>{{$staff->name}}</h4>
				<p>{{$staff->position}}</p>
			</div>
			@endforeach
			@endif
			<div class="clearfix"></div>		
		</div>
	</div>
</div>
<!-- //team -->
<div class="event" id="events">
	@if($posts)
	<div class="container">
		<h3>Events</h3>

	@foreach($posts as $post)
	
				<div class="col-md-4 eve-agile e{{$loop->iteration}}">
			<div class="eve-sub1">
				<a href="#" data-toggle="modal" data-target="#myModal{{$loop->iteration +4}}"><img src="/uploads/posts/{{$post->featured_image}}" class="img-responsive" alt="image"></a>
			<h4><a href="#" data-toggle="modal" data-target="#myModal{{$loop->iteration +4}}">{{$post->title}}</a></h4>
				<h6 style="padding-left: 5px;">By <a href="#" style="font-weight: 600; font-style: italic;">{{ucwords($post->author)}}</a>, {{date('D jS M-Y',strtotime($post->created_at))}}</h6>
				<p style="padding-left: 5px;">{!! \Illuminate\Support\Str::words($post->body,30, '...') !!}</p>
			</div>
			<div class="eve-sub2">	
				<div class="eve-w3lright e1">
					<a href="#" data-toggle="modal" data-target="#myModal{{$loop->iteration +4}}"><h5>More</h5></a>
				</div>
				<div class="clearfix"></div>	
			</div>
		</div>
		
	
	@endforeach
	@endif
</div>
</div>
@if($posts)
	@foreach($posts as $post)
						<div class="modal fade" id="myModal{{$loop->iteration + 4}}" tabindex="-1" role="dialog" >
							<div class="modal-dialog">
							<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4>{{$post->title}}</h4>
											<img src="/uploads/posts/{{$post->featured_image}}" alt="blog-image" />
											<span>{!! $post->body !!}</span>
									</div>
								</div>
						
							</div>
				       </div>
				      @endforeach
				      @endif


@endsection