$(document).ready(function () {
    var showing = 0;
    var bigPicWidth = $('#bigpic').width();
    var bigPicHeight = bigPicWidth / 3;
    var bp = $('#bigpic');
    bp.css('height', bigPicHeight + 'px');
    var pics = $('#bigpic .bigpic');
    bp.data('max', pics.length);
    pics.each(function(i,b) {
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
    var goDir = function(dir)
    {
      $(pics[showing]).hide();
      showing = (showing + dir) % pics.length;
      if (showing < 0) showing = pics.length + showing;
      $(pics[showing]).show();
    }
    var goNext = function() {
      goDir(1);
    }
    var t;
    var startTimer = function() {
       t = window.setInterval(goNext, 7000);
    }
    var resetTimer = function()
    {
      window.clearInterval(t);
      startTimer();
    }
    next.click(function(ev) {
      resetTimer();
      goDir(1);
    });
    prev.click(function(ev) {
      resetTimer();
      goDir(-1);
    });
    startTimer();
});