<?= $this->extend('layout') ?>
<!-- CONTENT -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><b>Judul Diskusi : </b> <?= $post->pttl ?></h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Forum Diskusi : <?= $post->type ?></a></li>
            <li class="breadcrumb-item active">No : <?= $post->pid ?></li>
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
            <div style="height: 60px" class="card-header">
              <div class="user-block">
                <img class="img-circle" src="<?= base_url('assets/dist/img/user1-128x128.jpg') ?>" alt="User Image">
                <span class="username"><a href="#"><?= $post->nome ?></a></span>
                <span class="description">Dibuat pada : <?= $post->data ?></span>
              </div><!-- /.user-block -->
            </div><!-- /.card-header -->
            <div class="card-body">
              <div id="container-post-imgs" style="width: 100%; height: 350px; background: #E0E0E0; margin-bottom: 4px"></div><!-- NOTE : Chocolat's Container -->
              <?php if (!empty($post->img)){ $imgs = explode(",", $post->img)?>
              <div id="post-imgs">
                <?php foreach ($imgs as $img) { ?>
                <a class="chocolat-image" href="<?= base_url('imageRender/' . $img) ?>" title="Rose">
                  <img src="<?= base_url('imageRender/' . $img) ?>" style="width:75px; height:50px" alt="">
                </a>
                <?php } ?>
              </div>
              <?php } ?>
              <p><?= $post->texto ?></p>
              <button type="button" class="btn btn-danger btn-xs btn-delete-post" data-id="<?= $post->pid ?>"><i class="far fa-trash-alt"></i> Hapus</button>
              <button type="button" class="btn btn-secondary btn-xs"><i class="far fa-edit"></i> Ubah</button>
              <span class="float-right text-muted">3 comments</span>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
        <div class="col-md-6">
          <div class="card card-widget"><!-- Box Comment -->
            <div style="height: 60px" class="card-header">
              <h5 class="d-flex justify-content-center"><b>Komentar Diskusi</b></h5>
            </div><!-- /.card-header -->
            <div class="card-footer card-comments">
              <div class="card-comment">
                <div class="row">
                  <div class="col-12">
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
                </div><!-- /.row -->
                <div class="row">
                  <div class="col-12">
                    <div style="margin-top: 5px" class="float-right">
                      <button style="width: 50px" type="button" class="btn btn-outline-success btn-xs">
                        <i class="fas fa-thumbs-up"></i> 123
                      </button>
                      <button style="width: 50px" type="button" class="btn btn-outline-danger btn-xs">
                        <i class="fas fa-thumbs-down"></i> 123
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

<!-- SCRIPTS -->
<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $(document).on("click", ".btn-delete-post", function() { //NOTE : Fully using "sweetalert2"
      //NOTE : From https://sweetalert2.github.io/#examples (A confirm dialog, with a function attached to the "Confirm"-button)
      let pid = $(this).data("id") //NOTE : From the element's "data-id" attribute 
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "<?= base_url('post/delete') ?>",
            dataType: "json",
            type: "post",
            data: {
              pid: pid
            },
            success: function(res) {
              Swal.fire({
                title: 'Deleted!',
                text: "Your file has been deleted.",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location = "<?= base_url('group/' . $post->type) ?>" //NOTE : This is for redirect (since it's not working via Controller)
                }
              })
            }
          })
        }
      })
    })

    //NOTE : From Chocolat v1.0.4's demo (The "example3" and "container2" with custom options. The "close button" is disabled via css and the "chocolat's keyboard event listener" is also disabled via js)
    const { api } = Chocolat(document.querySelectorAll('#post-imgs .chocolat-image'), {
      container: document.querySelector('#container-post-imgs'),
      imageSize: 'cover',
      firstImageIndex: 0,
      loop: false,
      allowZoom: true,
      afterInitialize: function () {
        $("#container-post-imgs").show()
      },
      afterClose: function () {
        $("#container-post-imgs").hide()
      }
    })

    api.open() //NOTE : To show the first image in the container. From https://stackoverflow.com/a/65642200
  })
</script>
<?= $this->endSection() ?>