<p>User index view</p>
<?php 
    if(empty($data)) {
    echo '<pre>';
    var_dump('Users not found, empty set');
    echo '</pre>';
    } else {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
?>