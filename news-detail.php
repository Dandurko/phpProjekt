<!DOCTYPE html>
<html lang="en">

<head>

     <title>Health Template - News Page</title>
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

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">

     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">

     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">

</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
     <?php
     include 'web_parts/header.html';
     include 'web_parts/menu.html';
     ?>
     <!-- NEWS -->
     <?php

     require_once(__DIR__ . '/admin/DB.php');


     use PO\Lib\DB;

     $db = new DB("localhost", 3306, "root", "", "phpschemafinal");
     $articles = $db->getArticleById($_GET['id']);
     $recentArticles = $db->getLastTwoArticles($_GET['id']);
     ?>
     <section id="news-detail" data-stellar-background-ratio="0.5" style="background-position: 0px 471.5px;">
          <div class="container">
               <?php foreach ($articles as $article) : ?>
                    <div class="row">

                         <div class="col-md-8 col-sm-7">
                              <!-- NEWS THUMB -->
                              <div class="news-detail-thumb">
                                   <div class="news-image">
                                        <img src="<?= $article['image_url']; ?>" class="img-responsive" alt="">

                                   </div>
                                   <h3><?= $article['title']; ?></h3>
                                   <p><?= $article['text']; ?></p>



                                   <div class="news-social-share">
                                        <h4>Share this article</h4>
                                        <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i>Facebook</a>
                                        <a href="#" class="btn btn-success"><i class="fa fa-twitter"></i>Twitter</a>
                                        <a href="#" class="btn btn-danger"><i class="fa fa-google-plus"></i>Google+</a>
                                   </div>
                              </div>
                         </div>

                         <div class="col-md-4 col-sm-5">
                              <div class="news-sidebar">
                                   <div class="news-author">
                                        <h4>About the author</h4>
                                        <h5><?= $article['users_id']; ?></h5>

                                   </div>

                                   <div class="recent-post">
                                        <h4>Recent Posts</h4>

                                        <?php foreach ($recentArticles as $recentArticle) : ?>
                                             <div class="media">
                                                  <div class="media-object pull-left">
                                                       <a href="news-detail.php?id=<?php echo $recentArticle['id']; ?>"><img src="<?php echo $recentArticle['image_url']; ?>" class="img-responsive" alt=""></a>
                                                  </div>
                                                  <div class="media-body">
                                                       <h4 class="media-heading"><a href="#"><?php echo $recentArticle['title']; ?></a></h4>
                                                  </div>
                                             </div>
                                        <?php endforeach; ?>
                                   </div>
                              </div>
                         </div>

                    </div>
               <?php endforeach; ?>
          </div>
     </section>


     <!-- FOOTER -->
     <footer data-stellar-background-ratio="5">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-4">
                         <div class="footer-thumb">
                              <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>
                              <p>Fusce at libero iaculis, venenatis augue quis, pharetra lorem. Curabitur ut dolor eu elit consequat ultricies.</p>

                              <div class="contact-info">
                                   <p><i class="fa fa-phone"></i> 010-070-0170</p>
                                   <p><i class="fa fa-envelope-o"></i> <a href="#">info@company.com</a></p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="footer-thumb">
                              <h4 class="wow fadeInUp" data-wow-delay="0.4s">Latest News</h4>
                              <div class="latest-stories">
                                   <div class="stories-image">
                                        <a href="#"><img src="images/news-image.jpg" class="img-responsive" alt=""></a>
                                   </div>
                                   <div class="stories-info">
                                        <a href="#">
                                             <h5>Amazing Technology</h5>
                                        </a>
                                        <span>March 08, 2018</span>
                                   </div>
                              </div>

                              <div class="latest-stories">
                                   <div class="stories-image">
                                        <a href="#"><img src="images/news-image.jpg" class="img-responsive" alt=""></a>
                                   </div>
                                   <div class="stories-info">
                                        <a href="#">
                                             <h5>New Healing Process</h5>
                                        </a>
                                        <span>February 20, 2018</span>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                         <div class="footer-thumb">
                              <div class="opening-hours">
                                   <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                                   <p>Monday - Friday <span>06:00 AM - 10:00 PM</span></p>
                                   <p>Saturday <span>09:00 AM - 08:00 PM</span></p>
                                   <p>Sunday <span>Closed</span></p>
                              </div>

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12 border-top">
                         <div class="col-md-4 col-sm-6">
                              <div class="copyright-text">
                                   <p>Copyright &copy; 2018 Your Company

                                        | Design: <a rel="nofollow" href="https://www.facebook.com/tooplate" target="_parent">Tooplate</a></p>
                              </div>
                         </div>
                         <div class="col-md-6 col-sm-6">
                              <div class="footer-link">
                                   <a href="#">Laboratory Tests</a>
                                   <a href="#">Departments</a>
                                   <a href="#">Insurance Policy</a>
                                   <a href="#">Careers</a>
                              </div>
                         </div>
                         <div class="col-md-2 col-sm-2 text-align-center">
                              <div class="angle-up-btn">
                                   <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </footer>


     <!-- SCRIPTS -->
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.sticky.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/magnific-popup-options.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/custom.js"></script>

</body>

</html>