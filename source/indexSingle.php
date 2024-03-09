<?php require 'header.php';

$articleId = intval($_GET['id']);
$query = ("SELECT * FROM articles WHERE $articleId = id");
$article = $pdo->query($query);
$single = $article->fetch();

$query = ("SELECT * FROM comments WHERE article_id = $articleId");
$commentObject = $pdo->query($query);
$comment = $commentObject->fetchAll();

?>

<!-- ARTICLE -->

    <div class="single">
        <h1><?php echo $single['header']; ?></h1>
        <h6><?php echo $single['date']; ?></h6>
        <p><?php echo $single['text']; ?></p>
    </div>


<!-- COMMENT INPUT -->
<?php if (isset($_SESSION['email'])) { ?>
<form action="add_comment.php" method="POST" name="addCommentForm">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Ваше имя</label>
        <input name="authorName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nickname">
    </div>
        <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Текст коментария</label>
        <textarea name="commentText" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Не более 500 символов"></textarea>
    </div>
    <input name="addCommentButton" class="btn btn-outline-dark" type="submit" value="Отправить">
    <input name="article_id" type="hidden" value="<?php echo $articleId; ?>">


    </form>

<?php
    }else{
        echo '<div id="authorized">
                <h1>Чтобы оставлять комментарии, вы должны войти или зарегестрироваться!</h1>
                <a href="logIn.php">Войти</a>
                <a href="registration.php">Зарегистрироваться</a>
             </div>';
    }
?>

<!-- COMMENT BLOCK -->

<?php foreach ($comment as  $commentBlock) { ?>

    <div class="comment-block">
        <div class="comment-header">
            <p class="comment-author-name"><?php echo $commentBlock['name']; ?></p>
            <p class="comment-date"><?php echo date("d.m.Y", strtotime($commentBlock['date'])); ?></p>
        </div>
        <p class="comment-text"><?php echo $commentBlock['text']; ?></p>
    </div>

<?php } ?>
