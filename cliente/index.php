<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJALA</title>
</head>
<body>
    <form method="post" action="">
        <input type="text" placeholder="NOMBRE" name="nombre">
        <button type="submit">Ojalá</button>
    </form>

    <?php
    use GuzzleHttp\Client;
    require_once 'vendor/autoload.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['nombre'])){
            $nombre = $_POST['nombre'];
            $client=new client();
            $api_url = "http://correo/api.php";
            $response = $client->request('GET', $api_url."?nombre=".$nombre);
            echo $response->getBody();
        }
    }
    ?>
</body>
</html>


