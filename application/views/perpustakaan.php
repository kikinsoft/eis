<div class="flat_area grid_16">
    <h2><?=$menutitle?></h2>
</div>

<div class="box grid_16 tabs">
  <ul class="tab_header clearfix">
    <li><a href="#tabs-perp1"><?=$tabtitle1 ?></a></li>
    <li><a href="#tabs-perp2"><?=$tabtitle2 ?></a></li>
  </ul>
  <div class="controls">
    <a href="#" class="grabber"></a>
    <a href="#" class="toggle"></a>
    <a href="#" class="show_all_tabs"></a>
  </div>
  <div class="toggle_container">
    <div id="tabs-perp1" class="block">
<script type="text/javascript">
function nformat2(num,curr) {				
	
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
	num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	
	cents2 = num%100;
	num = Math.floor(num/100).toString();			
	if(cents2<10){
		cents2 = "0" + cents2;
	} 
		
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
	num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));
	
	if (curr==3){
		return num + '.' + cents3;
	} else if (curr==2){
		return num + '.' + cents2;
	} else {
		return num;
	} 
}

$(function () {
    var chart;
    
    $(document).ready(function () {
    	
    	// Build the chart
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
			credits:{
				enabled: false
			},
            title: {
                text: '<?=$title1 ?>'
            },
            tooltip: {
				enabled: false,
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },			
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
						formatter: function() {
							return nformat2(this.y,0);
						}
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Kategori',
                data: [
				<?php 
				
				if($rs):
				$data = '';
				foreach($rs as $rkey => $value): 
					$data .= "['".$rkey."',".$value."],";
				endforeach; 
				$data = substr($data,0,-1);
				endif;	
				echo $data;			                
				?>
				]
            }]
        });
		
		<?php /*
		Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });
    
            // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });
    
            var chart = new Highcharts.Chart(options);
        }
    
        var table = document.getElementById('datatable'),
        options = {
            chart: {
                renderTo: 'container2',
                type: 'column'
            },
			credits:{
				enabled: false,
			},
            title: {
                text: '<?=$title2 ?>'
            },
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                },
				labels: {
					formatter: function() {
						return nformat2(this.value,0);
					}
				},
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'						
                    },
					formatter: function() {
						return nformat2(this.total,0);
					}
                }
            },
            tooltip: {
				//enabled:false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        nformat2(this.y, 2) +' '+ this.x.toLowerCase();
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
					stacking: 'normal'
                },series: {
					cursor: 'pointer',
					point: {
						events: {
							click: function() {
								//window.open('perumahan/kinerjaTabel/'+ this.category,'_self');
							}
						}
					}
				}				
            }
        };
    
        Highcharts.visualize(table, options);
		*/?>
		
		chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container3',
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
			credits: {
				enabled: false,
			},
            title: {
                text: '<?=$title3 ?>',
                x: -20 //center
            },
            xAxis: {
                categories: [<?=$kunjungan['categories'] ?>]
            },
            yAxis: {
                title: {
                    text: 'Jumlah'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +' orang';
                }
            },
            legend: {
				enabled: false,
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Jumlah Kunjungan',
                data: [<?=$kunjungan['jml'] ?>]
            
            }]
        });
		
    });
    
});
</script>
<script src="<?=base_url()?>assets/scripts/highchart/highcharts.js"></script>
<script src="<?=base_url()?>assets/scripts/highchart/modules/exporting.js"></script>
		<table style="width:100%">
        <tr>
        <td style="border-right:1px #D6D6D6 solid">
		  <div id="container" style="min-width: 350px; height: 400px; margin: 0 auto"></div>
       <? /* </td>
        <td>
          <div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto">
          </div>
        <? //=$html?>*/ ?>
        </td>
        </tr>
        </table>
        
    </div>
    <div id="tabs-perp2" class="block">
        <div class="section">
            <div id="container3" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
        </div>
    </div>
  </div>
</div>    