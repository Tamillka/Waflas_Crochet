<?php
require '../../assets/con_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lietotajvards = htmlspecialchars($_POST['lietotajvards']);
    $vards = htmlspecialchars($_POST['vards']);
    $uzvards = htmlspecialchars($_POST['uzvards']);
    $epasts = htmlspecialchars($_POST['epasts']);
    $talrunis = htmlspecialchars($_POST['talrunis']);
    $loma = htmlspecialchars($_POST['loma']);
    $parole = $_POST['parole'];
    if (empty($parole)) {
        echo json_encode([
            'success' => false,
            'message' => 'Parole ir obligāta!',
        ]);
        exit;
    }
    $hashed = password_hash($parole, PASSWORD_DEFAULT);

    if (!empty($lietotajvards) && !empty($vards) && !empty($uzvards) && !empty($epasts) && !empty($talrunis) && !empty($loma) && !empty($parole)) {
        $check_query = $savienojums->prepare("SELECT Epasts FROM Waflas_lietotaji WHERE Epasts = ? AND Radits = 1");
        $check_query->bind_param("s", $epasts);
        $check_query->execute();
        $check_query->store_result();

        if ($check_query->num_rows > 0) {
            echo json_encode([
                'success' => false,
                'message' => 'Lietotājs ar tādu e-pastu jau pastāv!',
            ]);
        } else {
            $vaicajums = $savienojums->prepare("INSERT INTO Waflas_lietotaji(Lietotajvards, Vards, Uzvards, Epasts, Talrunis, Loma, Parole) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $vaicajums->bind_param("sssssss", $lietotajvards, $vards, $uzvards, $epasts, $talrunis, $loma, $hashed);

            if ($vaicajums->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Lietotājs veiksmīgi pievienots!',
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Kļūda saglabājot lietotāju: ' . $vaicajums->error,
                ]);
            }
            $vaicajums->close();
        }
        $check_query->close();
        $savienojums->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Visi ievades lauki nav aizpildīti!',
        ]);
    }
}
?>