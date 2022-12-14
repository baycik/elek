<?php
spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});
function handleCors(){
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, access-control-allow-origin");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Origin:*");
    $method = $_SERVER['REQUEST_METHOD'];
    if( $method == "OPTIONS" ) {
        die();
    }
}
handleCors();
function mb_escape(string $string){
    return mb_ereg_replace('[\x00\x0A\x0D\x1A\x22\x27\x5C]', '\\\0', $string);
}
function argumentsParse( $Class, $method ){
    if( !method_exists($Class,$method) ){
        http_response_code(404);
        die('"Page not found"');
    }
    $arguments=[];
    $reflectionMethod = new ReflectionMethod($Class, $method);
    $method_args_config = $reflectionMethod->getParameters();
    foreach( $method_args_config as $param ){
        $param_name=$param->getName();
        $param_default=$param->isDefaultValueAvailable()?$param->getDefaultValue():null;
        $arguments[]=mb_escape($_REQUEST[$param_name]??$param_default);
    }
    return $arguments;
}
function view( $path, $data ){
    extract($data);
    include "Views/header.php";
    include "Views/{$path}.php";
    include "Views/footer.php";
}

$path=$_GET['page']??'Metin/index';
$page=explode('/',$path);
$cname='\Controllers\\'.$page[0]??'Metin';
$cmethod=$page[1]??'index';
try{
    $Controller=new $cname;
    $arguments= argumentsParse($Controller, $cmethod);
    header("Content-type:text/json");
    echo json_encode( $Controller->$cmethod(...$arguments) );
} catch (Throwable $ex) {
    $code=$ex->getCode();
    $message=$ex->getMessage();
    header("Content-type:text/plain");
    http_response_code($code?$code:'500');
    die($message);
}