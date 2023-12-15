<?php
require_once(__DIR__ . '/../admin/DB.php');


use PO\Lib\DB;

$db = new DB("localhost", 3306, "root", "", "phpschemafinal");
$doctors = $db->getDoctors();
$i=0;
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
                <?php $i++;?>
    <div class="col-md-4 col-sm-6">
        <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
        <img src="images/team-image<?php echo $i; ?>.jpg" class="img-responsive" alt="">
            <div class="team-info">
                <h3><?= $doctor['first_name']; ?> <?= $doctor['second_name']; ?></h3>
                <p><?= $doctor['name']; ?></p>
                <div class="team-contact-info">
                    <p><i class="fa fa-phone"></i> <?= $doctor['phone_number']; ?></p>
                    <p><i class="fa fa-envelope-o"></i> <a href="#">general@company.com</a></p>
                </div>
                <ul class="social-icon">
                    <li><a class="fa fa-envelope-o" data-doctor-id="<?= $doctor['id']; ?>"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="myModal<?= $doctor['id']; ?>" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalBtn<?= $doctor['id']; ?>">&times;</span>
            <form action="script.php" method="POST">
                <input placeholder="Message..." type="text" name="emailMessage">
                <input type="submit" value="Send">
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let openModalBtn = document.querySelector("[data-doctor-id='<?= $doctor['id']; ?>']");
            let closeModalBtn = document.getElementById("closeModalBtn<?= $doctor['id']; ?>");
            let modal = document.getElementById("myModal<?= $doctor['id']; ?>");

            openModalBtn.addEventListener("click", function () {
                modal.style.display = 'block';
            });

            closeModalBtn.addEventListener("click", function () {
                modal.style.display = 'none';
            });

            window.addEventListener("click", function (event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>
<?php endforeach; ?>


          </div>
     </div>
</section>