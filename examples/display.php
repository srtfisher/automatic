<?php
/**
 * Example of Logging in with the Automatic API
 */
require_once('../vendor/autoload.php');
require_once('./config.php');

if (! isset($_GET['token']) AND ! isset($_GET['code']))
  die('Must pass token or code.');

if (empty($clientId) || empty($clientSecret)) {
  die('Example Client ID/Secret not set, see config.php');
}

// Should be something like http://localhost/examples/display.php
$redirectUri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$client = new Srtfisher\Automatic\Client($clientId, $clientSecret, (isset($_GET['token']) ? $_GET['token'] : null), $redirectUri);

if (isset($_GET['code'])) {
  // Find the access token
  $token = $client->getAuthentication()->getAccessToken($_GET['code']);
  ?>
  <h2>Your Access Token: <code><?php echo $token; ?></code></h2>

  <p>
    <a href="<?php echo $redirectUri; ?>?token=<?php echo $token; ?>" class="btn btn-primary">
      Access this example with this access token
    </a>
  </p>
  <?php
  exit;
}
// Has an access token
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login with Automatic</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  </head>

  <body>
    <div class="container">
      <h2>Your Access Token: <code><?php echo $client->getToken(); ?></code></h2>

      <h4>Vehicles</h4>
      <p>
        <code>$client->vehicles->all()</code>
      </p>
      <pre>
<?php
$vehicles = $client->vehicles->all();
var_dump($vehicles);
?>
      </pre>
      <hr>
      <h4>Single Vehicle</h4>
      <?php
      $vehicle_id = $vehicles->first()->id;
      ?>
      <p>
        <code>$client->vehicles->retrieve('<?php echo $vehicle_id; ?>');</code>
      </p>
      <pre>
<?php var_dump($client->vehicles->retrieve($vehicle_id)); ?>
      </pre>
      <hr>
      <h4>Trips</h4>
      <p>
          <code>$client->trips->all()</code>
      </p>
      <pre>
<?php
$trips = $client->trips->all();
var_dump($trips);
?>
        </pre>


    <hr>
    <h4>Single Trip</h4>
    <?php
    $trip_id = $trips->first()->id;
    ?>
    <p>
      <code>$client->trips->retrieve('<?php echo $trip_id; ?>');</code>
    </p>
    <pre>
<?php var_dump($client->trips->retrieve($trip_id)); ?>
    </pre>

    </div>
  </body>
</html>
