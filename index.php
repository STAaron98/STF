<?php include 'header.php';  
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'model/database/DB.php';
require_once 'model/classes/address.php';
require_once 'model/classes/extendedInfo.php';
require_once 'model/classes/genre.php';
require_once 'model/classes/travel.php';
require_once 'model/classes/travel_address.php';
require_once 'controller/controller.php';
    
$allowedForUsers = array("home", "aboutUs");

$adminOnly = array("administrationTravel");

$allowedForAdmin = array_merge($adminOnly, $allowedForUsers);


    
$action = 'home';
$reqAction = 'home';           //action unterscheiden in admin und normalen user
$controller = new Controller();
$action = $reqAction;



if (in_array($reqAction, $allowedForUsers))
    $action = $reqAction;

if (method_exists($controller, $action)) {
    ?>
    <main class="<?php echo $action ?>">
        <?php $controller->run($action); //$controller->run($action); ?>
    </main>
<?php } ?> 
<?php include 'footer.php'; ?>

