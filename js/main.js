$(function() {
    var $window = $(window),
        $body = $('body'),
        $overlay = $('#overlay'),
        $input = $('input', $overlay),
        $light = $('#light'),
        $left = $('#left'),
        $right = $('#right'),
        $top = $('#top'),
        $bottom = $('#bottom'),
        $timer = $('#timer'),
        $end = $('#end'),

        puzzles = ['PAPAGEI', 'APFEL', 'NILPFERD', 'ZIEGE', 'EI', 'RUCKSACK', 'FLUGZEUG', 'AFFE', 'HOSE', 'ROSE', 'TENNISBALL'],

        lightSize,
        mousePos,
        winSize,
        timer,
        currentPuzzle = 0,
        clickBlock = false;

    (function init() {
        getWindowSize();
        mousePos = {x: winSize.x / 2, y: winSize.y / 2};
        positionDarkness();
        timer = $.timer($timer, {
            seconds: 0,
            step: 1
        });

        nextPuzzle();

        $window
            .mousemove(function(e) {
                mousePos = {
                    x: e.pageX,
                    y: e.pageY
                };

                $light.css({
                    left: mousePos.x,
                    top: mousePos.y
                });

                positionDarkness();
            })
            .click(function() {
                if (clickBlock) {
                    return;
                }

                clickBlock = true;

                $overlay.show();
                $input.show();

                $input
                    .focus()
                    .keypress(function(e) {
                        if (e.which !== 13) {
                            return;
                        }

                        $overlay.hide();
                        $input.hide();

                        if ($input.val().toUpperCase() === puzzles[currentPuzzle]) {
                            timer.stop();
                            $light.stop();
                            reveal();

                            setTimeout(function() {
                                $overlay.fadeIn(1000, function() {
                                    currentPuzzle++;
                                    nextPuzzle();
                                });
                            }, 3000);
                        } else {
                            clickBlock = false;
                        }

                        $input.val('');
                    });
            })
            .resize(getWindowSize);
    })();

    function positionDarkness() {
        var offset = lightSize / 2 - 1;

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
                },
                complete: function() {
                    if (opts.reveal) {
                        $light.fadeOut(500);
                    }
                }
            },
            s;

        s = $.extend(true, defaults, opts);

        $light.animate({
            height: size,
            marginLeft: -size / 2,
            marginTop: -size / 2,
            width: size
        }, s);
    }

    function reveal() {
        resizeLight(winSize.x * 2, {reveal: true});
    }

    function nextPuzzle() {
        if (currentPuzzle === puzzles.length) {
            done();
            return;
        }

        $overlay.hide();

        clickBlock = false;
        lightSize = 5;

        $light.css({
            height: lightSize,
            marginLeft: -lightSize / 2,
            marginTop: -lightSize / 2,
            width: lightSize
        }).show();

        positionDarkness();

        $body.css('background-image', 'url(pics/' + (currentPuzzle + 1) + '.jpg)');

        resizeLight(winSize.x * 2, {duration: 120000});

        timer.resume();
    }

    function done() {
        $('span', $end).text($timer.text());
        $end.fadeIn(2000);
    }

    function getWindowSize() {
        winSize = {x: $window.width(), y: $window.height()};
    }
});
