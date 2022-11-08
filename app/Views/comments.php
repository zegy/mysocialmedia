<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content"><!-- Main content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-widget"><!-- Box Comment -->
            <div class="card-header">
              <div class="user-block">
                <img class="img-circle" src="<?= base_url('assets/dist/img/user1-128x128.jpg') ?>" alt="User Image">
                <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                <span class="description">Shared publicly - 7:30 PM Today</span>
              </div><!-- /.user-block -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool" title="Mark as read">
                  <i class="far fa-circle"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div><!-- /.card-tools -->
            </div><!-- /.card-header -->
            <div class="card-body">
              <img class="img-fluid pad" src="<?= base_url('assets/dist/img/photo2.png') ?>" alt="Photo">
              <p>I took this photo this morning. What do you guys think?</p>
              <button type="button" class="btn btn-danger btn-sm btn-delete-post" data-id="<?= $post->pid ?>"><i class="far fa-trash-alt"></i> Hapus</button> <!-- TODO LEARN DATA-ID -->
              <button type="button" class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Ubah</button>
              <!-- <span class="float-right text-muted">127 likes - 3 comments</span> -->
              <span class="float-right text-muted">3 comments</span>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
        <div class="col-md-6">
          <div class="card card-widget"><!-- Box Comment -->
            <div class="card-header">
              <h3 class="float-left" style="margin-bottom: 7px;">Komentar</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" title="Mark as read">
                  <i class="far fa-circle"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div><!-- /.card-tools -->
            </div><!-- /.card-header -->
            <div class="card-footer card-comments">
              <div class="card-comment">
                <div class="row">
                  <div class="col-11">
                    <img class="img-circle img-sm" src="<?= base_url('assets/dist/img/user3-128x128.jpg') ?>" alt="User Image"><!-- User image -->
                    <div class="comment-text">
                    <span class="username">
                        Maria Gonzales
                        <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                    </div><!-- /.comment-text -->
                  </div><!-- /.col -->
                  <div class="col-1">
                    <div class="btn-group-vertical">
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fas fa-arrow-up"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-xs">
                        123
                      </button>
                      <button type="button" class="btn btn-default btn-xs">
                        <i class="fas fa-arrow-down"></i>
                      </button>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.card-comment -->
            </div><!-- /.card-footer -->
            <div class="card-footer">
              <form action="#" method="post">
                <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/dist/img/user4-128x128.jpg') ?>" alt="Alt Text">
                <div class="img-push"><!-- .img-push is used to add margin to elements next to floating images -->
                  <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                </div>
              </form>
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?= $this->endSection() ?>

<!-- ================================================ SCRIPTS ================================================ -->
<script> //NOTE Inside this "$(document).ready(function)", this "script" tag is not needed, it just only to make it readable
  <?= $this->section('script') ?>
  $(document).on("click", ".btn-delete-post", function() {
    var item_id = $(this).data("id") //TODO LEARN DATA-ID

    $.ajax({
      url: "<?= base_url('post/get_delete_post_modal') ?>",
      dataType: "json",
      type: "post",
      data: {
        id: item_id
      },
      success: function(res) {
        $(".view-modal").html(res)
        $(".modal").modal("toggle")
      }
    })
  })

  $(document).on("submit", "#form-delete-post", function(e) {
    e.preventDefault()

    $.ajax({
      url: $(this).attr("action"),
      type: $(this).attr("method"),
      data: $(this).serialize(),
      dataType: "json",
      success: function(res) {
        if (res.status) {
          $(".modal").modal("toggle")
        //   Toast.fire({
        //     icon: 'success',
        //     title: 'Data berhasil dihapus'
        //   })
        //   source_data()
        //temp, redirect instead
        alert('sukses')
        }
      }
    })
  })
  <?= $this->endSection() ?>
</script>