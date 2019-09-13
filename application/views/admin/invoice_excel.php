<?php	
	$filename = "Xl_User_Orders_Reports_On_".date('dS_M').".xls";
	
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	$contents = '';
	$contents .= '<table border="0" cellpadding="0" cellspacing="0" id="ctbl">';
	$contents .= '<tr id="atd">';
	$contents .='<td colspan="2" rowspan="2" style="background-color:#1eb3b8;color:white; font-size:16px;"><b>CALLS REPORT</b></td>';
	$contents .= '</tr>';
	$contents .= '<tr id="atd">';
	$contents .='<td colspan="5" rowspan="0" style="background-color:#FFFFFF"; font-size:15px;>&nbsp;</td>';
	$contents .= '</tr>';
	$contents .= '<tr id="atd">';
	$contents .='<td colspan="1" rowspan="0" style="background-color:#FFFFFF; font-size:16px;"><b>Date of Downloading:</b></td>';
	$contents .='<td colspan="1" rowspan="0" align="left" style="background-color:#FFFFFF"; font-size:15px;>'.date('dS M Y').'</td>';
	$contents .= '</tr>';
	$contents .= '<tr id="atd">';
	$contents .='<td colspan="5" rowspan="0" style="background-color:#FFFFFF"; font-size:15px;>&nbsp;</td>';
	$contents .= '</tr>';
	$contents .= '</table>';
	$contents .= '<table border="1" cellpadding="0" cellspacing="0" id="ctbl">';
	$contents .= '<tr id="atd" style="background-color:#1eb3b8;color:#FFFFFF">';
	$contents .= '<td colspan="1" align="center" ><b>S.no. </b></td>';
	$contents .= '<td colspan="2" align="center" ><b>Description</b></td>';
	$contents .= '<td colspan="2" align="center" ><b>Units</b></td>';
	$contents .= '<td colspan="2" align="center" ><b>Nbr Nts/Days</b></td>';
	$contents .= '<td colspan="2" align="center" ><b>Rate</b></td>';
	$contents .= '<td colspan="2" align="center" ><b>Total</b></td>';
	$contents .= " \n";	
	$contents .= '</tr>';
	//$contents .= '</table>';
	//print_r($trip); exit;
		if(count($trip) > 0)
				{	
					$j=1;
					//$contents .= '<table border="1" cellpadding="0" cellspacing="0" id="ctbl">';
					foreach ($trip as $key => $trip) {
						
						$contents .= '<tr id="atd">';	
						$contents .= '<td align="center" colspan="1">'.($j).'</td>';
						$contents .= '<td align="center" colspan="2">'.(($call['type']==2)?'outgoing':(($call['type']==1)?'incoming':'missed')).'</td>';
						$contents .= '<td align="center" colspan="2">'.$call['emp_name'].'</td>';
						$contents .= '<td align="center" colspan="2">'.(($call['type']==2)?$call['to_no']:$call['from_no']).'</td>';
						$contents .= '<td align="center" colspan="2">'.$call['startdate'].'</td>';
						$contents .= '<td align="center" colspan="2">'.$call['enddate'].'</td>';
						$contents .= '<td align="center" colspan="2">'.$call['calltime'].'</td>';
						$contents .= '<td align="center" colspan="2">'.$call['endtime'].'</td>';
						$contents .= '<td align="center" colspan="2">'.$duration.'</td>';
						$contents .= " \n";
						$contents .= '</tr>';
						$j++;
						//echo $contents;
					}
					
				}	
			//$contents .= '</table>';				
	echo $contents;
?>
<style type="text/css">
    body {
        font-family:Verdana, Arial, Helvetica, sans-serif;
        font-size:12px;
        margin:0px;
        padding:0px;
    }
    #atd td{
        padding:3px;
        font-weight:bold;
    }
 #atd2 td{
        padding:10px;
        font-weight:bold;
    }
    #avg_col{
       background-color:#CCFFCC;
    }
    #ctbl, #ctbl td{
        padding:5px;
        border: 1px solid black;
        border-collapse:collapse;
    }
</style>
