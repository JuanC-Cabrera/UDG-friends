
<?php
//Carga las carpetas
require_once "config/config.php";

require_once "helpers/url_helper.php";

spl_autoload_register(function ($files) {
    include_once "libs/" . $files . ".php";
});
