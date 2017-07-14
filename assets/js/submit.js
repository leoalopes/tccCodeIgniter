$('.submit-button').click(function(e) {
  if ($(this).data('requestRunning') ) {
      e.preventDefault();
      return;
  }
  $(this).data('requestRunning', true);
});
