<?php
get_header();
$contact = tu_get_contact_with_pagination(1, -1);
?>
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
                    <div class="form-group-msg" id="name_msg" style="color: #f00; padding-top: 5px"></div>
                </div>
				<div class="form-group">
					<label for="contact_phone">Điện thoại</label>
					<input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="">
                    <div class="form-group-msg" id="phone_msg" style="color: #f00; padding-top: 5px"></div>
                    <p>*Chỉ dành cho khách hàng có đặt chỗ booking*</p>
				</div>
				<div class="form-group">
					<button type="button" id="form_submit" class="btn-submit">Gửi đi</button>
				</div>
			</div>
		</form>
	</div>
      <?php if (isset($contact) && $contact) : ?>
        <div class="contribution-list"  >
            <div class="title">Danh sách đóng góp</div>
            <div class="list">
                <div class="fm">
                    <div class="head">
                        <p>Họ và tên</p>
                        <p>Số tiền</p>
                    </div>
                    <div class="contribution-content" id="contribution-content">
                          <?php while ($contact->have_posts()) : $contact->the_post();
                            $post_id = get_the_ID();
                            $game_prize = get_post_meta($post_id, 'game_prize', true);
                            $full_name = get_post_meta($post_id, 'contact_name', true);

                            ?>
                              <div class="item">
                                  <p><?= $full_name ?></p>
                                  <p><?= $game_prize ?></p>
                              </div>
                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
      <?php endif; ?>

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
                <div class="name">
                    <p>Cám ơn khách hàng</p>
                    <p id="player"></p>
                </div>
				<div class="thankyou">đã đồng hành cùng Alpha King<br/> trao tặng yêu thương & tạo nên những<br/> nghĩa cử lớn lao.</div>

				<div class="prize" id="prize_text"></div>
			</div>
		</div>
		<div class="button">
<!--			<div class="btn-confirm">Xác nhận</div>-->
			<a href="<?php echo HOME_URL; ?>" class="btn-share">Xác nhận</a>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo HOME_URL; ?>" class="btn-share">Chia sẻ</a>
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

        var nav_slide = ($('#slider-nav-banner .slide:nth-of-type(1)').width() - 30) / 4;
        $('#slider-nav-banner .slide').css('height' , nav_slide);

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
        /*$('button').click(function(event){
            $('.wheel-of-fortune, .overlay').fadeIn();
        });*/

        /*	$('.overlay').click(function(event){
                $('.wheel-of-fortune, .overlay').fadeOut();
            });*/

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
            var re = /^0[0-9]{3}[0-9]{3}[0-9]{3}$/ ;
            return re.test(String(number));
        }
        var formButton = $('#form_submit');
        var name_msg = $('body').find('#name_msg');
        var phone_msg = $('body').find('#phone_msg');

        var check_boolean_phone = true;

        $('#contact_phone').change(function (event) {
            var phone_text = $(this).val();
            var count_number = phone_text.length;

            if ( !validatePhonenumber(phone_text) && phone_text || count_number > 11 ) {
                phone_msg.text('Số điện thoại không hợp lệ!');
                formButton.css("cursor", "not-allowed");
                formButton.prop('disabled', true);
                check_boolean_phone = false;
            } else {
                phone_msg.text('');
                formButton.css("cursor", "pointer");
                formButton.prop('disabled', false);
                check_boolean_phone = true;
            }
        });

        $('#contact_name').keyup(function (event) {
            name_msg.text('');
            formButton.css("cursor", "pointer");
            formButton.prop('disabled', false);
        });

        $('#contact_phone').keyup(function (event) {
            phone_msg.text('');
            formButton.css("cursor", "pointer");
            formButton.prop('disabled', false);
        });

        $('#form_submit').click(function (event) {
            event.preventDefault();

            var form = $(this);
            let contactNameValue = $('#contact_name').val();
            let contactPhoneValue = $('#contact_phone').val();


            if ( !contactNameValue || contactNameValue === '' || contactNameValue === null ) {
                name_msg.text('Vui lòng điền họ tên! ');
                formButton.css("cursor", "not-allowed");
                formButton.prop('disabled', true);
            }
            if ( contactNameValue && !contactPhoneValue  ) {
                $('.wheel-of-fortune, .overlay').fadeIn();
            }

            if ( contactNameValue && contactPhoneValue && check_boolean_phone ) {
                jQuery.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        nonce: "<?php echo wp_create_nonce('check_is_exist_phone_number_nonce') ?>",
                        action: "check_is_exist_phone_number_ajax",
                        player_phone: contactPhoneValue ? contactPhoneValue : ''
                    },
                    success: function (response) {
                        if ( response.success === true ) {
                            $('.wheel-of-fortune, .overlay').fadeIn();
                        } else {
                            phone_msg.text('Liên hệ này đã đăng ký. Vui lòng thử lại!');
                            formButton.css("cursor", "not-allowed");
                            formButton.prop('disabled', true);
                            check_boolean_phone = false;
                        }
                    },
                    error: function () {
                        console.log('Error to check phone number exist');
                    }

                });
            }
        });
    });

    var isClickSpin = true;

    function start(e) {
        canSpin = true;
        //xử lý ajax gọi server để lấy lat, lng, value

        if (isClickSpin === true) {
            isClickSpin = false;
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            var contactNameValue = document.getElementById("contact_name").value;
            var contactPhoneValue = document.getElementById("contact_phone").value;
            // var formButton = ;

            jQuery.ajax({
                url: ajaxurl,
                type: 'post',
                dataType: 'json',
                data: {
                    nonce: "<?php echo wp_create_nonce('game_call_get_prize_nonce') ?>",
                    action: "game_call_get_prize_ajax",
                    player_phone: contactPhoneValue ? contactPhoneValue : ''
                },
                success: function(response) {
                    if (response) {
                        let code = parseInt(response.code);
                        let lat = '';
                        let lng = '';
                        let textPrize = '';

                        if ( code === 10 ) {
                            lat = 14;
                            lng = 30;
                            textPrize = '10 lọ (5 triệu)';
                        } else if ( code === 2 ) {
                            lat = 126;
                            lng = 145;
                            textPrize = '2 lọ (1 triệu)';
                        } else if ( code === 5 ) {
                            lat = 58;
                            lng = 76;
                            textPrize = '5 lọ (2.5 triệu)';
                        } else if ( code === 8 ) {
                            lat = 105;
                            lng = 123;
                            textPrize = '8 lọ (4 triệu)';
                        } else {
                            lat = 172;
                            lng = 189;
                            textPrize = '1 lọ (500 nghìn)';
                        }
                        document.getElementById("prize_text").innerHTML = textPrize;
                        document.getElementById("player").innerHTML = contactNameValue;

                        jQuery.ajax({
                            url: ajaxurl,
                            type: 'post',
                            dataType: 'json',
                            data: {
                                nonce: "<?php echo wp_create_nonce('call_post_info_player_nonce') ?>",
                                action: "call_post_info_player_ajax",
                                contact_name: contactNameValue,
                                contact_phone: contactPhoneValue,
                                game_prize: textPrize
                            },
                            success: function (dataRecieve) {
                            },
                            error: function () {
                                console.log('Request save data fail')
                            }
                        });

                        setTimeout(function(){
                            jQuery('.wheel-of-fortune').find('.popup').hide();
                            jQuery('.wheel-of-fortune').find('.popup-confirm').show();
                        }, 15000);

                        that.spin(lat, lng, 10);

                    }
                    return false;
                },
                error: function() {
                    // When AJAX call has failed
                    console.log('AJAX call failed.');
                },
            })
        }
    }
</script>

<?php get_footer(); ?>
