<!doctype html>
<html>
<head>

<style type="text/css">
    html {
        height: 100%;
    }

    body {
        background: url(http://u.jimdo.com/www29/o/se01f125b569cd747/userlayout/img/default2.jpg?t=1336731342) no-repeat center;
        background-size: cover;
        cursor: crosshair;
        height: 100%;
        margin: 0;
        overflow: hidden;
        padding: 0;
    }

    #light {
        background: url(bigflashlight.png) no-repeat 0 -200px;
        background-size: 100% 100%;
        left: 50%;
        height: 4000px;
        margin: -2000px 0 0 -2000px;
        position: absolute;
        top: 50%;
        width: 4000px;
    }

    #overlay {
        background: #000;
        height: 100%;
        position: absolute;
        width: 100%;
    }
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
    $(function() {
        var $window = $(window),
            $overlay = $('#overlay'),
            $light = $('#light'),
            $player = $('#player'),

            moveMap = {
                37: [-1, 0],
                38: [0, -1],
                39: [1, 0],
                40: [0, 1]
            },
            movement = {left: 0, top: 0},
            pressed = {},
            speed = 32,

            mousePos,
            playerPos,
            delta,
            angle,
            winSize;

        (function init() {
            getWindowSize();
            playerPos = {left: winSize.x / 2, top: winSize.y / 2};
            setPlayerPos();

            $overlay.fadeOut(3000);

            $window.mousemove(function(e) {
                mousePos = {
                    x: e.pageX,
                    y: e.pageY
                };

                delta = {
                    x: mousePos.x - playerPos.left,
                    y: mousePos.y - playerPos.top
                };

                angle = Math.atan2(delta.y, delta.x) * 180 / Math.PI + 90;

                $light.css({
                    '-webkit-transform': 'rotate(' + angle + 'deg)'
                });
            });

            $window.keydown(function(e) {
                if (moveMap[e.which] && !pressed[e.which]) {
                    pressed[e.which] = true;
                }
            });

            $window.keyup(function(e) {
                if (moveMap[e.which] && pressed[e.which]) {
                    delete pressed[e.which];
                }
            });

            $window.resize(getWindowSize);

            (function frame() {
                movement = {left: 0, top: 0};

                $.each(pressed, function(key) {
                    movement.left = moveMap[key][0] ? moveMap[key][0] * speed : movement.left;
                    movement.top = moveMap[key][1] ? moveMap[key][1] * speed : movement.top;
                });

                playerPos.left += movement.left;
                playerPos.top += movement.top;

                setPlayerPos();

                setTimeout(frame, 20);
            })();
        })();

        function setPlayerPos() {
            $player.css({
                left: playerPos.left,
                top: playerPos.top
            });

            $light.css({
                marginLeft: '+=' + movement.left,
                marginTop: '+=' + movement.top
            });
        }

        function getWindowSize() {
            winSize = {x: $window.width(), y: $window.height()};
        }
    });
</script>

</head>
<body>
<div id="player"></div>
<div id="light"></div>

<div id="overlay"></div>
</body>
</html>
