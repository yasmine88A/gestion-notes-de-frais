<?php
require 'vendor/autoload.php'; // Pour PhpSpreadsheet et Dompdf

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

$conn = mysqli_connect("localhost", "root", "", "gestion_frais");
if (!$conn) die("Erreur de connexion : " . mysqli_connect_error());

$sql = "SELECT id, date_frais, type, montant, statut FROM notes_frais WHERE statut IN ('Validé', 'Remboursée')";
$result = mysqli_query($conn, $sql);

// Création de l'entête
$rows = [["ID", "Date", "Type", "Montant", "Statut"]];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = [
        $row['id'],
        $row['date_frais'],
        $row['type'],
        $row['montant'],
        $row['statut']
    ];
}

// Vérifie le format demandé
$format = $_GET['format'] ?? 'csv';

if ($format === 'excel') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="notes_frais.csv"');
    $output = fopen('php://output', 'w');
    foreach ($rows as $line) {
        fputcsv($output, $line);
    }
    fclose($output);
    exit;


} elseif ($format === 'pdf') {
    $html = '<h3>Notes de Frais</h3><table border="1" cellpadding="5"><tr><th>ID</th><th>Date</th><th>Type</th><th>Montant</th><th>Statut</th></tr>';
    foreach (array_slice($rows, 1) as $line) {
        $html .= '<tr><td>' . implode('</td><td>', $line) . '</td></tr>';
    }
    $html .= '</table>';
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("notes_frais.pdf", array("Attachment" => 1));
    exit;
} else {
    echo "Format non supporté.";
}
?>
