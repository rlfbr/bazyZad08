<?php
     $conn = new mysqli('localhost', 'root', '', 'sklep');
     if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
     }
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="styl.css">
     <title>Sklep papierniczy</title>
</head>
<body>
     <section class="baner">
          <h1>W naszym sklepie internetowym kupisz najtaniej</h1>
     </section>
     <section class="srodek">
          <div class="lewy">
               <h3>Promocja 15% obejmuje artykuły:</h3>
               <ul>
                    <?php
                    $sql1 = "SELECT nazwa FROM towary WHERE promocja=1";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                         while($row1 = $result1->fetch_assoc()) {
                              echo "<li>" . $row1["nazwa"] . "</li>";
                         }
                    }
               ?>
               </ul>
          </div>
          <div class="srodkowy">
               <h3>Cena wybranego artykułu w promocji</h3>
               <form action="" method="post">
                    <select name="menuForm">
                         <option>Gumka do mazania</option>
                         <option>Cienkopis</option>
                         <option>Pisaki 60 szt.</option>
                         <option>Markery 4 szt.</option>
                    </select>
                    <input type="submit" name="btn" value="WYBIERZ">
               </form>  
               <?php
               if(isset($_POST['btn'])) {
                    $wybrane = $_POST['menuForm'];

                    $sql2 = "SELECT cena FROM towary WHERE nazwa='$wybrane'";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                         while($row2 = $result2->fetch_assoc()) {
                              $fetchedPrice = $row2["cena"];
                         }
                    }

                    $priceInPromotion = $fetchedPrice * 0.85;
                    $calcPriceInPromotion = round($priceInPromotion, 2);

                    echo "Obliczona cena w promocji: " . $calcPriceInPromotion . " zł.";
               }
               ?>             
               <!-- skrypt 2 -->
          </div>
          <div class="prawy">
               <h3>Kontakt</h3>
               <p>telefon: 123123123<br>e-mail: <a href="mailto:bok@sklep.pl">bok@sklep.pl</a></p>
               <img src="promocja2.png" alt="promocja">
          </div>
     </section>
     <section class="stopka">
          <h4>Autor: Wojciech Kawałko 4ig1</h4>
     </section>
</body>
</html>

<?php
     $conn->close();
?>