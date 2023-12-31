<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Grad</title>
    <script src="https://kit.fontawesome.com/59fa4e08aa.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.es.min.js" integrity="sha512-89Ar0ofqIrPG0GKRxVyihfyrZP3wApwUKRU5SxDLyk/o5OF3yVE6zNm30byp89uKsboFNinM2DEHYGOKTEIvPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>
<?php include 'nav.php'?>
<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$user = "mysql";
$mdp = "mysql";
$dbco = new PDO("mysql:host=localhost;dbname=grad", $user, $mdp);

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $nom = $_POST["pseudo"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE pseudo = ?";
    $get_user = $dbco->prepare($sql);
    $get_user->execute(array($nom));

    if ($get_user->rowCount() > 0) {
        $data = $get_user->fetch();

        if (password_verify($password, $data['password'])) {
            echo "Connexion effectuée";
            $_SESSION['pseudo'] = $nom;

            if ($nom === 'admin') {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            echo "Mot de passe incorrect";
        }
    } else {
        echo "Nom d'utilisateur non trouvé";
    }
}
?>

<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Connexion</p>
                                    <form class="mx-1 mx-md-4" action="" method="post">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="form3Example1c" class="form-control" name="pseudo" />
                                                <label class="form-label" for="form3Example1c">Votre nom d'utilisateur</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3Example4c" class="form-control" name="password" />
                                                <label class="form-label" for="form3Example4c">Mot de passe</label>
                                            </div>
                                        </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" name="connexion" class="btn btn-primary btn-lg">Se connecter</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="../Ressources/logo.jpg"
                                     class="img-fluid" alt="">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php'?>
</body>
</html>






<style>
#floatingInput {
    width: 200px;
    height: 30px;
}

#floatingPassword {
    width: 200px;
    height: 30px;
}

.btn {
    width: 200px;
    height: 40px;
}

</style>