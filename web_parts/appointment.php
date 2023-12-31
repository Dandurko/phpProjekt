<!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
     <div class="container">
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <img src="images/appointment-image.jpg" class="img-responsive" alt="">
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="../2098_health/appointment_logic.php">

                         <!-- SECTION TITLE -->
                         <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                              <h2>Make an appointment</h2>
                         </div>

                         <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <div class="col-md-6 col-sm-6">
                                   <label for="name">Name</label>
                                   <input type="text" class="form-control" id="name" name="name" placeholder="Full Name">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="email">Email</label>
                                   <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="date">Select Date</label>
                                   <input type="date" name="date" value="" class="form-control">
                              </div>

                              <div class="col-md-6 col-sm-6">
                                   <label for="select">Select Department</label>
                                   <select name="department" class="form-control">
                                        <?php include_once "DB.php";

                                        use PO\Lib\DB;

                                        $db = new DB("localhost", 3306, "root", "", "phpschemafinal");
                                        $departments = $db->getDepartments();
                                        ?>
                                        <?php foreach ($departments as $department) : ?>
                                             <option  value="<?= $department['id'] ?>" ><?=  $department['name']?></option>
                                     
                                        <?php endforeach; ?>
                                   </select>
                              </div>

                              <div class="col-md-12 col-sm-12">
                                   <label for="telephone">Phone Number</label>
                                   <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
                                   <label for="Message">Additional Message</label>
                                   <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message"></textarea>
                                   <button type="submit" class="form-control" id="cf-submit" name="submit">Submit Button</button>
                              </div>
                         </div>
                    </form>
               </div>

          </div>
     </div>
</section>