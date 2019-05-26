<?php
$spreadsheet_url="https://docs.google.com/spreadsheets/d/e/2PACX-1vTPqQ2bSQ8pThq5TT-WJg-JBTCNev_tMNdUmtDiWsBq1Kmc1wCkaoMDnNvlsdLNxzuivpXEzlimD2gt/pub?output=csv";

if(!ini_set('default_socket_timeout', 15)) echo "<!-- unable to change socket timeout -->";

if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
    $row = 1;
    $spreadsheet_data = array();
    while (($data = fgetcsv($handle, ",")) !== FALSE) {
        if($row == 1){ $row++; continue; }
        array_push($spreadsheet_data, array("timestamp" => $data[0], "age" => $data[4], "weight" => $data[6], "height" => $data[7],
        "fat" => $data[10], "mmr" => $data[11]));
        $row++;
    }
    fclose($handle);
}
else
    die("Problem reading csv");
?>