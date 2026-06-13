// Bootstrap Laravel and handle the request...
$app = require_once '/var/www/html/bootstrap/app.php';

try {
    $response = $app->handleRequest(Illuminate\Http\Request::capture());
    $response->send();
} catch (\Throwable $e) {
    // Tampilkan eror asli ke layar secara brutal
    echo "<h1>Eror Asli:</h1><pre>";
    echo $e->getMessage() . "\n\n";
    echo $e->getTraceAsString();
    echo "</pre>";
    die();
}