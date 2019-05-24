var game;

var canSpin;
var slices = 16;
var slicePrizes = ["100.00", "200.000", "300.000", "400.000", "500.000", "600.000", "700.000", "800.000", "900.000", "1.000.000", "1.100.000", "1.200.000", "1.300.000", "1.400.000", "1.500.000", "1.600.000"];
var prize;
var timer = 5500;
var inner;
var prizeText;
var that;

window.onload = function() {

    game = new Phaser.Game(500, 500, Phaser.Auto, "wheel", null, true);

    game.state.add("PlayGame", playGame);
    game.state.start("PlayGame");
}

//Play State

var playGame = function (game) {

};

playGame.prototype = {
    preload: function () {
        game.load.image("inner", "wp-content/themes/alpha-king/assets/scripts/game/inner-mob.png");
        game.load.image("outer", "wp-content/themes/alpha-king/assets/scripts/game/outer-mob.png");
    },
    create:function () {
        that = this;
        inner = game.add.sprite(game.width/2, game.height/2, "inner");
        inner.anchor.set(0.5);
        var outer = game.add.sprite(game.width/2, game.height/2, "outer");
        outer.anchor.set(0.5);

        //hiển thị quà tặng
        prizeText = game.add.text(game.world.centerX, 400, "");
        prizeText.anchor.set(0.5);
        prizeText.align = "center";
    },
    spin(lat,lng,value) {
        if ( canSpin ) {

            var rounds = game.rnd.between(1,16);
            //số vòng quay random trong khoảng từ 10 đến 16
            var degress = game.rnd.between(lat, lng);
            //và dừng lại ở điểm random nằm trong khoảng lat và lng

            var prize = slices - 1 - Math.floor(degress / (360 / slices));
            //trước khi wheel dừng lại tính vị trí sẽ dừng

            canSpin = false;
            //Trong khi đang quay ko được bấm tiếp

            var spinTween = game.add.tween(inner).to({
                angle: 360 * rounds + degress + 90
                // angle: 360 * rounds + degress + 90

            }, timer, Phaser.Easing.Quadratic.Out, true);
            spinTween.onComplete.add(this.winPrize(value), this);

        }

    },
    winPrize(value) {
        // Xử lý sau khi quay xong
        prizeText.text = value;
    }
}

function start(e) {
    canSpin = true;
    //xử lý ajax gọi server để lấy lat, lng, value
    /*$.ajax({
        url: "",
        type: 'post',
        dataType: 'json',
        data: {
            nonce: "",
            action: "load_more_item_ajax"
        },
        beforeSend: function () {
            console.log('Đang xử lý ...');
        },
        complete: function () {
            console.log('Xử lý ok');
        }
    })


    .done(function(response) {
        console.log(response);
        if (response) {
            self.spin(response.lat, response.lng, response.value)
            console.log('success');
        }
        return false;
    })
    .fail(function() {
        console.log('failed');
    });*/

    that.spin(13, 32, 600);
    /*
    * -11 - 11: 2 lọ
    * 13 - 32: 10 lọ
    * 35 - 55: 1 lọ
    * 57 - 78: 5 lọ
    * 79 - 101 2 lọ
    * 102 - 123 8 lọ
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