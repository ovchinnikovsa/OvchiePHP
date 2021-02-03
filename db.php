<?php

$dbname = 'simpleblogdb';
$username = 'root';
$password = 'root';
$hostname = 'localhost';


try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(250) NOT NULL,
    body VARCHAR(250) NOT NULL,
    date TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "TABLE posts created successfully<br>";

    $sql = "CREATE TABLE IF NOT EXISTS comments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(250) NOT NULL,
    body VARCHAR(250) NOT NULL,
    date TIMESTAMP
    )";
    $pdo->exec($sql);
    echo "TABLE comments created successfully<br>";
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }



try {
    function DB_table_exists($pdo, $table){
        GLOBAL $pdo;
        try{
            $pdo->query("SELECT 1 FROM $table");
        } catch (PDOException $e){
            return false;
        }
        return true;
    }
    
    if (DB_table_exists($pdo, 'posts')) {
                    
        try {

            $postsFordb = file_get_contents('https://jsonplaceholder.typicode.com/posts');
            $postsFordb = json_decode($postsFordb, true);
            
            foreach ($postsFordb as  $postFordb) {
                $id = $postFordb['id'];
                $title = $postFordb['title'];
                $body = $postFordb['body'];
                $date = date('d-m-Y');
                $qwerty = $pdo->prepare("
                INSERT INTO posts (id, title, body, date) VALUES (:id,:title,:body,:date)
                ");
                $qwerty->bindParam(':id', $id);
                $qwerty->bindParam(':title', $title);
                $qwerty->bindParam(':body', $body);
                $qwerty->bindParam(':date', $date);
                $qwerty->execute();
            }

            echo "Table posts filled successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }    
            
    }
    if (DB_table_exists($pdo, 'comments')) {
            
        try {
          
            $commsFordb = file_get_contents('https://jsonplaceholder.typicode.com/comments?postId=1');
            $commsFordb = json_decode($commFordbs, true);

            foreach ($commsFordb as  $commFordb) {
                $postId = $commFordb['postId'];
                $id = $commFordb['id'];
                $name = $commFordb['name'];
                $body = $commFordb['body'];
                $date = date('d-m-Y');
                $qwerty = $pdo->prepare("
                INSERT INTO comments (postId, id, name, body, date) VALUES (:postId,:id,:name,:body,:date)
                ");
                $qwerty->bindParam(':postId', $postId);
                $qwerty->bindParam(':id', $id);
                $qwerty->bindParam(':name', $name);
                $qwerty->bindParam(':body', $body);
                $qwerty->bindParam(':date', $date);
                $qwerty->execute();
            }          

            echo "Table comments filled successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }    
            
    }
    
}
catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

session_start();

$pdo = null;