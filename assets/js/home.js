// Sales chart
if($('input[name="quarter_sale"]').val() !== undefined){
  var data = JSON.parse($('input[name="quarter_sale"]').val());;
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