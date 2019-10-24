<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />
        <link rel="stylesheet" href="style.css">
        <title> PDO </title>
        
    </head>
    <body class="container-fluid">
    <header class="text-center bg-light">
        <h1 class="text-info pb-2">PDO</h1>
    </header>
        
    <section class="row">
        <article class="col-md-2">
            <h2>Ex 01</h2>
            <h4>Tous les clients</h4>
            <?php
            $reponseClients = $bdd->query('SELECT * FROM clients');
            // On affiche chaque entrée une à une
            while ($donnees = $reponseClients->fetch())
            {
            ?>
            <div>
                Nom : <?= $donnees["lastName"]?> <br/>
                Prénom : <?= $donnees["firstName"]?> <br/>
                Date de naissance : <?= $donnees["birthDate"]?> <br/>
                Carte : <?= $donnees["card"]?> <br/>
                N° de carte : <?= $donnees["cardNumber"]?> </p>
            </div>
            <br/>
            <?php
            }

            $reponseClients->closeCursor(); // Termine le traitement de la requête
            ?>
        </article>

        <article class="col-md-2">
            <h2>Ex 02</h2>
            <h4>Types de spectacles</h4>
            <ol>
                <?php
                $reponseShowTypes = $bdd->query('SELECT * FROM showtypes');
                // On affiche chaque entrée une à une
                while ($donneesST = $reponseShowTypes->fetch())
                {
                ?>
                <li> <?= $donneesST["type"]?> </li>
                <?php
                }

                $reponseShowTypes->closeCursor(); // Termine le traitement de la requête
                ?>
            </ol>
            <hr/>
            <h2>Ex 03</h2>
            <h4>20 premiers clients</h4>
                <?php
                $reponseFirstClients = $bdd->query('SELECT * FROM clients LIMIT 0, 20');
                // On affiche chaque entrée une à une
                while ($donneesFC = $reponseFirstClients->fetch())
                {
                ?>
            <div>
                <p>Nom : <?= $donneesFC["lastName"]?> <br/>
                Prénom : <?= $donneesFC["firstName"]?> <br/>
                Date de naissance : <?= $donneesFC["birthDate"]?> <br/>
                Carte : <?= $donneesFC["card"]?> <br/>
                N° de carte : <?= $donneesFC["cardNumber"]?> </p>
            </div>
            <br/>
                <?php
                }

                $reponseFirstClients->closeCursor(); // Termine le traitement de la requête
                ?>
        </article>
        <article class="col-md-2">
            <h2>Ex 04</h2>
            <h4>Clients possédant une carte de fidélité</h4>
                <?php
                $reponseClientsCards = $bdd->query('SELECT * FROM clients WHERE card = true');
                // On affiche chaque entrée une à une
                while ($donneesCC = $reponseClientsCards->fetch())
                {
                ?>
                <div>
                    <p>Nom : <?= $donneesCC["lastName"]?> <br/>
                    Prénom : <?= $donneesCC["firstName"]?> <br/>
                    Date de naissance : <?= $donneesCC["birthDate"]?> <br/>
                    Carte : <?= $donneesCC["card"]?> <br/>
                    N° de carte : <?= $donneesCC["cardNumber"]?> </p>
                </div>
                <br/>
                <?php
                }

                $reponseClientsCards->closeCursor(); // Termine le traitement de la requête
                ?>
        </article>

        <article class="col-md-2">
            <h2>Ex 05</h2>
            <h4>Clients dont le nom commence par "M"</h4>
                <?php
                $reponseClientsM = $bdd->query('SELECT * FROM clients WHERE lastname LIKE "M%"');
                // On affiche chaque entrée une à une
                while ($donneesCM = $reponseClientsM->fetch())
                {
                ?>
                <div>
                    <p>Nom : <?= $donneesCM["lastName"]?> <br/>
                    Prénom : <?= $donneesCM["firstName"]?> </p>
                </div>
                <br/>
                <?php
                }

                $reponseClientsM->closeCursor(); // Termine le traitement de la requête
                ?>
        </article>
        <article class="col-md-4">
        <h2>Ex 06</h2>
            <h4>Spectacles (titre, artiste, date, heure) - 
                Trié par ordre alphabétique. </h4>
                <?php
                $reponseShows = $bdd->query('SELECT * FROM shows ORDER BY title ASC');
                // On affiche chaque entrée une à une
                while ($donneesShows = $reponseShows->fetch())
                {
                ?>
                <div>
                    <p> <?= $donneesShows["title"]?> par <?= $donneesShows["performer"]?> <br/>
                    le <?= $donneesShows["date"]?> à <?= $donneesShows["startTime"]?> </p>
                </div>
                <br/>
                <?php
                }

                $reponseShows->closeCursor(); // Termine le traitement de la requête
                ?>
        </article>
    </section> 
    <hr>   
    <section class="row">
        <article class="col-md-6 m-auto">
                <h2>Ex 07</h2>
                <h4>Clients avec/sans Carte de fidélité</h4>
                <?php
                $reponseIfClientCardOk = $bdd->query('SELECT * FROM clients');
                // On affiche chaque entrée une à une
                while ($donneesIfCCOk = $reponseIfClientCardOk->fetch())
                {
                ?>
                <div>
                    <span> Nom : <?= $donneesIfCCOk["lastName"]?> <br/>
                    Prénom : <?= $donneesIfCCOk["firstName"]?> <br/>
                    Date de naissance : <?= $donneesIfCCOk["birthDate"]?> <br/>
                    </span>
                    <?php
                    if ($donneesIfCCOk["card"] == 1){
                    ?>
                        <span class="text-success">
                        Carte : Oui <br/>
                        N° de carte : <strong> <?= $donneesIfCCOk["cardNumber"]?> </strong> 
                        </span>
                    <?php } 
                    else {
                        ?> 
                        <span class="text-danger"> Carte : Non <br/> 
                        </span>
                        <?php
                    }   
                    ?>
                    
                </div>
                <br/>
                <?php
                }

                $reponseIfClientCardOk->closeCursor(); // Termine le traitement de la requête
                ?>

            </article>

    </section>
    <hr/>
    <footer class="text-center">
    <a href="https://github.com/La-Manu"><i class="fas fa-industry"></i> La Manu</a>
    <br/>
    <br/>
    </footer>


        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
        crossorigin="anonymous">
        </script>
        <!-- Bootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous">
        </script>
        <!-- FontAwesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/js/all.min.js" 
        integrity="sha256-xzrHBImM2jn9oDLORlHS1/0ekn1VyypEkV1ALvUx8lU=" 
        crossorigin="anonymous">
        </script>
        <script>
        $("document").ready(function () {

            $("h2").addClass("text-center text-warning");
            $("h4").addClass("text-center text-muted");
            $("div").addClass("bg-dark text-white rounded");
            
        });
        </script>
    </body>
</html>
