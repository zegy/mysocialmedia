<div class="card-body pb-0">
  <div class="row">
    <?php foreach ($users as $user) { ?>
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
      <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0 text-uppercase">
          <b><?= $user->user_role ?></b>
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col-7">
              <h2 class="lead"><b><?= mb_strimwidth($user->user_full_name, 0, 48, "..") ?></b></h2>
              <p class="text-muted text-sm"><b>Bio: </b> <?= $user->user_bio ?> </p>
              <ul class="ml-4 mb-0 fa-ul text-muted">
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-badge"></i></span><div class="user-id-mix"><?php if ($user->user_role == 'mahasiswa') { echo('NIM :');} else if ($user->user_role == 'dosen') {echo('NIP : ');} else {echo('ID_Admin : ');}?> <?= $user->user_id_mix ?></div></li>
                <!-- <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li> -->
              </ul>
            </div>
            <div class="col-5 text-center">            
              <a href="<?= base_url('resource/users/' . $user->user_profile_picture) ?>" data-toggle="lightbox" data-title="<?= $user->user_full_name ?>" data-gallery="gallery">
                <img src="<?= base_url('resource/users/thumb' . $user->user_profile_picture) ?>" class="img-circle img-fluid" alt="<?= $user->user_profile_picture ?>"/>
              </a>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="text-right">
            <a href="<?= base_url('user/detail/' . $user->user_pk) ?>" class="btn btn-sm btn-info">
              <i class="fas fa-user"></i> Detail Pengguna
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<!-- /.card-body -->
<div class="card-footer clearfix">
  <ul class="pagination pagination-sm m-0 float-right">
    <li class="page-item"><a class="page-link btn-pagination" href="#" id="1">&laquo;</a></li>
    <?php echo $pager->links('default', 'custom') ?> <!-- NOTE The 1st parameter is group and the 2nd is view / template -->
    <li class="page-item"><a class="page-link btn-pagination" href="#" id="<?= $pager->getPageCount() ?>">&raquo;</a></li> <!-- NOTE : The getLastPageNumber and getPageCount not working properly in "template". Hence why it's here -->
  </ul>
</div>
<!-- /.card-footer -->