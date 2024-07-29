<?php
include("../dbconn.php");

if (isset($_POST['send'])) {
    $name = $_POST['names'];
    $email = $_POST['email'];
    $content = $_POST['content'];

    // insert data into db
    $query = "INSERT INTO `messages` (names, email, content) VALUES (:names, :email, :content)";
    $query_run = $conn->prepare($query);

    $data = [
        ':names' => $name,
        ':email' => $email,
        ':content' => $content,
    ];

    $query_execute = $query_run->execute($data);

    // insert into Google spreadsheet by API
    $url = "https://api.sheety.co/89d501d064b64dfce8652335b3532d76/book/foglio1";

    $data_sheet = [
        'foglio1' => [
            'name' => $name,
            'email' => $email,
            'message' => $content
        ]
    ];

    // important topic how to  Initialize  cUrl...comunication with a server
    // Initialization
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // this indicates the type of data we are sending in this case Json type
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    // request is  POST
    curl_setopt($ch, CURLOPT_POST, true);
    // the data we are sending
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_sheet));

    // Disable SSL Verification...I know is not safe but it resolved my problem
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $response = curl_exec($ch);

    // Close cURL session
    curl_close($ch);
}

?>
<!DOCTYPE html>
<html>
<?php include("../php/head.php"); ?>

<body>
    <?php include("../php/nav.php"); ?>
    <section>
        <h1 class="text-center text-white my-5">Fill the form!</h1>
        <div class="container">
            <form class="row g-3" method="post">
                <div class="col-md-6">
                    <label for="names" class="form-label">Name</label>
                    <input type="text" class="form-control" id="names" name="names">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Message</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="send"> Send <i class="fa-regular fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>