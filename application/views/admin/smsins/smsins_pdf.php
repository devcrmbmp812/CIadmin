<?php

$html = '
		<h3>SMS In List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Gateway</th>
					<th>Originator</th>
					<th>Message</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>';

foreach($all_smsins as $row):
    $html .= '		
				<tr class="oddrow">
					<td>'.$row['gateway'].'</td>
					<td>'.$row['originator'].'</td>
					<td>'.$row['message'].'</td>
					<td>'.$row['status'].'</td>
				</tr>';
endforeach;

$html .=	'</tbody>
			</table>			
		 ';



$mpdf = new mPDF('c');

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Codeglamour - SMS In List");
$mpdf->SetAuthor("Codeglamour");
$mpdf->watermark_font = 'Codeglamour';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML($html);

$filename = 'SMS Ins_list';

$mpdf->Output($filename . '.pdf', 'D');

exit;

?>