<?php get_header(); ?>
<main class="landing-page">
	<a href="<?php echo HOME_URL; ?>" class="logo"><img src="<?php echo IMAGE_URL.'/landing-page/logo.png'; ?>" alt="alphaking"></a>
	<div class="program-name">
		<div class="decor-name"></div>
		<div class="title">Chương trình</div>
		<div class="name">
			<p>Ngàn hành động nhỏ</p> 
			<p>triệu nghĩa cử lớn</p>
		</div>
	</div>
	<div class="slide-banner">
		<div class="slide-item" id="slider-for-banner">
			<div class="slide"><img src="<?php echo IMAGE_URL.'/landing-page/test.png'; ?>" alt="alphaking"></div>
			<div class="slide"><img src="<?php echo IMAGE_URL.'/landing-page/test.png'; ?>" alt="alphaking"></div>
			<div class="slide"><img src="<?php echo IMAGE_URL.'/landing-page/test.png'; ?>" alt="alphaking"></div>
			<div class="slide"><img src="<?php echo IMAGE_URL.'/landing-page/test.png'; ?>" alt="alphaking"></div>
			<div class="slide"><img src="<?php echo IMAGE_URL.'/landing-page/test.png'; ?>" alt="alphaking"></div>
		</div>
		<div class="slide-item" id="slider-nav-banner">
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/test.png'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/test.png'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/test.png'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/test.png'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/test.png'; ?>);"></div>
		</div>
	</div>
	<div class="content">
		<div class="background" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/test.png'; ?>);"></div>
		<div class="decor-content"></div>
		<div class="title">
			<p>HOẠT ĐỘNG tháng 6</p> 
			<p>Nụ cười bé thơ </p>
		</div>
		<div class="desc">
			<p>Vòng tay ấm chở che, nụ cười rạng rỡ và tương lai tươi sáng.</p>
			<p>Với mong muốn mang tới nhiều yêu thương hơn để các trẻ em mồ côi hạnh phúc trọn vẹn trong ngày Lễ Thiếu nhi 1/6 sắp tới, Alpha King trân trọng giới thiệu tới các Bạn - những Khách Hàng trân quý chương trình thiện nguyện tháng 6: "Nụ cười bé thơ".</p>
			<p>Thông tin chi tiết về <br/> Làng Trẻ Em SOS Việt Nam <br/><a href="#">https://sosvietnam.org/</a></p>
		</div>
	</div>
	<div class="form">
		<form method="post" action="" class="form-contact">
			<div class="form-field-all">
				<div class="form-group">
					<label for="contact_name">Họ & tên <span>(*thông tin bắt buộc*)</span></label>
					<input type="text" class="form-control" id="contact_name" name="contact_name" value="">
				</div>
				<div class="form-group">
					<label for="contact_phone">Điện thoại</label>
					<input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="">
					<p>*Chỉ dành cho khách hàng có đặt chỗ booking*</p>
				</div>
				<div class="form-group">
					<button type="button" class="btn-submit">Gửi đi</button>
				</div>
			</div>
		</form>
	</div>
</main>
<div class="wheel-of-fortune">
	<div class="popup" style="display: none;">
		<?php include_once (TEMPLATE_PATH.'/assets/images/landing-page/grade_1.svg'); ?>
		<?php include_once (TEMPLATE_PATH.'/assets/images/landing-page/grade_2.svg'); ?>
		<?php include_once (TEMPLATE_PATH.'/assets/images/landing-page/grade_3.svg'); ?>
		<div class="button-action" id="button-action">Quay may mắn</div>
	</div>
	<div class="popup-confirm">
		<div class="content">
			<div class="left">
				<div class="img"><img src="<?php echo IMAGE_URL.'/landing-page/test.png'; ?>" alt="alphaking"></div>
				<div class="title">Hoạt động tháng 6<br/> nụ cười bé thơ</div>
			</div>
			<div class="right">
				<div class="tag">#ShareWithHeart</div>
				<div class="thankyou">Cảm ơn Quý Khách Hàng đã đồng hành cùng Alpha King trao tặng yêu thương & tạo nên những nghĩa cử lớn lao.</div>
				<div class="name">Nguyễn Bảo Ngọc</div>
				<div class="prize">10 Triệu</div>
			</div>
		</div>
		<div class="button">
			<div class="btn-confirm">Xác nhận</div>
			<a href="#" class="btn-share">Chia sẻ</a>
		</div>
	</div>
</div>
<div class="overlay"></div>
<script> 
	jQuery(document).ready(function($) {
		//js css decor:
		var width_content = $('body').width();
		$('.decor-name, .decor-content').css('border-left-width' , width_content);

		//js slide banner:
		$('#slider-for-banner').slick({
			slidesToShow: 1,
			dots:false,
			infinite: false,
			adaptiveHeight: true,
			asNavFor: '#slider-nav-banner',
		});
		$('#slider-nav-banner').slick({
			slidesToShow: 4,
			dots:false,
			infinite: false,
			adaptiveHeight: true,
			focusOnSelect: true,
			asNavFor: '#slider-for-banner',
		});

		//js hiển thị popup:
		$('button').click(function(event){
			$('.wheel-of-fortune, .overlay').fadeIn();
		});

		$('.overlay').click(function(event){
			$('.wheel-of-fortune, .overlay').fadeOut();
		});

		//js quay giải thưởng
		var wheel = document.querySelector("#grade_1"),
		button = document.querySelector("#button-action"),
		rando = 0;
		var spin_wheel = function () {
			rando += (Math.random() * 360) + 2880;
			wheel.style.webkitTransform = "rotate(" + rando + "deg)";
			wheel.style.mozTransform = "rotate(" + rando + "deg)";
			wheel.style.msTransform = "rotate(" + rando + "deg)";
			wheel.style.transform = "rotate(" + rando + "deg)";
		}
		button.addEventListener("click", spin_wheel, false);

	});  
</script> 
<?php get_footer(); ?>