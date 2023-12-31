<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Grad</title>
    <script src="https://kit.fontawesome.com/59fa4e08aa.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.es.min.js" integrity="sha512-89Ar0ofqIrPG0GKRxVyihfyrZP3wApwUKRU5SxDLyk/o5OF3yVE6zNm30byp89uKsboFNinM2DEHYGOKTEIvPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
<?php include 'nav.php' ?>
<div class="content-container">
    <section id="img">
        <span>Administration</span>
    </section>
<div id="tableauContainer">
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Code Postal</th>
        <th>Email</th>
        <th>Telephone</th>
        <th>Message</th>
        <th>Etat</th>
    </tr>
    </thead>

<?php
$serveur = "localhost";
$dbname = "grad";
$user = "mysql";
$pass = "mysql";

$db = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$req = $db->query('SELECT id, nom, prenom, cp, email, tel, message, etat FROM form');
while ($donnees = $req->fetch()) { ?>
    <tr>
        <td><?php echo $donnees['nom']; ?></td>
        <td><?php echo $donnees['prenom']; ?></td>
        <td><?php echo $donnees['cp']; ?></td>
        <td><?php echo $donnees['email']; ?></td>
        <td><?php echo $donnees['tel']; ?></td>
        <td><?php echo $donnees['message']; ?></td>
        <td id="etat_<?php echo $donnees['id']; ?>"><?php echo $donnees['etat']; ?></td>
        <td>
            <select name="etat" class="etat-select" data-id="<?php echo $donnees['id']; ?>">
            <option value="❌">Non traitée</option>
                <option value="📝">En cours</option>
                <option value="✅">Traité</option>
            </select>
    </td>
</tr>
<?php }; ?>
</table>
</div>
    <script>
        $(document).ready(function () {
            var container = $("#tableauContainer");

            if (container.length) {
                container.on("change", ".etat-select", function () {
                    var selectedValue = $(this).val();
                    var dataId = $(this).data("id");

                    $('#etat_' + dataId).text(selectedValue);

                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: { id: dataId, etat: selectedValue },
                        success: function (response) {
                            console.log("Réponse du serveur : " + response);
                            console.log("Mise à jour réussie pour l'ID : " + dataId);
                        },
                        error: function () {
                            console.error("Erreur lors de la mise à jour pour l'ID : " + dataId);
                        }
                    });
                });
            } else {
                console.error("L'élément avec l'ID spécifié n'a pas été trouvé.");
            }
        });
    </script>
</body>
</html>