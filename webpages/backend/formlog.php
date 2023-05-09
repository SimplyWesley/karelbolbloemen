<?php

include("../../base/head.php");

require_once("../../require/config.php");

include("./logincheck.php");

$id = $_GET['id'];
$query = "SELECT * FROM `formlog` WHERE id = $id";
$statement = $conn->prepare($query);
$statement->execute();

$formlogs = $statement->fetch();

?>

<a href="./formlogs.php" style="color: inherit; padding-left: 15px;">< Overzicht</a>
<a href="./logout.php" style="color: inherit; padding-left: 15px;">Uitloggen</a>
<div class="container table">
    <p>
        <b>Naam</b>: <?= $formlogs['name'] ?><br>
        <b>Email</b>: <?= $formlogs['email'] ?><br>
        <b>Onderwerp</b>: <?= $formlogs['subject'] ?>
    </p>
    <p><?= $formlogs['message'] ?></p>
</div>