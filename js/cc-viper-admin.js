jQuery(document).ready(function($) {
  $('#_product_info_product_sku').change(function() {
    var sku = $(this).val();
    var price = Math.abs(cc_product_prices[sku]);
    var link = '/?cc_task=add_to_cart&sku=' + sku;
    $('#_product_info_product_price').val('$' + price.toFixed(2));
    $('#_product_info_product_link').val(link);
  });
});
