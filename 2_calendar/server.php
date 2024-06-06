<?php
if (file_exists(__DIR__ . '/index.php')) {
    echo file_get_contents(__DIR__ . '/index.php');
} else {
    echo "404 Not Found";
}

# php -S localhost:8000
# http://127.0.0.1:8000/
# http://localhost:8000

?>
