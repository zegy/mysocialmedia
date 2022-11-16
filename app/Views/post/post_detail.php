<?= $this->extend('layout') ?>
<!-- CONTENT -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><b>Judul Diskusi : </b><span id="judul"><?= $post->pttl ?></span></h4>
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
              <?php if (!empty($post->img)){ ?>
              <div id="container-post-imgs" style="width: 100%; height: 350px; background: #E0E0E0; margin-bottom: 4px"></div><!-- NOTE : Chocolat's Container -->
              <?php $imgs = explode(",", $post->img); $count = count($imgs); if ($count == 1) { ?>
              <div id="post-imgs">
                <a class="chocolat-image" href="<?= base_url('imageRender/' . $imgs[0]) ?>" title="Rose"></a>
              </div>
              <?php } else { ?>
              <div id="post-imgs">
                <?php foreach ($imgs as $img) { ?>
                <a class="chocolat-image" href="<?= base_url('imageRender/' . $img) ?>" title="Rose">
                  <img src="<?= base_url('imageRender/' . $img) ?>" style="width:75px; height:50px" alt="">
                </a>
                <?php } ?>
              </div>
              <?php } ?>
              <?php } ?>
              <p id="deskripsi"><?= $post->texto ?></p>
              <button type="button" class="btn btn-danger btn-xs btn-delete-post" data-id="<?= $post->pid ?>"><i class="far fa-trash-alt"></i> Hapus</button>
              <button type="button" class="btn btn-secondary btn-xs btn-edit-post"><i class="far fa-edit"></i> Ubah</button>
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

<!-- MODALS -->
<form id="post_modal_edit_form">
  <div class="modal fade" id="post_modal_edit" tabindex="-1" role="dialog" aria-labelledby="post_modal_add_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new Item</h5>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="judul">Judul <i class="fas fa-exclamation-circle text-danger"></i></label>
            <textarea class="form-control" name="judul" id="judul" rows="2"></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi <i class="fas fa-exclamation-circle text-danger"></i></label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
            <div class="invalid-feedback"></div>
          </div>
          <div style="display: none" class="form-group" id="files_input">
            <label for="files">File</label>
            <input style="height: 45px" type="file" class="form-control" name="files[]" id="files" multiple>
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <div style="margin-left: 20px" class="form-check">
          <input type="checkbox" class="form-check-input" name="exampleCheck1" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Ganti file</label>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="type" id="type" value="edit">
          <input type="hidden" name="pid" id="pid" value="<?= $post->pid ?>">
          <input type="hidden" name="group" id="group" value="<?= $post->type ?>">
          <input type="hidden" name="old_files" id="old_files" value="<?= $post->img ?>">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
</form>
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

    <?php if (!empty($post->img)){ ?> //NOTE : Experimental! If post has no image.
    //NOTE : From Chocolat v1.0.4's demo (The "example3" and "container2" with custom options. The "close button" is disabled via css and the "chocolat's keyboard event listener" is also disabled via js)
    const { api } = Chocolat(document.querySelectorAll('#post-imgs .chocolat-image'), {
      container: document.querySelector('#container-post-imgs'),
      imageSize: 'cover',
      firstImageIndex: 0,
      loop: false,
      allowZoom: true,
      afterInitialize: function () {
        $("#container-post-imgs").show() //TODO : Need?
      },
      afterClose: function () {
        $("#container-post-imgs").hide() //TODO : Need?
      }
    })

    api.open() //NOTE : To show the first image in the container. From https://stackoverflow.com/a/65642200
    <?php } ?>

    $(document).on("click", ".btn-edit-post", function() { //NOTE : Using custom modal, semi using "sweetalert2" (Because it's multiple inputs method is not flexible)
      let judul = $("#judul").text()
      let deskripsi = $("#deskripsi").text()
      $("#post_modal_edit").modal("toggle")
      $("#post_modal_edit_form #judul").text(judul)
      $("#post_modal_edit_form #deskripsi").text(deskripsi)
    })

    $(document).on("submit", "#post_modal_edit_form", function(e) {
      e.preventDefault()
      const formData = new FormData(this);
    
      $.ajax({
        url: "<?= base_url('post/create') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $(".modal").modal("toggle")
            window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
          } else {
            $.each(res.errors, function(key, value) { //TODO (pending) : the file upload is optional, "valid status" is not needed if there is no file upload. 
              $('[id="' + key + '"]').addClass('is-invalid')
              $('[id="' + key + '"]').next().text(value)
              if (value == "") {
                $('[id="' + key + '"]').removeClass('is-invalid')
                $('[id="' + key + '"]').addClass('is-valid')
              }
            })
          }
        }
      })
    
      $("#post_modal_add_form textarea").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })

      $("#post_modal_add_form input").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })

    //   $("#post_modal_add_form select").on("click", function() {
    //     $(this).removeClass('is-invalid is-valid')
    //   })
    })

    $("#exampleCheck1").on("click", function() {
      $("#files_input").toggle();
    })

  })
</script>
<?= $this->endSection() ?>