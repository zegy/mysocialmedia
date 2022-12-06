<?php foreach ($notifs as $notif) { ?>
<a href="<?= base_url('group/' . $notif->post_group . '/' . 'detail/' . $notif->post_pk) ?>" class="dropdown-item notif-item">
  <div class="media"><!-- Message Start -->
    <img src="<?= base_url('resource/users/thumb' . $notif->from_user_profile_picture) ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
    <div class="media-body">
      <h3 class="dropdown-item-title">
        <?= $notif->from_user_full_name ?>
        <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> NOTE Original!-->
        <span class="float-right text-sm text-danger"><?php if ($notif->notif_type == 'comment') {echo('Comment');} ?></span> <!-- NOTE The custom -->
      </h3>
      <p class="text-sm"><?php if ($notif->notif_type == 'comment') {echo('Telah mengomentari postingan anda!');} ?></p>
      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?= $notif->notif_date_time ?></p>
    </div>
  </div><!-- Message End -->
</a>
<?php } ?>