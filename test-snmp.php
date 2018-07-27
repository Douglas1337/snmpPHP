<html>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
.update-nag{
  display: inline-block;
  font-size: 14px;
  text-align: left;
  background-color: #fff;
  height: 40px;
  margin-bottom: 10px;
}
.update-nag > .update-split{
  background: #337ab7;
  width: 33px;
  float: left;
  color: #fff!important;
  height: 100%;
  text-align: center;
}
.update-nag > .update-split > .glyphicon{
  position:relative;
  top: calc(50% - 9px)!important;
}
.update-nag > .update-split.update-danger{
  background: #434343!important;
}
.update-nag > .update-text{
  line-height: 19px;
  padding-top: 11px;
  padding-left: 45px;
  padding-right: 20px;
}
.loader {
z-index:9999;
  border: 16px solid #222222;
  border-radius: 50%;
  border-top: 16px solid #4286f4;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
position:fixed;
    top: 40%;
    left: 45.5%;
}
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div id="loader" class="loader"></div>
<img src="http://traveledge.com.au/wp-content/uploads/2017/03/tech-banner.jpg" height="200px" width="100%">
<div class="jumbotron text-center">
  <h1><i class="fa fa-database"></i> Trabalho Final - Gerência e Administração de Redes</h1>
  <p>FCAPS - gerenciamento de dispositivos em redes IP!</p> 
	<button class="btn btn-dark" data-toggle="collapse" data-target="#demo">SNMP <i class="fa fa-download"></i></button>
	<button class="btn btn-dark" data-toggle="collapse" data-target="#demo2">PING <i class="fa fa-code-fork"></i></button>
<div id="demo" class="collapse"><br>
  	<form action="" method="post">
	  <div class="form-group">
	    	<label for="ip">IP - Exemplo: 192.168.100.0&nbsp;&nbsp;</label>
	    	<input type="text" class="form-control" id="ip" name="ip" required>
	  </div>
	  <div class="form-group">
	    	<label for="cidr">CIDR - Exemplo: 27&nbsp;&nbsp;</label>
	    	<input type="text" class="form-control" id="cidr" name="cidr">
	  </div>
	  <div class="form-group">
	   <label for="op">Opções&nbsp;&nbsp;</label>
	   <select class="form-control" id="op" name="op">
	    	<option value="1">Info</option>
	   </select>
	  </div> 
	  <div class="form-group">
	   <label for="hd">% Limite HD (0 a 100) &nbsp;&nbsp;</label>
		<input type="range" class="custom-range" min="0" max="100" id="hd" name="hd">
	  </div>
	  <div class="form-group">
	   <label for="mem">% Limite Memoria em uso (0 a 100) &nbsp;&nbsp;</label>
		<input type="range" class="custom-range" min="0" max="100" id="mem" name="mem">
	  </div>
	  <div class="form-group">
	   <label for="cpu">% Limite CPU em uso (0 a 100) &nbsp;&nbsp;</label>
		<input type="range" class="custom-range" min="0" max="100" id="cpu" name="cpu">
	  </div>
          <button type="submit" class="btn btn-dark">Enviar</button>
	</form> 
</div>
<div id="demo2" class="collapse"><br>
  	<form action="" method="post">
	  <div class="form-group">
	    	<label for="ip">IP - Exemplo: 192.168.100.0&nbsp;&nbsp;</label>
	    	<input type="text" class="form-control" id="ip" name="ip" required>
	  </div>
	  <div class="form-group">
	    	<label for="cidr">CIDR - Exemplo: 27&nbsp;&nbsp;</label>
	    	<input type="text" class="form-control" id="cidr" name="cidr">
	  </div>
	  <div class="form-group">
	   <label for="op">Opções&nbsp;&nbsp;</label>
	   <select class="form-control" id="op" name="op">
	    	<option value="2">Ping</option>
	   </select>
	  </div> 
	  <div class="form-group">
	   <label for="ms">% Limite MS (0 a 1000) &nbsp;&nbsp;</label>
		<input type="range" class="custom-range" min="0" max="1000" id="ms" name="ms">
	  </div>
 	  <div class="form-group">
	   <label for="ping">Quantidade PINGS (0 a 100)&nbsp;&nbsp;</label>
		<input type="range" class="custom-range" min="0" max="100" id="ping" name="ping">
	  </div>
          <button type="submit" class="btn btn-dark">Enviar</button>
	</form> 
</div>
</div>
<div style="padding-left: 10px; padding-right: 10px;">
<?php 
if($_POST['ip']==""){
	$_POST['ip'] = "192.168.100.34";
}
if (!empty($_POST)){

	if($_POST['op']=="2"){
		for($i = 0; $i < 5000; $i++)
		{
		    echo ' ';
		}

		function GetPing($ip = NULL) {
			$exec = exec("ping -c 1 -w 1 -s 32 -t 128 " . $ip);
			$array = explode('/', end(explode('=', $exec )));
			return ceil($array[1]) . 'ms';
		}
		$totalcount = $_POST['ping'];
		$total = 0;
		$perda = 0;
		if($_POST['cidr'] != ""){
			$ip_addr_cidr = $_POST['ip']."/".$_POST['cidr'];
		    	$fping = shell_exec("fping -a -g ".$ip_addr_cidr." 2>/dev/null");
			$ip_arr = preg_split('/\s+/', $fping);
			foreach($ip_arr as $zm){ 
			if($zm != ""){
				$stringms = "";
				$perda = 0;
				$total = 0;
				for($count = 1; $count <= $totalcount; $count++){
					$str = ceil(GetPing($zm));
					if ($str==0) {
						$perda = $perda + 1;
						$stringms = $stringms . ", ['', 0]";
					} else {
						$total = $total + $str;
						$stringms = $stringms . ", ['', ".$str."]";
					}
					ob_flush();
				    flush();
				}
?>
<?php if (($total/($totalcount-$perda)) >= $_POST['ms']) { ?>
<h2 style="color:red"><?php echo $zm; ?> - passou do limite de MS</h2>
<?php } else { ?>
<h2><?php echo $zm; ?></h2>
<?php } ?>
<div class="row">
	<div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-refresh"></i></div>
            <div class="update-text"><?php echo "Média: " . ($total/($totalcount-$perda));?></div>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-primary"><i style="font-size:36px" class="fa fa-home"></i></div>
            <div class="update-text"><?php echo ($totalcount-$perda) . " pings realizados.";?></div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-warning"><i style="font-size:36px" class="fa fa-child"></i></div>
            <div class="update-text"><?php echo $perda . " pings perdidos de ".$totalcount.".";?></div>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-danger"><i style="font-size:36px" class="fa fa-remove"></i></div>
            <div class="update-text"><?php echo (($perda/$totalcount)*100) ."% perdidos de ".$totalcount.".";?></div>
          </div>
        </div>
        
	</div>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  
        var data = google.visualization.arrayToDataTable([
          ['IP', 'MS']
          <?php print $stringms; ?>
        ]);

        var options = {
          title: 'Tempo de Resposta (MS)',
          hAxis: {title: 'MS',  titleTextStyle: {color: '#434343'}},
          vAxis: {minValue: 0},
	  is3D: true
        };

        var chart = new google.visualization.LineChart(document.getElementById(<?php echo "'chart_div".str_replace(".","",$zm)."'"; ?>));
        chart.draw(data, options);
}
</script>
<div class="row">
  	<div class="col card" id="chart_div<?php echo str_replace(".","",$zm); ?>" style="height:200px"></div>
</div>
<?php			}
		}} else {
			for($count = 1; $count <= $totalcount; $count++){
				$zm = $_POST['ip'];
					$str = ceil(GetPing($zm));
					if ($str==0) {
						$perda = $perda + 1;
						$stringms = $stringms . ", ['', 0]";
					} else {
						$total = $total + $str;
						$stringms = $stringms . ", ['', ".$str."]";
					}
					ob_flush();
				    flush();
				}
?>
<?php if (($total/($totalcount-$perda)) >= $_POST['ms']) { ?>
<h2 style="color:red"><?php echo $zm; ?> - passou do limite de MS</h2>
<?php } else { ?>
<h2><?php echo $zm; ?></h2>
<?php } ?>
<div class="row">
	<div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-refresh"></i></div>
            <div class="update-text"><?php echo "Média: " . ($total/($totalcount-$perda));?></div>
          </div>
        </div>
    
        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-primary"><i style="font-size:36px" class="fa fa-home"></i></div>
            <div class="update-text"><?php echo ($totalcount-$perda) . " pings realizados.";?></div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-warning"><i style="font-size:36px" class="fa fa-child"></i></div>
            <div class="update-text"><?php echo $perda . " pings perdidos de ".$totalcount.".";?></div>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="update-nag">
            <div class="update-split bg-danger"><i style="font-size:36px" class="fa fa-remove"></i></div>
            <div class="update-text"><?php echo (($perda/$totalcount)*100) ."% perdidos de ".$totalcount.".";?></div>
          </div>
        </div>
        
	</div>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  
        var data = google.visualization.arrayToDataTable([
          ['IP', 'MS']
          <?php print $stringms; ?>
        ]);

        var options = {
          title: 'Tempo de Resposta (MS)',
          hAxis: {title: 'MS',  titleTextStyle: {color: '#434343'}},
          vAxis: {minValue: 0},
	  is3D: true
        };

        var chart = new google.visualization.LineChart(document.getElementById(<?php echo "'chart_div".str_replace(".","",$zm)."'"; ?>));
        chart.draw(data, options);
}
</script>
<div class="row">
  	<div class="col card" id="chart_div<?php echo str_replace(".","",$zm); ?>" style="height:200px"></div>
</div>
<?php 
		}
	}
}
if (!empty($_POST)){
if($_POST['op']=="1"){
?>
<div class="row">
	<div class="col-md-2">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-refresh"></i></div>
            <div class="update-text"><?php echo "IP: " . $_POST['ip'];?></div>
          </div>
        </div>
    
        <div class="col-md-2">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-folder-open"></i></div>
            <div class="update-text"><?php echo "CIDR: " . $_POST['cidr'];?></div>
          </div>
        </div>

	<div class="col-md-2">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-code"></i></div>
            <div class="update-text"><?php echo "Opção: " . $_POST['op'];?></div>
          </div>
        </div>

        <div class="col-md-2">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-crop"></i></div>
            <div class="update-text"><?php echo "Limite % HD Uso:" .$_POST['hd']."%" ;?></div>
          </div>
        </div>
        
        <div class="col-md-2">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-crop"></i></div>
            <div class="update-text"><?php echo "Limite % CPU Uso:" .$_POST['cpu']."%";?></div>
          </div>
        </div>

	<div class="col-md-2">
          <div class="update-nag">
            <div class="update-split bg-dark"><i style="font-size:36px" class="fa fa-crop"></i></div>
            <div class="update-text"><?php echo "Limite % MEM Uso:" .$_POST['mem']."%";?></div>
          </div>
        </div>
        
	</div>
<?php 
}
}
if (!empty($_POST)){
if($_POST['op']=="1"){?>
<div class="row">
  	<div class="col card" id="chart_div" style="height:200px"></div>
  	<div class="col card" id="piechart" style="height:200px"></div>
</div>
<h2> Computadores Descobertos: <span id="divip"></span></h2>
<?php 
}
}
if($_POST['ip']==""){
	$_POST['ip'] = "192.168.100.34";
}
snmp_set_oid_numeric_print(TRUE);
snmp_set_quick_print(TRUE);
snmp_set_enum_print(TRUE); 
if (!empty($_POST)){
    flush();
    ob_flush();
	if($_POST['ip']!=""&&$_POST['cidr']==""&&$_POST['op']=="1"){
			$exec = exec("ping -c 1 -w 1 ".$_POST['ip']);
					$stringms = $stringms . ", ['".$_POST['ip']."', ".ceil(1)."]";
					$stringip = $stringip . ", ['".$_POST['ip']."', 1]";
					$host = $_POST['ip'];
					$community = "public"; 

					$session = new SNMP(SNMP::VERSION_2c, $host, $community);
					$session->oid_output_format = SNMP_OID_OUTPUT_UCD;

					$sysname = $session->get('1.3.6.1.2.1.1.5.0');
					$sysdesc = $session->get('1.3.6.1.2.1.1.1.0');
					$sysuptime = $session->get('1.3.6.1.2.1.1.3.0');
					$syslocal = $session->get('1.3.6.1.2.1.1.6.0');
					$systcp = $session->get('1.3.6.1.2.1.6.9.0');
					$systcpactive = $session->get('1.3.6.1.2.1.6.5.0');
					$systcpin = $session->get('1.3.6.1.2.1.6.10.0');
					$systcpout = $session->get('1.3.6.1.2.1.6.11.0');
					$systcpinerr = $session->get('1.3.6.1.2.1.6.14.0');
					$systcpouterr = $session->get('1.3.6.1.2.1.6.15.0');
					$sysmemory = $session->get('1.3.6.1.4.1.2021.4.5.0');
					echo '<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#'.$sysname.'">'. $_POST['ip'] . " - " . $sysname .'</button>';
					echo '<div id="'.$sysname.'" class="collapse row">';
					echo '<div class="col-4 card">';
					echo '<div class="card-header"><b>Nome do computador:</b> '.str_replace("STRING:","",$sysname).'</div>';
					echo '<div class="card-body"><b>Descrição:</b> '.str_replace("STRING:","",$sysdesc).'<br><b>Local:</b> '.
						str_replace("STRING:","",$syslocal) .'<br><b>Tempo online:</b> '.
						$sysuptime . '<br><b>Mémoria do sistema:</b> ' . $sysmemory .'
					</div>';
					echo '</div>';
					$interface1 = snmpwalk($_POST['ip'],"public","ifDescr");
					$interface2 = snmpwalk($_POST['ip'],"public","ifPhysAddress");
					$interface3 = snmpwalk($_POST['ip'],"public","ifAdminStatus");
					$interface4 = snmpwalk($_POST['ip'],"public","ifInOctets");
					$interface5 = snmpwalk($_POST['ip'],"public","ifInDiscards");
					$interface6 = snmpwalk($_POST['ip'],"public","ifInErrors");
					$interface7 = snmpwalk($_POST['ip'],"public","ifOutOctets");
					$interface8 = snmpwalk($_POST['ip'],"public","ifOutDiscards");
					$interface9 = snmpwalk($_POST['ip'],"public","ifOutErrors");
					echo '<div class="col-4 card">
					  	<div class="card-header"><b>Interface:</b> '.$interface1[1].'</div>
					  	<div class="card-body"><b>Endereço Fisico:</b> '.$interface2[1] .'<br><b>Status (1=up, 2=down, 3=testing):</b> '.$interface3[1] .'<br><b>InOctets:</b><span class="badge badge-pill badge-dark"> '. $interface4[1] . '</span><br><b>InDiscards:</b><span class="badge badge-pill badge-dark"> '. $interface5[1] . '</span><br><b>ifInErrors:</b><span class="badge badge-pill badge-dark"> '. $interface6[1] . '</span><br><b>ifOutOctets:</b><span class="badge badge-pill badge-danger"> '. $interface7[1] . '</span><br><b>ifOutDiscards:</b><span class="badge badge-pill badge-danger"> '. $interface8[1] . '</span><br><b>ifOutErrors:</b><span class="badge badge-pill badge-danger"> '. $interface9[1] . '</span><br><b>Conexões TCP:</b> <span class="badge badge-pill badge-primary">'.str_replace("Gauge32:","",$systcp) .'</span><br><b>TCP Activas:</b><span class="badge badge-pill badge-success"> '.str_replace("Counter32:","",$systcpactive).'</span><br><b>TCP In:</b><span class="badge badge-pill badge-dark"> '.str_replace("Counter32:","",$systcpin) .'</span><br><b>TCP Out:</b><span class="badge badge-pill badge-dark"> '.str_replace("Counter32:","",$systcpout) . '</span><br><b>TCP In Error:</b><span class="badge badge-pill badge-danger"> '.str_replace("Counter32:","",$systcpinerr) .'</span><br><b>TCP Out Error:</b><span class="badge badge-pill badge-danger"> '.str_replace("Counter32:","",$systcpouterr).'</span>
					</div></div>';
					$nmap = shell_exec('sudo nmap -F -T5 -P0 '. $_POST['ip']);
					$vetorLinhas = explode("\n", $nmap);
					$start = array_keys(preg_grep('/^PORT/', $vetorLinhas))[0];
					$data = array_slice($vetorLinhas, $start, -3);
				
					echo '<div class="col-4 card">';
					echo '<div class="card-header"><b>NMAP:</b> '.str_replace("STRING:","",$sysname).'</div>';
					echo '<div class="card-body">';
					for($i=0;$i<=sizeof($data);$i++) {
						echo $data[$i] . "<br>";
					}
					echo '</div></div>';
					$h = snmpwalk($_POST['ip'],"public","1.3.6.1.2.1.25.2.3.1.3");
					$f = snmpwalk($_POST['ip'],"public","1.3.6.1.2.1.25.2.3.1.5");
					$g = snmpwalk($_POST['ip'],"public","1.3.6.1.2.1.25.2.3.1.6");
					
					echo '<script>
						$(document).ready(function(){
						  $("#searchsoft'.str_replace("STRING:","",$sysname).'").on("keyup", function() {
						    var value = $(this).val().toLowerCase();
						    $("#tablesoft'.str_replace("STRING:","",$sysname).' tr").filter(function() {
						      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						    });
						  });
						});
						</script>';
					echo "<div class='card col-4'><div class='card-header'><b>HD / Uso</b></div><div class='card-body'>";
					echo "<table id='tablesoft".str_replace("STRING:","",$sysname)."' class='table table-striped'>% Limite HD: ". $_POST['hd'];
					echo '<input class="form-control" id="searchsoft'.str_replace("STRING:","",$sysname).'" type="text" placeholder="Procurar por partição..">';
					for($i=0;$i<=sizeof($f);$i++) {
						if($f[$i] > 0){
							if(($g[$i]*100)/$f[$i] >= $_POST['hd']){
								echo "<tr style='color:red'>";
							} else {
								echo "<tr>";
							}
							echo "<td>Partição: " . $h[$i]  . " / " .  str_replace('"',"",$f[$i]) . "</td><td> Livre: " . ($f[$i]-$g[$i])  . " / ". number_format((($f[$i]-$g[$i])*100)/$f[$i], 2) . "%</td><td> Uso: " . $g[$i] . " / ". number_format((($g[$i])*100)/$f[$i], 2) . "%</td></tr>";
						}
					}
					echo "</table></div></div>";
					$c = snmpwalk($_POST['ip'],"public","1.3.6.1.2.1.25.5.1.1.1");
					$d = snmpwalk($_POST['ip'],"public","1.3.6.1.2.1.25.5.1.1.2");
					$e = snmpwalk($_POST['ip'],"public","hrSWRunName");
					echo '<script>
						$(document).ready(function(){
						  $("#searchprocess'.str_replace("STRING:","",$sysname).'").on("keyup", function() {
						    var value = $(this).val().toLowerCase();
						    $("#tableprocess'.str_replace("STRING:","",$sysname).' tr").filter(function() {
						      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						    });
						  });
						});
						</script>';
					echo "<div class='card col-4'><div class='card-header'><b>Processo / CPU / Memoria</b></div><div class='card-body'>";
					echo "<table id='tableprocess".str_replace("STRING:","",$sysname)."' class='table table-striped'>% Limite CPU: ". $_POST['cpu'] . " | % Limite MEM: " . $_POST['mem'];
					echo '<input class="form-control" id="searchprocess'.str_replace("STRING:","",$sysname).'" type="text" placeholder="Procurar por processo..">';
					for($i=0;$i<=sizeof($e);$i++) {
							if($c[$i]/10000 >= $_POST['cpu'] || (ceil($d[$i])/$sysmemory)*100 >= $_POST['mem']){
								echo "<tr style='color:red'>";
							} else {
								echo "<tr>";
							}
						echo "<td>Processo: " . str_replace('"',"",$e[$i]) . "</td><td> CPU: " . number_format($c[$i]/10000, 2) . "%</td><td> Memoria: " . number_format((ceil($d[$i])/$sysmemory)*100, 2) . "%</td></tr>";
					}
					echo "</table>".$totalcpu."</div></div>";
					$a = snmpwalk($_POST['ip'],"public","hrSWInstalledName");
					$b = snmpwalk($_POST['ip'],"public","hrSWInstalledDate");
					echo '<script>
						$(document).ready(function(){
						  $("#searchsoftware'.str_replace("STRING:","",$sysname).'").on("keyup", function() {
						    var value = $(this).val().toLowerCase();
						    $("#tablesoftware'.str_replace("STRING:","",$sysname).' tr").filter(function() {
						      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						    });
						  });
						});
						</script>';
					echo "<div class='card col-4'><div class='card-header'><b>Softwares Instalados / Data Instalação</b></div><div class='card-body'>";			
					echo "<table id='tablesoftware".str_replace("STRING:","",$sysname)."' class='table table-striped'>";
					echo '<input class="form-control" id="searchsoftware'.str_replace("STRING:","",$sysname).'" type="text" placeholder="Procurar por software..">';
					for($i=0;$i<=sizeof($a);$i++) {
						$chars = array('"', "-", "~");
						echo "<tr><td>Software: " . str_replace($chars," ",$a[$i]) . "</td><td>" . $b[$i] . "</td></tr>";
					}
					echo "</table></div>";
					echo "</div>";
			flush();
		    	ob_flush();
	} else if($_POST['ip']!=""&&$_POST['cidr']>0&&$_POST['op']=="1") {
	    $ip_addr_cidr = $_POST['ip']."/".$_POST['cidr'];
	    	$fping = shell_exec("fping -a -g ".$ip_addr_cidr." 2>/dev/null");
		$ip_arr = preg_split('/\s+/', $fping);
		foreach($ip_arr as $zm){ 
			$exec = exec("ping -c 1 -w 1 ".$zm);
			$array = explode("/", end(explode("=", $exec )) );
			if($zm == "192.168.100.1" || $zm == "192.168.100.101" || $zm == "192.168.100.41" || $zm == "192.168.100.134" || $zm == ""){
			}else{
			if (ceil($array[1]) > 0){
					?>
					<script>document.getElementById('divip').innerHTML = "<?php print $zm; ?> <i style='color:green' class='fa fa-check'></i>";</script>
					<?php
					$stringms = $stringms . ", ['".$zm."', ".ceil($array[1])."]";
					$stringip = $stringip . ", ['".$zm."', 1]";
					$host = $zm;
					$community = "public"; 

					$session = new SNMP(SNMP::VERSION_2c, $host, $community);
					$session->oid_output_format = SNMP_OID_OUTPUT_UCD;

					$sysname = $session->get('1.3.6.1.2.1.1.5.0');
					$sysdesc = $session->get('1.3.6.1.2.1.1.1.0');
					$sysuptime = $session->get('1.3.6.1.2.1.1.3.0');
					$syslocal = $session->get('1.3.6.1.2.1.1.6.0');
					$systcp = $session->get('1.3.6.1.2.1.6.9.0');
					$systcpactive = $session->get('1.3.6.1.2.1.6.5.0');
					$systcpin = $session->get('1.3.6.1.2.1.6.10.0');
					$systcpout = $session->get('1.3.6.1.2.1.6.11.0');
					$systcpinerr = $session->get('1.3.6.1.2.1.6.14.0');
					$systcpouterr = $session->get('1.3.6.1.2.1.6.15.0');
					$sysmemory = $session->get('1.3.6.1.4.1.2021.4.5.0');
					echo '<hr><button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#'.$sysname.'">'. $host . " - " . $sysname .'</button>';
					echo '<div id="'.$sysname.'" class="collapse row">';
					echo '<div class="col-4 card">';
					echo '<div class="card-header"><b>Nome do computador:</b> '.str_replace("STRING:","",$sysname).'</div>';
					echo '<div class="card-body"><b>Descrição:</b> '.str_replace("STRING:","",$sysdesc).'<br><b>Local:</b> '.
						str_replace("STRING:","",$syslocal) .'<br><b>Tempo online:</b> '.
						$sysuptime . '<br><b>Mémoria do sistema:</b> ' . $sysmemory .'
					</div>';
					echo '</div>';
					$interface1 = snmpwalk($host,"public","ifDescr");
					$interface2 = snmpwalk($host,"public","ifPhysAddress");
					$interface3 = snmpwalk($host,"public","ifAdminStatus");
					$interface4 = snmpwalk($host,"public","ifInOctets");
					$interface5 = snmpwalk($host,"public","ifInDiscards");
					$interface6 = snmpwalk($host,"public","ifInErrors");
					$interface7 = snmpwalk($host,"public","ifOutOctets");
					$interface8 = snmpwalk($host,"public","ifOutDiscards");
					$interface9 = snmpwalk($host,"public","ifOutErrors");
					echo '<div class="col-4 card">
					  	<div class="card-header"><b>Interface:</b> '.$interface1[1].'</div>
					  	<div class="card-body"><b>Endereço Fisico:</b> '.$interface2[1] .'<br><b>Status (1=up, 2=down, 3=testing):</b> '.$interface3[1] .'<br><b>InOctets:</b><span class="badge badge-pill badge-dark"> '. $interface4[1] . '</span><br><b>InDiscards:</b><span class="badge badge-pill badge-dark"> '. $interface5[1] . '</span><br><b>ifInErrors:</b><span class="badge badge-pill badge-dark"> '. $interface6[1] . '</span><br><b>ifOutOctets:</b><span class="badge badge-pill badge-danger"> '. $interface7[1] . '</span><br><b>ifOutDiscards:</b><span class="badge badge-pill badge-danger"> '. $interface8[1] . '</span><br><b>ifOutErrors:</b><span class="badge badge-pill badge-danger"> '. $interface9[1] . '</span><br><b>Conexões TCP:</b> <span class="badge badge-pill badge-primary">'.str_replace("Gauge32:","",$systcp) .'</span><br><b>TCP Activas:</b><span class="badge badge-pill badge-success"> '.str_replace("Counter32:","",$systcpactive).'</span><br><b>TCP In:</b><span class="badge badge-pill badge-dark"> '.str_replace("Counter32:","",$systcpin) .'</span><br><b>TCP Out:</b><span class="badge badge-pill badge-dark"> '.str_replace("Counter32:","",$systcpout) . '</span><br><b>TCP In Error:</b><span class="badge badge-pill badge-danger"> '.str_replace("Counter32:","",$systcpinerr) .'</span><br><b>TCP Out Error:</b><span class="badge badge-pill badge-danger"> '.str_replace("Counter32:","",$systcpouterr).'</span>
					</div></div>';
					$nmap = shell_exec('sudo nmap -F -T5 -P0 '. $host);
					$vetorLinhas = explode("\n", $nmap);
					$start = array_keys(preg_grep('/^PORT/', $vetorLinhas))[0];
					$data = array_slice($vetorLinhas, $start, -3);
				
					echo '<div class="col-4 card">';
					echo '<div class="card-header"><b>NMAP:</b> '.str_replace("STRING:","",$sysname).'</div>';
					echo '<div class="card-body">';
					for($i=0;$i<=sizeof($data);$i++) {
						echo $data[$i] . "<br>";
					}
					echo '</div></div>';
					$h = snmpwalk($host,"public","1.3.6.1.2.1.25.2.3.1.3");
					$f = snmpwalk($host,"public","1.3.6.1.2.1.25.2.3.1.5");
					$g = snmpwalk($host,"public","1.3.6.1.2.1.25.2.3.1.6");
					echo '<script>
						$(document).ready(function(){
						  $("#searchsoft'.str_replace("STRING:","",$sysname).'").on("keyup", function() {
						    var value = $(this).val().toLowerCase();
						    $("#tablesoft'.str_replace("STRING:","",$sysname).' tr").filter(function() {
						      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						    });
						  });
						});
						</script>';
					echo "<div class='card col-4'><div class='card-header'><b>HD / Uso</b></div><div class='card-body'>";
					echo "<table id='tablesoft".str_replace("STRING:","",$sysname)."' class='table table-striped'>% Limite HD: ". $_POST['hd'];
					echo '<input class="form-control" id="searchsoft'.str_replace("STRING:","",$sysname).'" type="text" placeholder="Procurar por partição..">';
					for($i=0;$i<=sizeof($f);$i++) {
						if($f[$i] > 0){
							if(($g[$i]*100)/$f[$i] >= $_POST['hd']){
								echo "<tr style='color:red'>";
							} else {
								echo "<tr>";
							}
							echo "<td>Partição: " . $h[$i]  . " / " .  str_replace('"',"",$f[$i]) . "</td><td> Livre: " . ($f[$i]-$g[$i])  . " / ". number_format((($f[$i]-$g[$i])*100)/$f[$i], 2) . "%</td><td> Uso: " . $g[$i] . " / ". number_format((($g[$i])*100)/$f[$i], 2) . "%</td></tr>";
						}
					}
					echo "</table></div></div>";
					$c = snmpwalk($host,"public","1.3.6.1.2.1.25.5.1.1.1");
					$d = snmpwalk($host,"public","1.3.6.1.2.1.25.5.1.1.2");
					$e = snmpwalk($host,"public","hrSWRunName");
					echo '<script>
						$(document).ready(function(){
						  $("#searchprocess'.str_replace("STRING:","",$sysname).'").on("keyup", function() {
						    var value = $(this).val().toLowerCase();
						    $("#tableprocess'.str_replace("STRING:","",$sysname).' tr").filter(function() {
						      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						    });
						  });
						});
						</script>';
					echo "<div class='card col-4'><div class='card-header'><b>Processo / CPU / Memoria</b></div><div class='card-body'>";
					echo "<table id='tableprocess".str_replace("STRING:","",$sysname)."' class='table table-striped'>% Limite CPU: ". $_POST['cpu'] . " | % Limite MEM: " . $_POST['mem'];
					echo '<input class="form-control" id="searchprocess'.str_replace("STRING:","",$sysname).'" type="text" placeholder="Procurar por processo..">';
					for($i=0;$i<=sizeof($e);$i++) {
							if($c[$i]/10000 >= $_POST['cpu'] || (ceil($d[$i])/$sysmemory)*100 >= $_POST['mem']){
								echo "<tr style='color:red'>";
							} else {
								echo "<tr>";
							}
						echo "<td>Processo: " . str_replace('"',"",$e[$i]) . "</td><td> CPU: " . number_format($c[$i]/10000, 2) . "%</td><td> Memoria: " . number_format((ceil($d[$i])/$sysmemory)*100, 2) . "%</td></tr>";
					}
					echo "</table>".$totalcpu."</div></div>";
					$a = snmpwalk($host,"public","hrSWInstalledName");
					$b = snmpwalk($host,"public","hrSWInstalledDate");
					echo '<script>
						$(document).ready(function(){
						  $("#searchsoftware'.str_replace("STRING:","",$sysname).'").on("keyup", function() {
						    var value = $(this).val().toLowerCase();
						    $("#tablesoftware'.str_replace("STRING:","",$sysname).' tr").filter(function() {
						      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						    });
						  });
						});
						</script>';
					echo "<div class='card col-4'><div class='card-header'><b>Softwares Instalados / Data Instalação</b></div><div class='card-body'>";			
					echo "<table id='tablesoftware".str_replace("STRING:","",$sysname)."' class='table table-striped'>";
					echo '<input class="form-control" id="searchsoftware'.str_replace("STRING:","",$sysname).'" type="text" placeholder="Procurar por software..">';
					for($i=0;$i<=sizeof($a);$i++) {
						$chars = array('"', "-", "~");
						echo "<tr><td>Software: " . str_replace($chars," ",$a[$i]) . "</td><td>" . $b[$i] . "</td></tr>";
					}
					echo "</table></div></div>";
					echo "</div>";
			flush();
		    	ob_flush();
			} else {?>
					<script>document.getElementById('divip').innerHTML = "<?php print $zm; ?> <i style='color:red' class='fa fa-remove'></i>";</script>
					<?php
			flush();
		    	ob_flush();
				}
		}
	}
}
?>
</div>
<?php } ?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
		  
        var data = google.visualization.arrayToDataTable([
          ['IP', 'MS']
          <?php print $stringms; ?>
        ]);

        var options = {
          title: 'Tempo de Resposta (MS)',
          hAxis: {title: 'MS',  titleTextStyle: {color: '#434343'}},
          vAxis: {minValue: 0},
	  is3D: true
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
		
        var data2 = google.visualization.arrayToDataTable([
          ['IP', 'MS']
          <?php print $stringip; ?>
        ]);

        var options2 = {
          title: 'Computadores Ativos',
	  is3D: true
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart'));

        chart2.draw(data2, options2);
}
	document.getElementById("loader").remove();
</script>
</div>
<hr>
<div class="jumbotron text-center" style="margin-bottom:0">
  <p>@BASIC.SNMP</p>
</div>
</body>
</html>
