
<div class="row">
    <div class="box col-md-12" id="head">
        <div class="box-content">
        <div style="float:left; width:50%; ">
<?php
include "FusionCharts.php";
include "Functions.php";


$strXML = "";
$strXML = "<chart caption = 'Habilidades' bgColor='' baseFontSize='12' showValues='1' xAxisName='Anios' >";
for ($i=0; $i < 7; $i++) { 
    $strXML .= "<set label = '".$info[$i]->name."' value ='".$info[$i]->visits_number."' />";
}

$strXML .= "</chart>";

echo renderChartHTML("Pie3D.swf", "",$strXML, "Habilidades", 600, 400, false);
?>
</div>
<div style="float:left; width:50%; ">
<?php

$strXML = "";
$strXML = "<chart caption = 'Tecnologias' bgColor='' baseFontSize='12' showValues='1' xAxisName='Anios' >";
for ($i=7; $i < 16; $i++) { 
    $strXML .= "<set label = '".$info[$i]->name."' value ='".$info[$i]->visits_number."' />";
}
$strXML .= "</chart>";

echo renderChartHTML("Pie3D.swf", "",$strXML, "Tecnologías", 500, 400, false);
?>  

</div>
        </div>
