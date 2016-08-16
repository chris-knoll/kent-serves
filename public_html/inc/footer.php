<?php
/********************************************************************************
Copyright (c) 2016 Chris Knoll, Kimberly Praxel, Nicole Bassen, & Sergio Ramirez.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
********************************************************************************/
?>

<!-- *****************************************************************************************************************
FOOTER
***************************************************************************************************************** -->
<div id="footerwrap">
	<div class="container">
		<div class="row">
			<div class="col-lg-4">
				<h4>About Kent Serves</h4>
				<div class="hline-w"></div>
				<p>A grassroots effort within the non-profit and service community designed to increase communication, provide opportunities for information
					sharing, community calendaring, and create connections and potential collaboration on efforts
					that require volunteer and financial resources.</p>
				</div>
				<div class="col-lg-4">
					<h4>Social Links</h4>
					<div class="hline-w"></div>
					<p>
						<a href="#" title="FaceBook"><i class="fa fa-facebook"></i></a>
						<a href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
						<a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
						<a href="mailto:Jgerstman@greenriver.edu?Subject=Email%20From%20Kent%20Serves%20website" target="_top"><i class="fa fa-envelope"></i></a>
						</p>
					</div>
					<div class="col-lg-4">
						<h4>Our Bunker</h4>
						<div class="hline-w"></div>
						<p>
							Kent Kangley Rd<br/>
							Kent, WA 98030<br/>
							United States<br/>
						</p>
					</div>

				</div><!--/row -->

				<!-- Created by footer -->
				<div class="row">
					<div class="col-sm-12 created-by-footer"><p>Created by <a href="http://www.greenriver.edu/academics/areas-of-study/bas-programs/software-development.htm">Software Development</a> students at Green River College</p></div>
				</div>

			</div><!--/container -->
		</div><!--/footerwrap -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/retina-1.1.0.js"></script>
		<script src="assets/js/jquery.hoverdir.js"></script>
		<script src="assets/js/jquery.hoverex.min.js"></script>
		<script src="assets/js/jquery.prettyPhoto.js"></script>
		<script src="assets/js/jquery.isotope.min.js"></script>
		<script src="assets/js/custom.js"></script>


		<script>
		// Portfolio
		(function($) {
			"use strict";
			var $container = $('.portfolio'),
			$items = $container.find('.portfolio-item'),
			portfolioLayout = 'fitRows';

			if( $container.hasClass('portfolio-centered') ) {
				portfolioLayout = 'masonry';
			}

			$container.isotope({
				filter: '*',
				animationEngine: 'best-available',
				layoutMode: portfolioLayout,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				},
				masonry: {
				}
			}, refreshWaypoints());

			function refreshWaypoints() {
				setTimeout(function() {
				}, 1000);
			}

			$('nav.portfolio-filter ul a').on('click', function() {
				var selector = $(this).attr('data-filter');
				$container.isotope({ filter: selector }, refreshWaypoints());
				$('nav.portfolio-filter ul a').removeClass('active');
				$(this).addClass('active');
				return false;
			});

			function getColumnNumber() {
				var winWidth = $(window).width(),
				columnNumber = 1;

				if (winWidth > 1200) {
					columnNumber = 5;
				} else if (winWidth > 950) {
					columnNumber = 4;
				} else if (winWidth > 600) {
					columnNumber = 3;
				} else if (winWidth > 400) {
					columnNumber = 2;
				} else if (winWidth > 250) {
					columnNumber = 1;
				}
				return columnNumber;
			}

			function setColumns() {
				var winWidth = $(window).width(),
				columnNumber = getColumnNumber(),
				itemWidth = Math.floor(winWidth / columnNumber);

				$container.find('.portfolio-item').each(function() {
					$(this).css( {
						width : itemWidth + 'px'
					});
				});
			}

			function setPortfolio() {
				setColumns();
				$container.isotope('reLayout');
			}

			$container.imagesLoaded(function () {
				setPortfolio();
			});

			$(window).on('resize', function () {
				setPortfolio();
			});
		})(jQuery);
		</script>
	</body>
	</html>
