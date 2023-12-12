     <!-- NEWS -->
     <?php

     require_once(__DIR__ . '/../admin/DB.php');


     use PO\Lib\DB;

     $db = new DB("localhost", 3306, "root", "", "phpschemafinal");
     $articles = $db->getArticles();
     ?>
     <section id="news" data-stellar-background-ratio="2.5">

          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Latest News</h2>
                         </div>
                    </div>

                    <?php foreach ($articles as $article) : ?>
                         <div class="col-md-4 col-sm-6">
                              <!-- NEWS THUMB -->
                              <div class="news-thumb wow fadeInUp" data-wow-delay="0.8s">
                              <a href="news-detail.php?id=<?= $article['id']; ?>">

                                        <img src="<?= $article['image_url']; ?>" class="img-responsive" alt="">
                                   </a>
                                   <div class="news-info">
                                        <span><?= $article['date']; ?></span>
                                        <h3><?= $article['title']; ?></h3>
                                        <p><?= $article['content']; ?></p>
                                        <div class="author">
                                             <img src="<?= $article['image_url']; ?>" class="img-responsive" alt="">
                                             <div class="author-info">
                                                  <h5><?= $article['users_id']; ?></h5>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </section>