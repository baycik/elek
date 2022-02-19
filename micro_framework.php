<?php
spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});

$path=$_GET['page']??'Panel/index';
list($cname,$cmethod)=explode('/',$path);
$cname='\Controllers\\'.$cname; 
try{
    $Controller=new $cname;
    $arguments= argumentsParse($Controller, $cmethod);
    echo $Controller->$cmethod(...$arguments);
} catch (Exception $ex) {
    die("Can't load controller");
}
function argumentsParse( $Class, $method ){
    $arguments=[];
    $reflectionMethod = new ReflectionMethod($Class, $method);
    $method_args_config = $reflectionMethod->getParameters();
    foreach( $method_args_config as $param ){
        $param_name=$param->getName();
        $param_default=$param->isDefaultValueAvailable()?$param->getDefaultValue():null;
        $arguments[]=$_REQUEST[$param_name]??$param_default;
    }
    return $arguments;
}

function view( $path, $data ){
    extract($data);
    include "Views/header.php";
    include "Views/{$path}.php";
    include "Views/footer.php";
}