<?php
     require_once(__DIR__ . '/../admin/DB.php');


     use PO\Lib\DB;

     $db = new DB("localhost", 3306, "root", "", "phpschemafinal");
     $doctors = $db->getDoctors();
     
?>
   <section id="team" data-stellar-background-ratio="1">
    <div class="container">
         <div class="row">

              <div class="col-md-6 col-sm-6">
                   <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                   </div>
              </div>

              <div class="clearfix"></div>
              <?php foreach ($doctors as $doctor) : ?>
              <div class="col-md-4 col-sm-6">
                   <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <img src="images/team-image1.jpg" class="img-responsive" alt="">
                             <div class="team-info">
                                  <h3><?= $doctor['first_name']; ?> <?= $doctor['second_name']; ?></h3>
                                  <p>General Principal</p>
                                  <div class="team-contact-info">
                                       <p><i class="fa fa-phone"></i> 010-020-0120</p>
                                       <p><i class="fa fa-envelope-o"></i> <a href="#">general@company.com</a></p>
                                  </div>
                                  <ul class="social-icon">
                                       <li><a href="#" class="fa fa-linkedin-square"></a></li>
                                       <li><a href="#" class="fa fa-envelope-o"></a></li>
                                  </ul>
                             </div>

                   </div>
              </div>
              <?php endforeach; ?>
              
         </div>
    </div>
</section>