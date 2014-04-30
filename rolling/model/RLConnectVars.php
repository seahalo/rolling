<?php
  // Define database connection constants
  define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
  define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT'));
  define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
  define('DB_PASSWORD',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
  define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));  
  
  define('DB_DSN', 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT);
?>