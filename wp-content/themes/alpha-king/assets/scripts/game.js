var game;
var canSpin;
var slices = 16;
var slicePrizes = ["100.00", "200.000", "300.000", "400.000", "500.000", "600.000", "700.000", "800.000", "900.000", "1.000.000", "1.100.000", "1.200.000", "1.300.000", "1.400.000", "1.500.000", "1.600.000"];
var prize;
var timer = 15000;
var inner;
var prizeText;
var that;

window.onload = function() {
    game = new Phaser.Game(500, 500, Phaser.CANVAS, 'gameDiv');

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
        this.game.stage.backgroundColor = '#141414';

        prizeText = game.add.text(game.world.centerX, 400, "");
        prizeText.anchor.set(0.5);
        prizeText.align = "center";
    },
    spin(lat,lng,value) {
        if ( canSpin ) {

            var rounds = game.rnd.between(15,16);

            var degress = game.rnd.between(lat, lng);

            var prize = slices - 1 - Math.floor(degress / (360 / slices));

            canSpin = false;

            var spinTween = game.add.tween(inner).to({
                angle: 360 * rounds + degress + 90

            }, timer, Phaser.Easing.Quadratic.Out, true);
            spinTween.onComplete.add(this.winPrize(value), this);

        }
    },
    winPrize(value) {
        // Xử lý sau khi quay xong
        // prizeText.text = value;
    }
}
