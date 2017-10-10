if($(".menu-icon").css('display') == 'none'){
  $("#slide-out").css('margin-top', $(".navbar-fixed").height());
  $(".container").css('margin-left', '25%');
} else {
  $("#slide-out").css('margin-top', 0);
  $(".container").css('margin-left', '7%');
}

$(window).resize(function() {
  if($(".menu-icon").css('display') == 'none'){
    $("#slide-out").css('margin-top', $(".navbar-fixed").height());
    $(".container").css('margin-left', '25%');
  } else {
    $("#slide-out").css('margin-top', 0);
    $(".container").css('margin-left', '7%');
  }
});
