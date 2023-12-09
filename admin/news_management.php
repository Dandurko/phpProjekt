<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['login'])) {
     header("Location: login.php");
}
?>
<html lang="en">

<head>

     <head>

          <title>Health - Medical Website Template</title>
          <!--

Template 2098 Health

http://www.tooplate.com/view/2098-health

-->
          <meta charset="UTF-8">
          <meta http-equiv="X-UA-Compatible" content="IE=Edge">
          <meta name="description" content="">
          <meta name="keywords" content="">
          <meta name="author" content="Tooplate">
          <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

          <link rel="stylesheet" href="../css/bootstrap.min.css">
          <link rel="stylesheet" href="../css/font-awesome.min.css">
          <link rel="stylesheet" href="../css/animate.css">
          <link rel="stylesheet" href="../css/owl.carousel.css">
          <link rel="stylesheet" href="../css/news_management.css">
          <link rel="stylesheet" href="../css/owl.theme.default.min.css">

          <!-- MAIN CSS -->
          <link rel="stylesheet" href="../css/tooplate-style.css">

     </head>
</head>

<body>
     <div id="logout">
          <a  href="logout.php">Logout</a>
     </div>
     <?php

     require_once(__DIR__ . '/../admin/DB.php');


     use PO\Lib\DB;

     $db = new DB("localhost", 3306, "root", "", "phpschema");
     $userId = $_SESSION['userId'];
     $articles = $db->getArticlesById($userId);
     $categories = $db->getARticleCategories();
     ?>
     <section id="news" data-stellar-background-ratio="2.5">

          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>News by me</h2>
                              <button id="insertBtn">Add new</button>
                         </div>
                    </div>
                    <div>
                         <form id="insertForm" class="hidden" action="insert_logic.php" method="POST">
                              <input type="text" name="title" id="">
                              <input type="text" name="text" id="">
                              <input type="text" name="image_url" id="">
                              <input type="submit" name="submit" value="Vloz">
                         </form>
                         <form id="updateForm" class="hidden" action="update_logic.php" method="POST">
                              <input type="text" name="title" id="">
                              <input type="text" name="text" id="">
                              <input type="text" name="image_url" id="">
                              <input hidden type="text" name="id">
                              <input type="submit" name="submitt" value="Vloz">
                         </form>
                    </div>
                    <?php foreach ($articles as $article) : ?>
                         <div class="col-md-4 col-sm-6">
                              <!-- NEWS THUMB -->
                              <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                                   <a href="news-detail.html">
                                        <img src="<?= $article['image_url']; ?>" class="img-responsive" alt="">
                                   </a>
                                   <div class="news-info">
                                        <span><?= $article['date']; ?></span>
                                        <h3><a href="news-detail.html"><?= $article['title']; ?></a></h3>
                                        <p><?= $article['content']; ?></p>
                                        <div class="author">
                                             <img src="<?= $article['image_url']; ?>" class="img-responsive" alt="">
                                             <div class="author-info">
                                                  <h5><?= $article['users_id']; ?> <a href="delete_logic.php?id=<?= $article['id']; ?>">Delete</a></h5>
                                                  <button id='<?= $article['id']; ?>' class="updateBtn">Update</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </section>
     <script src="news_management.js"></script>
</body>

</html>