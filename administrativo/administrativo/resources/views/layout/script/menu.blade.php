<script>
  $(document).ready(function() {
    navNumbers();
    backToDefault();

    // show hovered li stuff
    $('.main-menu').on('mouseover', 'li', function() {
      showTarget($(this));
    });

    // show default .active li stuff
    $('.main-menu').on('mouseleave', backToDefault);
    
    // change active list item
    $('.main-menu').on('click', 'li', function() {
      changeActive($(this));
    });
    
    // toggle menu
    $('.toggle').on('click', toggleMenu);
    
    // for showcase only
    var tl = new TimelineMax(),
        body = $('body'),
        header = $('header'),
        content = $('.content p'),
        toggle = $('.toggle'),
        nav = $('nav');
    
    tl.to(body, 1, {
      padding: '0 5% 0px',
      delay: .5
    });
    
    tl.to(header, .25, {
      opacity: 1,
      delay: .5
    });
    
    tl.to(content, .25, {
      opacity: 1
    }, '-=.25');
    
    tl.call(function() {
      toggleMenu();
    }, null, null, 2);
    /*
    tl.call(function() {
      toggleMenu();
    }, null, null, 4.5);*/
  });

  // toggle menu
  function toggleMenu() {
    var toggle = $('.toggle');
    var nav = $('nav');
    
    if(toggle.hasClass('clicked')) {
      toggle.removeClass('clicked');
      nav.removeClass('open');
      console.log('remove open');
      setTimeout(function() {
        console.log('add hidden');
        nav.addClass('hidden');
      }, 500);
    } else {
      nav.removeClass('hidden');
      toggle.addClass('clicked');
      nav.addClass('open');
    }
  }

  // give the list items numbers
  function navNumbers(data) {
    var sum = $('.main-menu li').length;
    var i = 0;
    var x = 0;

    $('.showcase-menu li').each(function() {
      $(this).attr('data-target', x);
      x++;
    });
    arrayIndices = data;
    $('.main-menu li').each(function() {
      $(this).attr('data-target', i);
      var number = arrayIndices[i].consecutivo;
      var numberElement = '<div class="number"><span>'+number+'</span></div>';
      $(this).prepend(numberElement);
      i++;
    });
  }

  // show the hovered list item stuff
  function showTarget(e) {
    $('.main-menu li').removeClass('hover');
    
    var target = $(e).attr('data-target');
    var showcaseHeight = $('.showcase-menu').outerHeight();
    
    if (screen.width < 787){
      showcaseHeight = (showcaseHeight * target) * -0.85;
    }else{
      showcaseHeight = (showcaseHeight * target) * -0.69;
    }
    
    
    $('.showcase-menu').css({
      top: showcaseHeight
    });
    
    $(e).addClass('hover');
  }

  // show the list item stuff of .active
  function backToDefault() {
    $('.main-menu li').removeClass('hover');
    
    var activeItem = $('.main-menu li.active');
    var target = activeItem.attr('data-target');
    var showcaseHeight = $('.showcase-menu').outerHeight();
    
    if (screen.width < 787){
      showcaseHeight = (showcaseHeight * target) * -0.85;
    }else{
      showcaseHeight = (showcaseHeight * target) * -0.69;
    }
    
    $('.showcase-menu').css({
      top: showcaseHeight
    });
    
    activeItem.addClass('hover');
  }

  // change active list item
  function changeActive(e) {
    $('.main-menu li').removeClass('active');
    $(e).addClass('active');
  }
</script>

