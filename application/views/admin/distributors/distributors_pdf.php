<?php

$html = '
		<h3>Distributors List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Distributor Name</th>
					<th>Address</th>
					<th>Mobile Number</th>
				</tr>
			</thead>
			<tbody>';

foreach($all_distributors as $row):
    $html .= '		
				<tr class="oddrow">
					<td>'.$row['name'].'</td>
					<td>'.$row['address'].'</td>
					<td>'.$row['mobile'].'</td>
				</tr>';
endforeach;

$html .=	'</tbody>
			</table>			
		 ';



$mpdf = new mPDF('c');

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Codeglamour - Distributors List");
$mpdf->SetAuthor("Codeglamour");
$mpdf->watermark_font = 'Codeglamour';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML($html);

$filename = 'distributors_list';

$mpdf->Output($filename . '.pdf', 'D');

exit;

?>