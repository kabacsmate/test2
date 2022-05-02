<!DOCTYPE html>
<html>
    <head>
        <title>mintaZH</title>
    </head> 

    <body>
        <h1>KABÁCS MÁTÉ, NEPTUN: XRM48M</h1>
        <table border=1>
            <tr>
                <th>Színész</th>
                <th>Filmek száma</th>
            </tr>

        <?php
            if(!isset($_GET['N']))
                die("nincs darabszám");

            $num=$_GET['N'];    

            $sql=mysqli_connect("localhost","root","","mintaZH1")
                or die("Hiányzó adatbázis");

            $lekerdezes="SELECT nev as 'Színész', count(*) as 'Filmek száma' "
                ."FROM szinesz INNER JOIN szerepel ON szinesz.id=szerepel.szinesz_id "
                ."INNER JOIN film ON film.id=szerepel.film_id "
                ."GROUP BY szinesz.id having count(*) >='$num'";

            $result=mysqli_query($sql,$lekerdezes)
                or die(mysqli_error($sql));
            
            $background="";
            
            for($i=0; $row=mysqli_fetch_assoc($result); $i++){
                $background = ($i % 2 == 0) ? '' : "style='background-color:grey' ";
                echo "<tr $background><td>".$row['Színész']."</td><td>".$row['Filmek száma']."</td></tr>";
            }

            mysqli_free_result($result);
            mysqli_close($sql);
            
        ?>






        </table>
    </body>
</html>