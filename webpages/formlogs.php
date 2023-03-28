<?php

include("../base/head.php");

require_once("../sql/config.php");

if (!isset($_GET['dir'])) {
    $_GET['dir'] = 0;
}

if ($_GET['dir'] == 0) {
    $opposite = 1;
} else {
    $opposite = 0;
}

switch ($_GET['dir']) {
    case 1:
        $orderBy = " ORDER BY id ASC";
        break;

    case 0:
        $orderBy = " ORDER BY id DESC";
        break;

    default:
        $orderBy = " ORDER BY id DESC";
        break;
}

$query = "SELECT * FROM `formlog`" . $orderBy;
$statement = $conn->prepare($query);
$statement->execute();

$formlogs = $statement->fetchAll();

?>

<div class="table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Email</th>
                <th>Onderwerp</th>
                <th>Details</th>
                <?php

                if ($opposite == 0) {
                ?>
                    <th><a href="formlogs.php?dir=<?php echo $opposite; ?>">↑↓</a></th>
                <?php
                } else {
                ?>
                    <th><a href="formlogs.php?dir=<?php echo $opposite; ?>">↑↓</a></th>
                <?php
                }

                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($formlogs as $formlog) : ?>
                <tr>
                    <td><?= $formlog['id'] ?></td>
                    <td><?= $formlog['name'] ?></td>
                    <td><?= $formlog['email'] ?></td>
                    <td><?= $formlog['subject'] ?></td>
                    <td><a href="formlog.php?id=<?= $formlog['id'] ?>">Bekijk details</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>