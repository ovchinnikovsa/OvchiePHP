<?php

require 'db.php';

            if (isset($_POST['authorName'])) {
                $authorName = $_POST['authorName'];
                if ($authorName == '') {
                    unset($authorName);
                }
            }
            
            if (isset($_POST['commentText'])) {
                $commentText = $_POST['commentText'];
                if ($commentText == '') {
                    unset($commentText);
                }
            }

            $authorName = stripslashes($authorName);
            $authorName = htmlspecialchars($authorName);
            $authorName = trim($authorName);
            $commentText = stripslashes($commentText);
            $commentText = htmlspecialchars($commentText);
            $commentText = trim($commentText);


            
            if (isset($_POST['addCommentButton'])) {
                if (strlen($authorName) < 50 && strlen($commentText) < 500) {

                    $comm = $pdo->prepare("
                    INSERT INTO comments (id, name, text, date, article_id) VALUES (NULL,:name,:text,NOW(),:article_id)
                    ");
                    $comm->bindParam(':name', $authorName);
                    $comm->bindParam(':text', $commentText);
                    $comm->bindParam(':article_id', $_POST['article_id']);
                    $comm->execute();
                    header("HTTP/1.1 301 Moved Permanently");
                    header('Location: ' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] ."/indexSingle.php?id=" . $_POST['article_id']);
                }else {
                    echo '<div class="form-text reg-errors">Вы превысили лимит по символам!</div>';
                }
            }
