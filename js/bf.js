jQuery(document).ready(function($) {
  $('#searchJanBtn').on('click', function() {
    var janCode = $('#janCodeTxt').val();
    $.ajax({
      type: "POST",
      url: "http://p-bandai.jp/get_corp_item_data.php",
      data: {
        corp_id: '0005',
        jan_cd: janCode
      },
      beforeSend: function() {
        $('#searchJanBtn').html('Searching...');
      },
      cache: false,
      success: function(data){
         console.log(data);
      },
      error: function() {

      }
    });

  })
})
