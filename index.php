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
        cursor: none;
        height: 100%;
        margin: 0;
        overflow: hidden;
        padding: 0;
    }

    #light {
        background: url(light.png) no-repeat center;
        background-size: cover;
        left: 50%;
        height: 200px;
        margin: -100px 0 0 -100px;
        position: absolute;
        top: 50%;
        width: 200px;
    }

    #left, #right, #top, #bottom, #overlay {
        background: #000;
        height: 100%;
        position: absolute;
        width: 100%;
    }

    #left {
        left: 0;
        top: 0;
    }

    #right {
        right: 0;
        top: 0;
    }

    #top {
        left: 0;
        top: 0;
    }

    #bottom {
        left: 0;
        bottom: 0;
    }
</style>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
    $(function() {
        var $window = $(window),
            $overlay = $('#overlay'),
            $light = $('#light'),
            $left = $('#left'),
            $right = $('#right'),
            $top = $('#top'),
            $bottom = $('#bottom'),

            lightSize = 200,
            mousePos,
            winSize;

        (function init() {
            getWindowSize();
            mousePos = {x: winSize.x / 2, y: winSize.y / 2};
            positionDarkness();

            $overlay.fadeOut(3000);

            $window.mousemove(function(e) {
                mousePos = {
                    x: e.pageX,
                    y: e.pageY
                };

                $light.css({
                    left: mousePos.x,
                    top: mousePos.y
                });

                positionDarkness();
            });

            $window.click(function() {
                resizeLight(lightSize + 50, {duration: 200});
            });

            $window.resize(getWindowSize);
        })();

        function positionDarkness() {
            var offset = lightSize / 2 - 5;

            $left.css('width', mousePos.x - offset > 0 ? mousePos.x - offset : 0);
            $right.css('width', winSize.x - mousePos.x - offset > 0 ? winSize.x - mousePos.x - offset : 0);
            $top.css('height', mousePos.y - offset > 0 ? mousePos.y - offset : 0);
            $bottom.css('height', winSize.y - mousePos.y - offset > 0 ? winSize.y - mousePos.y - offset : 0);
        }

        function resizeLight(size, opts) {
            var defaults = {
                    duration: 2000,
                    step: function() {
                        lightSize = $light.width();
                        positionDarkness();
                    }
                },
                s;

            s = $.extend(true, defaults, opts);

            $light.animate({
                height: size,
                marginLeft: -size / 2,
                marginTop: -size / 2,
                width: size,
                opacity: s.reveal ? 0 : 1
            }, s);

            if (s.reveal) {
                $left.add($right).add($top).add($bottom).fadeOut(s.duration);
            }
        }

        function reveal() {
            resizeLight(winSize.x * 2, {reveal: true});
        }

        function getWindowSize() {
            winSize = {x: $window.width(), y: $window.height()};
        }
    });
</script>

</head>
<body>
<div id="left"></div>
<div id="right"></div>
<div id="top"></div>
<div id="bottom"></div>

<div id="light"></div>

<div id="overlay"></div>
</body>
</html>
