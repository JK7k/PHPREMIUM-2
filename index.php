<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>zadanie</title>
</head>
<body>
    <header>
        <h1>
            Dodawanie obecności
        </h1>
    </header>
    <section>
        <?php
            $polaczenie=mysqli_connect('localhost','root','','4tie');
            if($polaczenie){
                echo "Połączyliśmy się z bazą danych";
                $zapytanie="SELECT * FROM dane";
                
                $wynik=mysqli_query($polaczenie,$zapytanie);
                while($wiersz=mysqli_fetch_array($wynik)){
                    $imie[]= $wiersz['imie'];
                    $nazwisko[]= $wiersz['nazwisko'];
                    $iddane[]= $wiersz['id'];
                }
                if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $data=$_POST['data'];
                    $czyObecny=0;
                    for($x=0;$x<count($imie);$x++){
                        if(isset($_POST["osoba$iddane[$x]"])){
                        $idosoba=$_POST["osoba$iddane[$x]"];
                        $czyObecny=1;
                        echo $_POST["osoba$iddane[$x]"];
                        
                        echo "<br>";
                        
                        }
                        $insert="insert into obecnosc values(null, '$data','$iddane[$x]','$czyObecny')";
                        if(mysqli_query($polaczenie,$insert)){
                            echo "DODANO DO BAZY";
                        }
                        else{
                            echo "blad";
                        }
                        $czyObecny=0;
                    }

                    echo $data;
                    echo "<br>";
                }
            }
        ?>
        <h2>
            Lista obecności
        </h2>
        <form method="POST">
            <ol>
            <?php
                for ($x=0;$x<count($imie);$x++){
                    echo "
                    <li>
                        <input type='checkbox' value=$iddane[$x] id='osoba$iddane[$x]' name='osoba$iddane[$x]'>
                        <label for='osoba$iddane[$x]'>$imie[$x] $nazwisko[$x]</label>
                        </li>
                        ";
                }
            ?>
            <br>
            <label for="data"> podaj date </label>
            <input type="date" name="data" od="data">
            <br>
            <input type="submit" value="zapisz dane">
            </form>
    <section>
</body>
</html>