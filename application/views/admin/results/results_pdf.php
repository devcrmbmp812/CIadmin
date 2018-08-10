<?php

$html = '
		<h3>Results List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Draw Time</th>
					<th>Draw Date</th>
					<th>Result</th>
				</tr>
			</thead>
			<tbody>';

foreach($all_results as $row):
    $html .= '		
				<tr class="oddrow">
					<td>'.$row['drawtime'].'</td>
					<td>'.$row['drawdate'].'</td>
					<td>'.$row['result'].'</td>
				</tr>';
endforeach;

$html .=	'</tbody>
			</table>			
		 ';



$mpdf = new mPDF('c');

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Codeglamour - Results List");
$mpdf->SetAuthor("Codeglamour");
$mpdf->watermark_font = 'Codeglamour';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML($html);

$filename = 'results_list';

$mpdf->Output($filename . '.pdf', 'D');

exit;

?>