<?php
include('../dbconn.php');

if (isset($_POST["deletebtn"])) {

    $delete_this = $_POST["deletebtn"];

    $query = ("DELETE FROM messages WHERE id= :id_element");
    $statement = $conn->prepare($query);
    $data = [':id_element' => $delete_this];
    $statement->execute($data);
}

// if (isset($_POST["deletebtn2"])) {
//     $url = "https://api.sheety.co/89d501d064b64dfce8652335b3532d76/book/foglio1";

//     $response = file_get_contents($url);
//     $data = json_decode($response, true);
// }
?>
<!DOCTYPE html>
<html>
<?php include("../php/head.php"); ?>

<body>
    <?php include("../php/nav.php"); ?>
    <div class="row-6">
        <div class=" btndiv col d-flex justify-content-center mt-5">
            <button data-table-id="table1" class="btn btn-danger m-2">Message</button>
            <button data-table-id="table2" class="btn btn-danger m-2">Guest Book</button>
            <button data-table-id="table3" class="btn btn-danger m-2">Gallery</button>
        </div>
    </div>

    <div class="row-6 p-5">
        <div class="col">
            <table id="table1" class="table table-bordered table-striped border border-3">
                <thead>
                    <!-- I know that the style tag is shitty here but I needed a quick solution... so don't blame me u.u -->
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 25%;">
                        <col style="width: 55%;">
                    </colgroup>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="2">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include("../dbconn.php");

                    $query = ("SELECT * FROM messages ORDER by id");

                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $results = $statement->fetchAll();

                    foreach ($results as $row) {
                    ?>
                        <tr>
                            <td><?= $row['names']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['content']; ?></td>
                            <td>
                                <form method="post">
                                    <button type="submit" name="deletebtn" value="<?= $row['id'] ?>" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <table id="table2" style="display: none;" class="table table-bordered table-striped border border-3">
                <thead>
                    <!-- I know that the style tag is shitty here but I needed a quick solution... so don't blame me u.u -->
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 25%;">
                        <col style="width: 55%;">
                    </colgroup>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="2">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $url = "https://api.sheety.co/89d501d064b64dfce8652335b3532d76/book/foglio1";

                    $response = file_get_contents($url);
                    $data = json_decode($response, true);

                    foreach ($data["foglio1"] as $row) {
                    ?>
                        <tr>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['message']; ?></td>
                            <td>
                                <form method="post">
                                    <button type="submit" name="deletebtn2" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>