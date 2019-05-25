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
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/banner.png'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-2.jpeg'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-3.jpg'; ?>);"></div>
            <div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-4.jpg'; ?>);"></div>
            <div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-6.jpeg'; ?>);"></div>
        </div>
		<div class="slide-item" id="slider-nav-banner">
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/banner.png'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-2.jpeg'; ?>);"></div>
			<div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-3.jpg'; ?>);"></div>
            <div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-4.jpg'; ?>);"></div>
            <div class="slide" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/img-6.jpeg'; ?>);"></div>
        </div>
	</div>
	<div class="content">
		<div class="background" style="background-image: url(<?php echo IMAGE_URL.'/landing-page/screen-2.jpg'; ?>);"></div>
		<div class="decor-content"></div>
		<div class="decor-bottom"></div>
		<div class="title">
			<p>HOẠT ĐỘNG tháng 6</p> 
			<p>Nụ cười bé thơ </p>
		</div>
		<div class="desc">
			<p>Vòng tay ấm chở che, nụ cười rạng rỡ và tương lai tươi sáng.</p>
			<p>Với mong muốn mang tới nhiều yêu thương hơn để các trẻ em mồ côi hạnh phúc trọn vẹn trong ngày Lễ Thiếu nhi 1/6 sắp tới, Alpha King trân trọng giới thiệu tới các Bạn - những Khách Hàng trân quý chương trình thiện nguyện tháng 6: "Nụ cười bé thơ".</p>
			<p>Thông tin chi tiết về <br/> Làng Trẻ Em SOS Việt Nam <br/><a href="https://sosvietnam.org/" target="_blank">https://sosvietnam.org/</a></p>
		</div>
	</div>
	<div class="form">
		<div class="decor-form"></div>
		<form method="post" action="" class="form-contact">
			<div class="form-field-all">
				<div class="form-group">
					<label for="contact_name">Họ & tên <span>(*thông tin bắt buộc*)</span></label>
					<input type="text" class="form-control" id="contact_name" name="contact_name" value="">
				</div>
				<div class="form-group">
					<label for="contact_phone">Điện thoại</label>
					<input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="">
					<div class="form-group-msg" id="phone_msg"></div>
					<p>*Chỉ dành cho khách hàng có đặt chỗ booking*</p>
				</div>
				<div class="form-group">
					<button type="button" id="form_submit" class="btn-submit">Gửi đi</button>
				</div>
			</div>
		</form>
	</div>
	<div class="contribution-list"  >
		<div class="title">Danh sách đóng góp</div>
		<div class="list">
			<div class="fm">
				<div class="head">
					<p>Họ và tên</p>
					<p>Số tiền</p>
				</div>
				<div class="contribution-content" id="contribution-content">
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
					<div class="item">
						<p>Hoàng Quỳnh Nga</p>
						<p>500.000 VND</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright">© 2019 Alpha King. All Right Reserved</div>
</main>
<div class="wheel-of-fortune">
    <div class="popup">
		<div id="gameDiv"></div>
		<div class="button-action" id="button-action" onclick="start()">Đóng góp</div>
	</div>
	<div class="popup-confirm" style="display: none">
		<div class="content">
			<div class="img"><img src="<?php echo IMAGE_URL.'/landing-page/confirm.png'; ?>"></div>
			<div class="_fm">
				<div class="title">Hoạt động tháng 6<br/> nụ cười bé thơ</div>
				<div class="tag">#ShareWithHeart</div>
				<div class="thankyou">Cảm ơn Quý Khách Hàng đã đồng hành<br/> cùng Alpha King trao tặng yêu thương<br/> & tạo nên những nghĩa cử lớn lao.</div>

				<div class="name">
					<p>Cám ơn khách hàng</p>
					<p>Nguyễn Bảo Ngọc</p>
				</div>
				<div class="prize">8 lọ (4 triệu)</div>
			</div>
		</div>
		<div class="button">
<!--			<div class="btn-confirm">Xác nhận</div>-->
			<a href="<?php echo HOME_URL; ?>" class="btn-share">Xác nhận</a>
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
		$('.decor-bottom').css('border-right-width' , (width_content*70)/100);

		//js slide banner:
		$('#slider-for-banner').slick({
			swipeToSlide: false,
      touchMove: false,
      pauseOnHover: true,
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

		//js scrollbar:
		$('#contribution-content').mCustomScrollbar();

		//js quay giải thưởng
		/*var wheel = document.querySelector("#grade_1"),
		button = document.querySelector("#button-action"),
		rando = 0;
		var spin_wheel = function () {
			rando += (Math.random() * 360) + 2880;
			wheel.style.webkitTransform = "rotate(" + rando + "deg)";
			wheel.style.mozTransform = "rotate(" + rando + "deg)";
			wheel.style.msTransform = "rotate(" + rando + "deg)";
			wheel.style.transform = "rotate(" + rando + "deg)";
		}
		button.addEventListener("click", spin_wheel, false);*/


		function validatePhonenumber(number) {
			var re = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/ ;
			return re.test(String(number));
		}
		var formButton = $('#form_submit').find('button');
		var phone_msg = $('body').find('#phone_msg');


		$('#contact_phone').change(function (event) {
			var phone_text = $(this).val();
			var count_number = phone_text.length;

			if ( !validatePhonenumber(phone_text) && phone_text || count_number > 11 ) {
				phone_msg.text('Số điện thoại không hợp lệ !');
				formButton.css("cursor", "not-allowed");
				formButton.prop('disabled', true);
			} else {
				phone_msg.text('');
				formButton.css("cursor", "pointer");
				formButton.prop('disabled', false);
			}
		});

		formButton.submit(function (event) {
			event.preventDefault();

			var form = $(this);
			let contactNameValue = $('#contact_name').val();

			if ( !contactNameValue || contactNameValue === '' || contactNameValue === null ) {
				phone_msg.text('Vui họ tên !');
				formButton.css("cursor", "not-allowed");
				formButton.prop('disabled', true);
				return
			}

		});


	});

	function start(e) {
		canSpin = true;
		var objectSuccess = {};
        //xử lý ajax gọi server để lấy lat, lng, value

        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

        jQuery.ajax({
        	url: ajaxurl,
        	type: 'post',
        	dataType: 'json',
        	data: {
        		nonce: "<?php echo wp_create_nonce('game_call_get_prize_nonce') ?>",
        		action: "game_call_get_prize_ajax"
        	},
        	beforeSend: function () {
        		console.log('Đang xử lý ...');
        	},
        	complete: function () {
        		console.log('Xử lý ok');
        	}
        })


        .done(function(response) {
        	if (response) {
        	    objectSuccess = response;
                console.log(response.lat, response.lng, response.code, 'response.lat, response.lng, response.code');
                setTimeout(function ($) {
                    jQuery('.wheel-of-fortune').find('.popup').hide();
                    jQuery('.wheel-of-fortune').find('.popup-confirm').show();
                }, 15000);

                // self.spin(response.lat, response.lng, response.value)
            }
                return false;
            })
        .fail(function() {
        	console.log('failed');
        });


        that.spin(13, 32, 600);



        /*
        * -11 - 11: 2 lọ
        * 13 - 32: 10 lọ
        * 35 - 55: 1 lọ
        * 57 - 78: 5 lọ
        * 79 - 101 2 lọ
        * 105 - 123 8 lọ
        * 124 - 146 2 lọ
        * 147 - 168 5 lọ
        * 173 - 191 1 lọ
        * 193 - 212 2 lọ
        * 214 - 234 1 lọ
        * 238 - 258 5 lọ
        * 260 - 279 1 lọ
        * 281 - 301 2 lọ
        * 304 - 323 1 lọ
        * 325 - 345 1 lọ
        * */

    }
</script> 
<?php get_footer(); ?>