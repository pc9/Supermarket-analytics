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
var customers_count_by_gender = JSON.parse($('input[name="customers_count_by_gender"]').val());
var donutData = [
{label: "Males", data: customers_count_by_gender['Male'], color: "#4aa3df"},
{label: "Females", data: customers_count_by_gender['Female'], color: "#2ecc71"},
];
$.plot("#donut-chart", donutData, {
  series: {
    pie: {
      show: true,
      radius: 1,
      innerRadius: 0.5,
      label: {
        show: true,
        radius: 2 / 3,
        formatter: labelFormatter,
        threshold: 0.1
      }

    }
  },
  legend: {
    show: false
  }
}); 
function labelFormatter(label, series) {
  return '<div style="font-size:13px; text-align:center; padding:0px;margin:0 10px; color: #fff; font-weight: 600;">'+label+ "<br>"+Math.round10(series.percent,-2)+"%</div>";
}

function bar_chart( data )
{
  var data_arr = [];
  $.each(data,function(key,value){
    data_arr.push([key,value]);
  });
  var bar_data = {
    data: data_arr,
    color: "#d35400"
  };
  $.plot("#bar-chart", [bar_data], {
    grid: {
      borderWidth: 1,
      borderColor: "#f3f3f3",
      tickColor: "#f3f3f3"
    },
    series: {
      bars: {
        show: true,
        barWidth: 0.5,
        align: "center"
      }
    },
    xaxis: {
      mode: "categories",
      tickLength: 0
    }
  });
}

$(document).on('change','select[name="customer_count_group"]',function(){
  var group = $(this).val();
  var data;
  if (group == 'salary')
  {
    data = JSON.parse($('input[name="customers_count_by_income"]').val());
  } 
  if (group == 'age')
  {
    data = JSON.parse($('input[name="customers_count_by_age"]').val());
  }
  if (group == 'marital_status')
  {
    data = JSON.parse($('input[name="customers_count_by_marital_status"]').val());
  }
  if (group == 'occupation')
  {
    data = JSON.parse($('input[name="customers_count_by_occupation"]').val());
  }  
  if (group == 'member_card')
  {
    data = JSON.parse($('input[name="customers_count_by_member_card"]').val());
  }
  if (group == 'education')
  {
    data = JSON.parse($('input[name="customers_count_by_education"]').val());
  }  
  bar_chart(data);
});

bar_chart(JSON.parse($('input[name="customers_count_by_income"]').val()));