<!DOCTYPE html>
<html>
<head>
    <title>Kalorienrechner</title>
</head>

<body> 
    <form method="post" action=""> <!--  Form für das Einfügen der Zahlen und abschicken der Eingaben  -->
        
        <label for="Geschlecht">Geschlecht</label>
        <select id="Geschlecht" name="Geschlecht" required>
            <option value="">Bitte wählen</option>
            <option value="M">M</option>
            <option value="W">W</option>
        </select>
        <br><br>

        <label for="Alter">Alter</label>
        <input type="text" id="Alter" name="Alter" required><br><br>
        
        <label for="Gewicht">Gewicht in kg</label>
        <input type="text" id="Gewicht" name="Gewicht" required><br><br>

        <label for="Körpergröße">Körpergröße in cm</label>
        <input type="text" id="Körpergröße" name="Körpergröße" required><br><br>

        <label for="Schlaf">Schlaf in Stunden</label>
        <input type="text" id="Schlaf" name="Schlaf"><br><br>

        <label for="Sitzend">Ausschließlich sitzend oder liegend</label>
        <input type="text" id="Sitzend" name="Sitzend"><br><br>

        <label for="SitzendA">Vorwiegend sitzende Tätigkeiten, kaum körperliche Aktivitäten</label>
        <input type="text" id="SitzendA" name="SitzendA"><br><br>

        <label for="StehendS">Überwiegende sitzende Tätigkeiten, dazwischen auch stehende und gehende Tätigkeiten</label>
        <input type="text" id="StehendS" name="StehendS"><br><br>

        <label for="Stehend">Hauptsächlich stehende und gehende Aktivitäten</label>
        <input type="text" id="Stehend" name="Stehend"><br><br>

        <label for="Körper">Körperlich Anstrengende Arbeiten </label>
        <input type="text" id="Körper" name="Körper"><br><br>


        <input type="submit" name="berechnen" value="Berechnen"><br><br>
    </form>

    <?php
    if (isset($_POST['berechnen'])) {
        $alter = $_POST['Alter'];
        $gewicht = $_POST['Gewicht'];
        $geschlecht = $_POST['Geschlecht'];
        $größe = $_POST['Körpergröße'];
        $schlaf = $_POST['Schlaf'];
        $sitzendLiegend = $_POST['Sitzend'];
        $sitzendAktivität = $_POST['SitzendA'];
        $stehendSitzen = $_POST['StehendS'];
        $stehend = $_POST['Stehend'];
        $körperlich = $_POST['Körper'];

        //Fall für nicht Befüllung der 24 Stunden. 
        $Day = 24 - $schlaf - $sitzendLiegend - $sitzendAktivität - $stehendSitzen - $stehend - $körperlich;
        if($Day > 0) {
            $schlaf = $schlaf + $Day;
        }elseif ($Day < 0) {
            $Day = abs($Day);
            echo "Sie haben zu viele Stunden für einen Tag eingegeben. Bitte füllen Sie die Felder noch einmal richtig aus. <br><br>";
            echo "Anzahl Stunden über 24 Stunden: $Day <br><br>";
        }

        //Brechnung der Kalorien je nach geschlecht.
        if($geschlecht == "M") {
            $kalv = 66.47 + (13.7 * $gewicht) + (5 * $größe) - (6.8 * $alter); // Normaler Kalorienverbrauch ohne Stundendaten
            $kalv = round($kalv);
            echo "Allgemeiner Kalorienbedarf: $kalv<br><br>";
            $pal = ($schlaf * 1.2 + $sitzendLiegend * 1.2 + $sitzendAktivität * 1.4 + $stehendSitzen * 1.6 + $stehend * 1.8 + $körperlich * 2.1) / 24;
            $kalPAL = round($kalPAL = $kalv * $pal); //Kalorienverbrauch mit PAL
            echo "Berechneter Kalorienverbrauch für 24 Stunden: $kalPAL" ;
        }else {
            $kalv = 655.1 + (9.6 * $gewicht) + (1.8 * $größe) - (4.7 * $alter);
            $kalv = round($kalv);
            echo "Allgemeiner Kalorienbedarf: $kalv<br><br>";
            $pal = ($schlaf * 1.2 + $sitzendLiegend * 1.2 + $sitzendAktivität * 1.4 + $stehendSitzen * 1.6 + $stehend * 1.8 + $körperlich * 2.1) / 24;
            $kalPAL = round($kalPAL = $kalv * $pal);
            echo "Berechneter Kalorienverbrauch für 24 Stunden: $kalPAL";
        }
    }
    ?>
</body>
</html>