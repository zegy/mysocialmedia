<!-- [MODALS] : User's summary (Experimental! Modal mixed with card from "user_list" ! -->
<div class="modal fade" id="user_sum_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ringkasan Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card bg-light d-flex flex-fill">
          <div class="card-header text-muted border-bottom-0 text-uppercase">
            <b><?= $user->user_role ?></b>
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col-7">
                <h2 class="lead"><b><?= $user->user_full_name ?></b></h2>
                <p class="text-muted text-sm user-bio"><b>Bio: </b><?= $user->user_bio ?></p>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                  <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-badge"></i></span><div class="user-id-mix"><?php if ($user->user_role == 'mahasiswa') { echo('NIM :');} else if ($user->user_role == 'dosen') {echo('NIP : ');} else {echo('ID_Admin : ');}?> <?= $user->user_id_mix ?></div></li>
                  <!-- <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li> -->
                </ul>
              </div>
              <div class="col-5 text-center">
                <img src="<?= base_url('resource/users/thumb' . $user->user_profile_picture) ?>" alt="user-avatar" class="img-circle img-fluid elevation-2">
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
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>