$(document).ready(function () {
    var bp = $('#bigpic');
    if (bp.css("display") == "block") {
        var showing = 0;
        var bigPicWidth = bp.width();
        var bigPicHeight = bigPicWidth / 3;
        bp.css('height', bigPicHeight + 'px');
        $('header').css('height', (bigPicHeight + 75) + 'px');
        var pics = $('#bigpic .bigpic');
        bp.data('max', pics.length);
        pics.each(function (i, b) {
            var bigpic = $(b);
            var img = bigpic.find('img:first');
            var imgHeight = parseInt(bigpic.data('height'), 10);
            var imgWidth = parseInt(bigpic.data('width'), 10);
            var imgOffset = parseInt(bigpic.data('offset'), 10);
            var scale = bigPicWidth / imgWidth;
            var pos = (bigPicHeight - ((imgHeight - imgOffset) * scale)) / 2;
            img.css('top', Math.max(-((imgHeight * scale) / 2), Math.min(pos, 0)));
        });

        var next = $(bp.find('.nav-right:first'));
        var prev = $(bp.find('.nav-left:first'));
        if (pics.length > 0) {
            next.removeClass('hidden');
            prev.removeClass('hidden');
        }
        var goDir = function (dir) {
            $(pics[showing]).hide();
            showing = (showing + dir) % pics.length;
            if (showing < 0) showing = pics.length + showing;
            $(pics[showing]).show();
        }
        var goNext = function () {
            goDir(1);
        }
        var t;
        var startTimer = function () {
            t = window.setInterval(goNext, 7000);
        }
        var resetTimer = function () {
            window.clearInterval(t);
            startTimer();
        }
        next.click(function (ev) {
            resetTimer();
            goDir(1);
        });
        prev.click(function (ev) {
            resetTimer();
            goDir(-1);
        });
        startTimer();
    }

    // Buchung
    $('table.calendar').each(function (i, t) {
        var table = $(t);
        var input = $(table.data('target'));
        if (!input) return;
        table.find('td').click(function (ev) {
            var el = $(ev.target).parent('td');
            if (!el.hasClass('free') && !el.hasClass('busy')) return;
            input.attr('value', el.data('date'));
        });
    });

    // Menu
    if (!$(document.body).hasClass('page-template-page-compact-php')) {
	    var mainmenu = $('header nav');
	    mainmenu.find('ul:first').prepend('<li class="onscroll"><a href="#top" class="dim"><i class="icon-arrow-up"></i> Nach oben</a></li>');
	    var vcard = $('#vcard');
	    var vcardBottom = vcard.height();
	    var posTimer;
	    var newpos;
	    var updateMenu = function (timer) {
		window.clearTimeout(timer);
		// mainmenu.css('top', newpos);
		mainmenu.animate({'top':newpos});
	    };
	    $(window).scroll(function (ev) {
		var scrollTop = $(ev.target).scrollTop();
		mainmenu.toggleClass('scroll', scrollTop > 100);
		newpos = Math.max(scrollTop, scrollTop + vcardBottom - scrollTop);
		if (posTimer) window.clearTimeout(posTimer);
		posTimer = window.setTimeout(updateMenu, 250);
	    });
    }
