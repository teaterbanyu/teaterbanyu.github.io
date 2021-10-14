<?php
$count = $sqlite->getAsetCount();
$countTotal = $sqlite->getAsetCountTotal();
$sum = $sqlite->getAsetSum();
$sumTotal = $sqlite->getAsetSumTotal();
//var_dump($countTotal);
?>
<script>
window.onload = function() {
    CanvasJS.addColorSet("setColor",
                [//colorSet Array

                "#0066ff",
                "#ff9933",               
                ]);
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    colorSet: "setColor",
	title: {
        text: "Berdasar Jumlah Pemilik Tanah",
        fontSize: 22,
        verticalAlign: "bottom",
        horizontalAlign: "center",
	},
	data: [{
		type: "pie",
		startAngle: 240,
        indexLabelFormatter: function(e){			
				return e.dataPoint.label +" "+ Math.round(e.dataPoint.y / <?php echo $countTotal ?> * 100)+ "%" ;
			},
        indexLabelMaxWidth: 75,
		indexLabelWrap: true, 
        indexLabelFontSize: 21,
        indexLabelFontWeight: "bold",
        indexLabelLineThickness: 5,
        cursor: "pointer",
        explodeOnClick: false, 
		dataPoints: [
            <?php foreach($count as $cn): ?>
            {y: <?php echo $cn['count'] ?>, label: "<?php echo $cn['kategori'] ?>", click: function(e){
                window.location="base.php?page=kategori&q=<?php echo $cn['kategori']?>";}
            },
            <?php endforeach ?>
		]
	}]
});
var chart1 = new CanvasJS.Chart("chartContainer1", {
    animationEnabled: true,
    colorSet: "setColor",
	title: {
        text: "Berdasar Luas Tanah",
        fontSize: 22,
        verticalAlign: "bottom",
        horizontalAlign: "center",
	},
	data: [{
		type: "pie",
		startAngle: 240,
        indexLabelFormatter: function(e){			
				return e.dataPoint.label +" "+ Math.round(e.dataPoint.y / <?php echo $sumTotal ?> * 100)+ "%" ;
			},
        indexLabelMaxWidth: 100,
		indexLabelWrap: true, 
        indexLabelFontSize: 21,
        indexLabelFontWeight: "bold",
        indexLabelLineThickness: 5,
        cursor: "pointer",
        explodeOnClick: false, 
		dataPoints: [
            <?php foreach($sum as $sm): ?>
            {y: <?php echo $sm['sum'] ?>, label: "<?php echo $sm['kategori'] ?>", click: function(e){
                window.location="base.php?page=kategori&q=<?php echo $sm['kategori']?>";}},
            <?php endforeach ?>
		]
	}]
});
chart.render();
chart1.render();

}
</script>
            <div class="row">
                <h1 style="text-align:center; font-weight: bold; text-decoration: underline; margin-bottom: 25px;">DATA STATISTIK KATEGORI TANAH</h1>
                <div class="col-md-6">
                    <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                </div>
                <div class="col-md-6">
                    <div id="chartContainer1" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
                </div>
            </div>
        <script type="text/javascript" src="assets/acile.js"></script>
