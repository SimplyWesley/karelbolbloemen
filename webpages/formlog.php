<?php

include("../base/head.php");

require_once("../sql/config.php");

$id = $_GET['id'];
$query = "SELECT * FROM `formlog` WHERE id = $id";
$statement = $conn->prepare($query);
$statement->execute();

$formlogs = $statement->fetchAll();

?>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Onderwerp</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formlogs as $formlog) : ?>
                <tr>
                    <td><?= $formlog['name'] ?></td>
                    <td><?= $formlog['email'] ?></td>
                    <td><?= $formlog['subject'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="message">
        <?php foreach ($formlogs as $formlog) : ?>
            <h2>Bericht</h2>
            <p class="text-center"><?= $formlog['message'] ?></p>
        <?php endforeach; ?>
    </div>
</div>