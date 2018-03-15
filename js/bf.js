jQuery(document).ready(function($) {
  $('#searchJanBtn').on('click', function() {
    var loadingIcon = $('#loadingIcon');
    var searchButton = $('#searchJanBtn');
    var janCode = $('#janCodeTxt').val();
    $.ajax({
      type: "POST",
      url: "http://p-bandai.jp/get_corp_item_data.php",
      data: {
        corp_id: '0005',
        jan_cd: janCode
      },
      beforeSend: function() {
        searchButton.attr('disabled', true);
        searchButton.text('Searching...');
        loadingIcon.show();
      },
      cache: false,
      success: function(data){
        var x2jObj = null;
        x2jObj = X2J.parseXml(data);
        console.log(x2jObj[0].result_data[0]);
      },
      error: function() {

      },
      complete: function() {
        searchButton.attr('disabled', false);
        searchButton.text('Done !');
        loadingIcon.hide();
      }
    });
  });
})
