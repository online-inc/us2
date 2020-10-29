<?php include("header.php"); ?>


<div class="container my-box">
<div class="card-body">
<h1 style="color:#d83b02;">Account Settings</h1><br><br>
<div class="row">
  <div class="col-lg-4  col-sm-12">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> User Profile<i class="fa fa-long-arrow-right float-right pt-1" aria-hidden="true"></i></a>

      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-id-card-o" aria-hidden="true"></i> Billing and Renewal Settings <i class="fa fa-long-arrow-right float-right pt-1" aria-hidden="true"></i></a>

      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-bars" aria-hidden="true"></i> &nbsp;Order History <i class="fa fa-long-arrow-right float-right pt-1" aria-hidden="true"></i></a>

      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;&nbsp;Change Password <i class="fa fa-long-arrow-right float-right pt-1" aria-hidden="true"></i></a>

    </div>
  </div>
  <div class="col-lg-8 col-sm-12">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
         <div class="card border-primary mb-3" style="max-width: 100%;">
            <div class="card-header"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> USER PROFILE</div>
            <div class="card-body">
                <h6 class="card-title"> DEFAULT REGISTRANT CONTACT</h6>
                <hr>
                <div class="row">
                <div class="col-lg-4">
                  <p>
                    Clay Burgess<br>
                    Law Offices of L Clayton Burgess<br>
                    lcburgess@clayburgess.com
                  </p>
                </div>
                <div class="col-lg-4">
                  <p>
                    605 W Congress St<br>
                    Lafayette, LA 70501 US
                    +1.3376544834
                  </p>
                </div>
                <div class="col-lg-4 text-center">
                  <a href="#" class="btn btn-outline-success rounded-pill mt-3"> EDIT CONTACT INFO</a>
                </div>
                </div>
            </div>
        </div>
      </div>
      <!-- <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
         <div class="card border-primary mb-3" style="max-width: 100%;">
            <div class="card-header">Header</div>
            <div class="card-body">
                <h4 class="card-title">Primary card title</h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
         <div class="card border-primary mb-3" style="max-width: 100%;">
            <div class="card-header">Header</div>
            <div class="card-body">
                <h4 class="card-title">Primary card title</h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
         <div class="card border-primary mb-3" style="max-width: 100%;">
            <div class="card-header">Header</div>
            <div class="card-body">
                <h4 class="card-title">Primary card title</h4>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
      </div> -->
    </div>
  </div>
</div>
</div>
</div>

<?php include("footer.php"); ?>