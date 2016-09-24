// Closure
(function() {
  /**
   * Decimal adjustment of a number.
   *
   * @param {String}  type  The type of adjustment.
   * @param {Number}  value The number.
   * @param {Integer} exp   The exponent (the 10 logarithm of the adjustment base).
   * @returns {Number} The adjusted value.
   */
  function decimalAdjust(type, value, exp) {
    // If the exp is undefined or zero...
    if (typeof exp === 'undefined' || +exp === 0) {
      return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // If the value is not a number or the exp is not an integer...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
      return NaN;
    }
    // Shift
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
  }

  // Decimal round
  if (!Math.round10) {
    Math.round10 = function(value, exp) {
      return decimalAdjust('round', value, exp);
    };
  }
  // Decimal floor
  if (!Math.floor10) {
    Math.floor10 = function(value, exp) {
      return decimalAdjust('floor', value, exp);
    };
  }
  // Decimal ceil
  if (!Math.ceil10) {
    Math.ceil10 = function(value, exp) {
      return decimalAdjust('ceil', value, exp);
    };
  }
})();
if($('input[name="quarter_sale"]').val() !== undefined){
  var data = JSON.parse($('input[name="quarter_sale"]').val());
  var line = new Morris.Line({
    element: 'line-chart',
    resize: true,
    data: data,
    xkey: 'y',
    ykeys: ['item1'],
    labels: ['Item 1'],
    lineColors: ['#efefef'],
    lineWidth: 2,
    hideHover: 'auto',
    gridTextColor: "#fff",
    gridStrokeWidth: 0.4,
    pointSize: 4,
    pointStrokeColors: ["#efefef"],
    gridLineColor: "#efefef",
    gridTextFamily: "Open Sans",
    gridTextSize: 10
  });
}
if($('input[name="predicted_quarter_sale"]').val() !== undefined){
  var data2 = JSON.parse($('input[name="predicted_quarter_sale"]').val());
  var line = new Morris.Line({
    element: 'predicted-line-chart',
    resize: true,
    data: data2,
    xkey: 'y',
    ykeys: ['item1'],
    labels: ['Item 1'],
    lineColors: ['#efefef'],
    lineWidth: 2,
    hideHover: 'auto',
    gridTextColor: "#fff",
    gridStrokeWidth: 0.4,
    pointSize: 4,
    pointStrokeColors: ["#efefef"],
    gridLineColor: "#efefef",
    gridTextFamily: "Open Sans",
    gridTextSize: 10
  });
}

if($('input[name="quarter_sale"]').val() !== undefined){
  var sales_data = JSON.parse($('input[name="quarter_sale"]').val());
  var line_data = JSON.parse($('input[name="line_data"]').val());
  var html = '';
  $.each(sales_data,function(index,value){
    var predicted_val = Math.round((index+1)*line_data['m'] + line_data['b']);
    html += '<tr><td>'+value['y']+'</td><td>'+value['item1']+'</td><td>'+predicted_val+'</td><td>'+Math.round10(((predicted_val-value['item1'])/value['item1'])*100,-2)+' %</td></tr>'
  });
  $('#example1 tbody').html(html);
  $('#example1').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });  
} 