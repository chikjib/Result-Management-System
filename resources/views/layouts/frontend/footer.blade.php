
<!-- footer -->
<div id="no_print">
	<div class="footer" id="footer">
		<div class="container">
			<div class="col-md-4 agileinfo_footer_grid">
				<h4>About Us</h4>
				<p align="justify">Topgrade College is a private secondary school located in Umunede, Delta State, Nigeria. It was founded by Mr Mathew Omueguchulam in the year 2000.

				The school was founded to imbibe knowledge, discipline, respect and self awareness in every young generation.

				The school is a government licensed school with the authority to operate in both the junior secondary and senior secondary level.
				</p>
			</div>
			<div class="col-md-4 agileinfo_footer_grid mid-w3l nav2">
				<h4>Options</h4>
				<ul>
					<li><a href="#home" class="scroll">Home</a></li>
					<li><a href="#about" class="scroll">About Us</a></li>
					<li><a href="#gallery" class="scroll">Gallery</a></li>
					<li><a href="#staff" class="scroll">Our Staff</a></li>
					<li><a href="#events" class="scroll">Events</a></li>
				</ul>
			</div>
			<div class="col-md-4 agileinfo_footer_grid">
				<h4>Address</h4>
				<ul>
					<li><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Station Road, Behind Police Station, Umunede, Delta State. Nigeria.</li>
					<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:info@example.com">info@topgradecollege.com</a></li>
					<li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 08035696184</li>
				</ul>
			</div>
			
			<div class="clearfix"> </div>
			<div class="w3agile_footer_copy">
				<p>&copy; 2019 - {{date('Y')}} Topgrade College. All rights reserved | Design by <a href="https://www.jibsoftltd.com.ng">JibSoft Technologies Ltd.</a> Call: 07033248427,09050026406</p>
			</div>
		</div>
	</div>
</div>
<!-- //footer -->
<!-- js -->
<script type="text/javascript" src="{{asset('js/jquery-2.1.4.min.js')}}"></script>


<script src="{{asset('js/jquery.chocolat.js')}}"></script>
		<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
		<!--light-box-files -->
		<script>
		$(function() {
			$('.gallery-grid a').Chocolat();
		});
		</script>
 <!-- required-js-files-->
		
							<link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet">
							    <script src="{{asset('js/owl.carousel.js')}}"></script>
							        <script>
							    $(document).ready(function() {
							      $("#owl-demo").owlCarousel({
							        items : 1,
							        lazyLoad : true,
							        autoPlay : true,
							        navigation : false,
							        navigationText :  false,
							        pagination : true,
							      });
							    });
							    </script>
								 <!--//required-js-files-->

<script src="{{asset('js/responsiveslides.min.js')}}"></script>
		<script>
				$(function () {
					$("#slider").responsiveSlides({
						auto: true,
						pager:false,
						nav: true,
						speed: 1000,
						namespace: "callbacks",
						before: function () {
							$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
						}
					});
				});
			</script>
			

<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

	<!-- bottom-top -->
	<!-- smooth scrolling -->
		<script type="text/javascript">
			$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/								
			$().UItoTop({ easingType: 'easeOutQuart' });
			});
		</script>
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- //smooth scrolling -->
	<!--// bottom-top -->
<script type="text/javascript" src="{{asset('js/bootstrap-3.1.1.min.js')}}"></script>

</body>
</html>
</div>