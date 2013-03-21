$(function() {
    var defaults = {
            step: -1,
            dangerZone: 5,
            seconds: 60,
            timeOver: $.noop
        },

        $timer,

        s,
        remainingSeconds,
        stopTime;

    $.timer = function($elem, opts) {
        (function init() {
            s = $.extend({}, defaults, opts);

            remainingSeconds = s.seconds;
            $timer = $elem.addClass();

            displayTime();
        })();

        this.start = function() {
            stopTime = false;
            remainingSeconds = s.seconds;
            step();
        };

        this.stop = function() {
            stopTime = true;
        };

        this.resume = function() {
            if (!stopTime) {
                this.start();
                return;
            }

            stopTime = false;
            setTimeout(step, 1000);
        };

        return this;
    };

    function step() {
        if (stopTime) {
            return;
        }

        displayTime();

        if (remainingSeconds === 0 && s.step < 0) {
            s.timeOver && s.timeOver();
        } else {
            remainingSeconds += s.step;

            setTimeout(step, 1000);
        }
    }

    function displayTime() {
        var minutes = Math.floor(remainingSeconds / 60) + '',
            seconds = (remainingSeconds % 60) + '';

        while (minutes.length < 2) {
            minutes = '0' + minutes;
        }

        while (seconds.length < 2) {
            seconds = '0' + seconds;
        }

        if (remainingSeconds === s.dangerZone && s.step < 0) {
            $timer.css({color: '#f00'});
        }

        $timer.text(minutes + ':' + seconds);
    }
});
