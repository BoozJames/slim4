<?PHP

require "../vendor/autoload.php";

$n = Dotenv\Dotenv::createImmutable(str_replace('swagger', '', __DIR__));
$n->load();

new Yuri\Slim\constant\Constant();

$demo_controller = array();

// $demo_controller = str_replace('swagger', '', __DIR__) . "src/controller/DemoController.php";
$controller_location = str_replace("swagger", "src/controller", __DIR__);
$classes = array_values(array_diff(scandir($controller_location), array('.', '..')));
foreach ($classes as $class_file) {
    array_push($demo_controller, sprintf("%s/%s", $controller_location, $class_file));
}

$openapi = \OpenApi\Generator::scan($demo_controller);
header('Content-Type: application/json');
// echo $openapi->toJson();
$data = json_decode($openapi->toJson());
$data->servers = array(['url' => "/" . APP_LINK]);
echo json_encode($data);
