//Generar nodos con PHP
<script type="text/javascript">
	var nodos = new vis.Dataset([
<?php 
	for ($i=1; $i <= 50 ; $i++) { 
		if ($i == 50) {
			echo "{id: $i, label: '$i' }";
		}else{
			echo "{id: $i, label: '$i' },";
		}
	};
 ?>
	]);



//Generar aristas con PHP
	var aristas = new vis.DataSet([
<?php
	for ($i=1; $i <= 50; $i++) {
		$num1=rand(1,50);
		$num2=rand(1,50);
		if ($i == 50) {
			echo "{from: num1, to: num2}";
		}else{
			echo "{from: num1, to: num2},";
		}
	};
?>	
	]);
</script>