var scroll = 126;

jQuery(function($)
{
  $(window).scroll(function()
  {
    if($(this).scrollTop()>scroll)
    {
      $('#buttons').addClass('fixed');
      $('#header-line').addClass('fix-line');
      $('#mybgbutton').addClass('fix-mybuttonfon');
    }
    else if ($(this).scrollTop()<scroll)
    {
      $('#buttons').removeClass('fixed');
      $('#header-line').removeClass('fix-line');
      $('#mybgbutton').removeClass('fix-mybuttonfon');
    }
  });
});
