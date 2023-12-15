     <!-- NEWS -->
     <?php

     require_once(__DIR__ . '/../admin/DB.php');


     use PO\Lib\DB;

     $db = new DB("localhost", 3306, "root", "", "phpschemafinal");
     $articles;
     $categories = $db->getArticleCategories();
     if (isset($_GET['category'])) {
          $category = $_GET['category'];
          if ($category != null && $category != 0) {
               $articles = $db->getArticlesByCategory($category);
          } else {
               $articles = $db->getArticles();
          }
     } else {
          $articles = $db->getArticles();
     }
     ?>
     <section id="news" data-stellar-background-ratio="2.5">

          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Latest News</h2>
                              <select name="category" id="categoryDropdown">
                                   <option>Choose an option</option>
                                   <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                   <?php endforeach; ?>
                                   <option value="0">All</option>
                              </select>
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
                                        <p><?= $article['category_name']; ?></p>
                                        <div class="author">
                                             <img src="<?= $article['image_url']; ?>" class="img-responsive" alt="">
                                             <div class="author-info">
                                                  <h5><?= $article['username']; ?></h5>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </section>

     <script>
          document.addEventListener("DOMContentLoaded", function() {
               document.getElementById('categoryDropdown').addEventListener('change', function() {
                    let selectedCategory = this.value;
                    let baseUrl = window.location.href.split('?')[0];
                    let newUrl = baseUrl + '?category=' + selectedCategory;
                    window.location.href = newUrl;
               });
          });
     </script>