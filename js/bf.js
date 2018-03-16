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
        console.log(processSingleXML(data));
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
});

function processSingleXML(data) {
  var result = {};

  var x2jObj = null;
  x2jObj = X2J.parseXml(data);

  result.item = {};
  result.item.jan_cd = x2jObj[0].result_data[0].item_data[0].item[0].jan_cd[0].jValue;
  result.item.item_name = x2jObj[0].result_data[0].item_data[0].item[0].item_name[0].jValue;
  result.item.item_image = x2jObj[0].result_data[0].item_data[0].item[0].item_image[0].jValue;
  result.item.item_price = x2jObj[0].result_data[0].item_data[0].item[0].item_price[0].jValue;
  result.item.item_sale_date = x2jObj[0].result_data[0].item_data[0].item[0].item_sale_date[0].jValue;
  result.item.item_sale_end_date = x2jObj[0].result_data[0].item_data[0].item[0].item_sale_end_date[0].jValue;
  result.item.item_pr = x2jObj[0].result_data[0].item_data[0].item[0].item_pr[0].jValue;
  result.item.item_place = x2jObj[0].result_data[0].item_data[0].item[0].item_place[0].jValue;
  result.item.item_min_age = x2jObj[0].result_data[0].item_data[0].item[0].item_min_age[0].jValue;
  result.item.item_max_age = x2jObj[0].result_data[0].item_data[0].item[0].item_max_age[0].jValue;
  result.item.item_tgt_cmt = x2jObj[0].result_data[0].item_data[0].item[0].item_tgt_cmt[0].jValue;
  result.item.image_path_small = x2jObj[0].result_data[0].item_data[0].item[0].item_image_loop[0].image_loop[0].image_path_small[0].jValue;
  result.item.image_path_middle = x2jObj[0].result_data[0].item_data[0].item[0].item_image_loop[0].image_loop[0].image_path_middle[0].jValue;
  result.item.image_path_big = x2jObj[0].result_data[0].item_data[0].item[0].item_image_loop[0].image_loop[0].image_path_big[0].jValue;
  result.item.image_path_xl = x2jObj[0].result_data[0].item_data[0].item[0].item_image_loop[0].image_loop[0].image_path_xl[0].jValue;
  result.item.item_pbitem_url = x2jObj[0].result_data[0].item_data[0].item[0].item_pbitem_url[0].jValue;
  result.item.copyright = x2jObj[0].result_data[0].item_data[0].item[0].copyright[0].jValue;
  result.item.bandai_corp_item_detail_url = x2jObj[0].result_data[0].item_data[0].item[0].bandai_corp_item_detail_url[0].jValue;

  return result;
}
