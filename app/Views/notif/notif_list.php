<?php foreach ($notifs as $notif) { ?>
<a href="#" class="dropdown-item notif-item" data-nid="<?= $notif->notif_pk ?>" data-group="<?= $notif->post_group ?>" data-pid="<?= $notif->post_pk ?>">
  <div class="media"><!-- Message Start -->
    <img src="<?= base_url('resource/users/thumb' . $notif->from_user_profile_picture) ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
    <div class="media-body">
      <h3 class="dropdown-item-title">
        <?= mb_strimwidth($notif->from_user_full_name, 0, 16, "..") ?>
        <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> NOTE Original!-->
        <span class="float-right text-sm text-capitalize notif-role-<?= $notif->from_user_role ?>"><?= $notif->from_user_role ?></span> <!-- NOTE The custom -->
      </h3>
      <p class="text-sm"><?php if ($notif->notif_type == 'comment') {echo('telah mengomentari postingan anda!');} else {echo('telah mengomentari postingan yang anda ikuti!');} ?></p>
      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?= date("d-m-Y H:i", strtotime($notif->notif_date_time)) ?></p>
    </div>
  </div><!-- Message End -->
</a>
<?php } ?>