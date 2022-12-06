<?php foreach ($notifs as $notif) { ?>
<a href="#" class="dropdown-item notif-item">
  <div class="media"><!-- Message Start -->
    <img src="<?= base_url('assets/dist/img/user1-128x128.jpg') ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
    <div class="media-body">
      <h3 class="dropdown-item-title">
        Brad Diesel
        <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> NOTE Original!-->
        <span class="float-right text-sm text-danger">Comment</span> <!-- NOTE The custom -->
      </h3>
      <p class="text-sm">Call me whenever you can...</p>
      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
    </div>
  </div><!-- Message End -->
</a>
<?php } ?>