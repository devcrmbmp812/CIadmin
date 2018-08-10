<?php

$html = '
		<h3>SMS Logs List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>SMS Text</th>
					<th>Sender Number</th>
					<th>Instance Number</th>
				</tr>
			</thead>
			<tbody>';

foreach($all_smslogs as $row):
    $html .= '		
				<tr class="oddrow">
					<td>'.$row['sms_text'].'</td>
					<td>'.$row['sender_number'].'</td>
					<td>'.$row['instance_name'].'</td>
				</tr>';
endforeach;

$html .=	'</tbody>
			</table>			
		 ';



$mpdf = new mPDF('c');

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Codeglamour - SMS Logs List");
$mpdf->SetAuthor("Codeglamour");
$mpdf->watermark_font = 'Codeglamour';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML($html);

$filename = 'SMS Logs_list';

$mpdf->Output($filename . '.pdf', 'D');

exit;

?>