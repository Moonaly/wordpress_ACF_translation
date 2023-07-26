/* ============= How It Work ================ */
function how_it_work($atts){
	$postid = get_the_ID();
	extract(shortcode_atts(array( 
		"postid" => get_the_ID()
		), $atts));
		$ret=""; ?>

<div class="row hiwrow align-items-center">
	<?php 
		$upload_dir = wp_get_upload_dir(); 
	?>
			<?php
	$currentpostid= get_the_ID();
	$currentlanguage= get_field('language',$currentpostid);
	if ($currentlanguage['value'] == "cn"){
		$applytoday="立即注册！";
		$hiwtitle="运作方式";
		$step="步骤";

	} else if ($currentlanguage['value'] == "ms"){
		$applytoday="Daftar Sekarang!";
		$hiwtitle="Cara Melakukannya";
		$step="Langkah";

	} else if ($currentlanguage['value'] == "bsy"){
		$applytoday="Pag-apply na Karon";
		$hiwtitle="How It Works";
		$step="Step";

	} else if ($currentlanguage['value'] == "hd"){
		$applytoday="आज ही अप्लाई करें";
		$hiwtitle="How It Works";
		$step="Step";

	} else {
		$applytoday="Apply Today!";
		$hiwtitle="How It Works";
		$step="Step";
	}
		?>

	<div class="col-sm-6 leftcol order-sm-first order-last">
		<?php if( have_rows('how_it_work') ): ?>
		<div class="hiw_title text-white d-block d-sm-none text-center"><h2 class="fs-40"><?php echo $hiwtitle; ?></h2></div>
		<div class="owl-carousel owl-theme hiw_url">			
			<?php while( have_rows('how_it_work') ): the_row();
				$img = get_sub_field('img');
				$id = get_sub_field('href');
			?>			
			<div class="item hiw_phone_img" data-hl="<?php echo $id; ?>">
				<img src="<?php echo $img; ?>" class="phone_img">
			</div>			
			<?php endwhile; ?>
		</div>
		<?php endif; ?>		
		<a href="https://app.lendchampion.com/">
			<div class="applybtn text-center mbl_applybtn">
			<span class=""><?php echo $applytoday; ?></span>
			</div>
		</a>
	</div>
	

	<div class="col-sm-6 rightcol order-first order-sm-last">
		<?php if( have_rows('how_it_work_content') ): ?>
		<div class="hiw_title text-white d-none d-sm-block"><h2 class="fs-40"><?php echo $hiwtitle; ?></h2></div>
		<div class="URLHash_link hiw_url_link text-white">
			<div>
				<?php while( have_rows('how_it_work_content') ): the_row();
				$id = get_sub_field('data_slide');
				$no = get_sub_field('step_num');
				$class = get_sub_field('class');
				$txt = get_sub_field('content');
				?>	
				<?php if( get_sub_field('show') == 'enable_sidebar' ) : ?>
				<div data-slide="<?php echo $id; ?>" class="hash_btn active <?php echo $class; ?>" href="#<?php echo $class; ?>">
					<div class="num my-3 text-white fs-18"><?php echo $step; ?> <?php echo $no; ?></div>
					<br>
					<h4 class="hiw_step_c fc-org fs-40"><?php echo $txt; ?></h4>
				</div>
				<?php else : ?>
				<div data-slide="<?php echo $id; ?>" class="hash_btn <?php echo $class; ?>" href="#<?php echo $class; ?>">
					<div class="num my-3 text-white fs-18"><?php echo $step; ?> <?php echo $no; ?></div> <h4 class="hiw_step_c fc-org fs-40"><?php echo $txt; ?></h4>
				</div>
				<?php endif; ?>		

				<?php endwhile; ?>	
			</div>
		</div>
		<?php endif; ?>
		<a href="https://app.lendchampion.com/">
		<div class="applybtn text-center desktop_applybtn">
			<span class=""><?php echo $applytoday; ?></span>
		</div>
		</a>
	</div>
</div>

<script>
jQuery(document).ready(function() {
	setTimeout(function() {
    jQuery('.hiw_url').owlCarousel({
       // item:2,
		center: true,
        loop:false,
		dots: true,
    	margin:10,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        autoplay: false,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:1,
			},
			1000:{
				items:1,
			}
		},
    });
		jQuery('.hiw_url').on('changed.owl.carousel ', function(event) {
			jQuery('.hiw_url').trigger('stop.owl.autoplay');
            jQuery('.hiw_url').trigger('play.owl.autoplay');
			var current = event.item.index;
			var total_slide = event.item.count;
			var current_plus = current + 1;
			var hash = jQuery(event.target).find(".owl-item").eq(current).find(".item").attr('data-hl');
			jQuery('.'+hash).addClass('active');
			jQuery('.hiw_url_link .hash_btn').not('.'+hash).removeClass('active');

			if(current_plus ==  total_slide) {
				setTimeout(function(){
					jQuery('.hiw_url ').trigger('to.owl.carousel', 0);
				}, 1000);
			}
		}); 
		jQuery(".hiw_url_link .hash_btn").click(function(){
			var slideNum = jQuery(this).attr('data-slide');
			jQuery('.hiw_url').trigger('to.owl.carousel', slideNum)
		});
		
		var first_time = 'true';
		jQuery(window).scroll(function (event) {
			var scroll = jQuery(window).scrollTop();
			if(scroll >= jQuery('#howitworks').offset().top && first_time == 'true') {
				jQuery('.hiw_url').trigger('play.owl.autoplay', 1000);
				first_time = 'false'; 
			}		
		});  
	}, 100);
});	
</script>

<?php
	return $ret;
}
add_shortcode('how_it_work','how_it_work');
/* ============= End of How It Work ================ */