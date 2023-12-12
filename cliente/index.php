<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJALA</title>
</head>
<body>
    <?php
    use GuzzleHttp\Client;
    require_once 'vendor/autoload.php';
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];

        $client=new client();
        $api_url = "http://correo/api.php";
        $response = $client->request('GET', $api_url);
        echo $response->getBody();
    }
    ?>
    <form method="post" action="">
        <input type="text" placeholder="NOMBRE" name="nombre">
        <button type="submit">Ojalá</button>
    </form>
</body>
</html>


