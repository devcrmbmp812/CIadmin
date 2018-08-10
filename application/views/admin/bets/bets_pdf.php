<?php

$html = '
		<h3>Bets List</h3>
		<table border="1" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Bet Date</th>
					<th>Bet Draw</th>
					<th>Bet Amount</th>
					<th>Bet Number</th>
					<th>Mobile Number</th>
					<th>Bet Code</th>
					<th>Bet Text</th>
					<th>Text Code</th>
				</tr>
			</thead>
			<tbody>';

foreach($all_bets as $row):
    $html .= '		
				<tr class="oddrow">
					<td>'.$row['bet_date'].'</td>
					<td>'.$row['bet_draw'].'</td>
					<td>'.$row['bet_amt'].'</td>
					<td>'.$row['bet_number'].'</td>
					<td>'.$row['mobile'].'</td>
					<td>'.$row['bet_code'].'</td>
					<td>'.$row['bet_text'].'</td>
					<td>'.$row['text_code'].'</td>
				</tr>';
endforeach;

$html .=	'</tbody>
			</table>			
		 ';



$mpdf = new mPDF('c');

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Codeglamour - Bets List");
$mpdf->SetAuthor("Codeglamour");
$mpdf->watermark_font = 'Codeglamour';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->WriteHTML($html);

$filename = 'bets_list';

$mpdf->Output($filename . '.pdf', 'D');

exit;

?>