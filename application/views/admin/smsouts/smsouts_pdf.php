<?php

$html = '
		<h3>SMS Out List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>SMS Text</th>
					<th>Recipient Number</th>
					<th>Instance Name</th>
					<th>Message Status</th>
				</tr>
			</thead>
			<tbody>';

foreach($all_smsouts as $row):
    $html .= '		
				<tr class="oddrow">
					<td>'.$row['sms_text'].'</td>
					<td>'.$row['recipient_number'].'</td>
					<td>'.$row['instance_name'].'</td>
					<td>'.$row['msg_status'].'</td>
				</tr>';
endforeach;

$html .=	'</tbody>
			</table>			
		 ';



$mpdf = new mPDF('c');

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Codeglamour - SMS Out List");
$mpdf->SetAuthor("Codeglamour");
$mpdf->watermark_font = 'Codeglamour';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML($html);

$filename = 'SMS Outs_list';

$mpdf->Output($filename . '.pdf', 'D');

exit;

?>