<?php

$db_user=getenv('DB_USER');
$db_password=getenv('DB_PASSWORD');
$db_name=getenv('DB_USER');

/*para conectar ao POSTGRESQL "pgsql:host=$host;port=5432*/

$db = new PDO('pgsql:host=ruby.db.elephantsql.com;port=5432;dbname='.$db_name,$db_user,$db_password);

//alguns atributos de performance.
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//define('APP_NAME', 'PHP REST API TUTORIAL - PROFA MARTA');
?>