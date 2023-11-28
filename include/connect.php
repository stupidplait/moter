<?
    try {
        // PDO connect
        $connect = new PDO("mysql:host=localhost; dbname=moter", 'root', '');
    } catch(PDOException $e) {
        echo $e;
    }
?>