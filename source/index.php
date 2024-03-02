<?php 

require './header.php';

$quantity = 10;
$limit = 2;

$page = $_GET["page"];
if(!is_numeric($page)) $page = 1;
if($page < 1) $page = 1;


$sql = "SELECT COUNT(*) FROM articles";
$rowCount = $pdo->prepare($sql);
$rowCount->execute();
$num = $rowCount->fetchColumn(0);

$pages = $num/$quantity;
$pages = ceil($pages);
if($page > $pages) $page = 1;

if(!isset($list)) $list = 0;
$list = ($page - 1) * $quantity;


$articles = $pdo->query("SELECT * FROM articles ORDER BY articles.date DESC LIMIT $quantity OFFSET $list");
foreach ($articles as $article) { ?>

    <!-- BODY -->

    <div class="blog">
        <div class="card" style="width: 100%;">
            <div class="card-body">
              <h5 class="card-title"><a href="<?php echo ('indexSingle.php' . '?id=' . $article['id']) ?>"><?php echo $article['header'] ?></a></h5>
              <h6 class="card-subtitle mb-2 text-muted"><?php echo date("d.m.Y", strtotime($article['date'])) ?></h6>
              <p class="over"><?php echo $article['text'] ?></p>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- PAGE NAV -->

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php 
                if ($page > 1){ 
                    echo '<li class="page-item">
                    <a class="page-link" href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($page - 1) . '">Предыдущая</a></li>';
                } 
                else {
                    echo '<li class="page-item disabled">
                    <a class="page-link disabled" href="">Предыдущая</a></li>';
                } 
            ?>

            <?php                      
                $thisPage = $page;
                $start = $thisPage - $limit;
                $end = $thisPage + $limit;
                for ($j = 1; $j <= $pages; $j++){
                    if ($j >= $start && $j <= $end){
                        if ($j == $thisPage) {                            
                            echo '<a class="page-link" style="border: 1px solid black" href="' . $_SERVER['SCRIPT_NAME'] . 
                            '?page=' . $j . '"><strong >' . $j . 
                            '</strong></a> &nbsp; '; 
                        }
                        else {
                            echo '<a class="page-link"  href="' . $_SERVER['SCRIPT_NAME'] . 
                            '?page=' . $j . '">' . $j . '</a> &nbsp; '; 
                        } 
        
                    } 
                } 
            ?>

            <?php 
                if ($page < $pages){ 
                    echo '<li class="page-item">
                    <a class="page-link" href="' . $_SERVER['SCRIPT_NAME'] . '?page=' . ($page + 1) . '">Следующая</a></li>';
                } 
                else {
                    echo '<li class="page-item disabled">
                    <a class="page-link disabled" href="">Следующая</a></li>';
                } 
            ?>

        </ul>
    </nav>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html>