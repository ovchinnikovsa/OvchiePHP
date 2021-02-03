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

            echo 'articlid:' . $_POST['article_id'];
            echo 'commentText:' . $commentText;
            echo 'authorNames:' . $authorName;

            
            if (isset($_POST['addCommentButton'])) {
                if (strlen($authorName) < 50 && strlen(commentText) < 500) {
                    $query = ("INSERT INTO comments VALUES (NULL, :name, :text, NOW(), :article_id");
                    $comm = $pdo->prepare($query);
                    $comm->execute(['name' => $authorName, 'text' => $commentText, 'article_id' => $_POST['article_id']]);
                    echo "\nPDOStatement::errorInfo():\n";
                    $arr = $comm->errorInfo();
                    print_r($arr);
                    /* array_shift ($pdo->errorInfo());
                    print_r($pdo->errorInfo()); */
                }else {
                    echo '<div class="form-text reg-errors">Вы превысили лимит по символам!</div>';
                }
            }
