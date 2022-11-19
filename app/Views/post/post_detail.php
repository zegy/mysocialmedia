<?= $this->extend('layout') ?>
<!-- CONTENT -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4><b>Judul Diskusi : </b><span id="post_judul"><?= $post->pttl ?></span></h4>
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
              <p id="post_deskripsi"><?= $post->texto ?></p>
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
            <div class="card-footer card-comments" id="comment_list_data"><!-- NOTE : Get data using AJAX -->
              <!-- TODO : Empty comment -->
            </div><!-- /.card-footer -->
            <div class="card-footer">
              <form id="comment_add_form">
                <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/dist/img/user4-128x128.jpg') ?>" alt="Alt Text">
                <div class="img-push"><!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="form-group">
                    <textarea class="form-control" name="komentar" id="komentar" rows="3"></textarea>
                    <div class="invalid-feedback"></div>
                  </div>
                  <input type="hidden" name="pid" id="pid" value="<?= $post->pid ?>">
                  <button type="submit" class="btn btn-primary btn-sm float-right">Kirim</button>
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
            <label for="images">File</label>
            <input style="height: 45px" type="file" class="form-control" name="images[]" id="images" multiple>
            <div class="invalid-feedback"></div>
          </div>
        </div>
        <div style="margin-left: 20px" class="form-check">
          <input type="checkbox" class="form-check-input" name="cb_update_image" id="cb_update_image">
          <label class="form-check-label" for="cb_update_image">Hapus / Ganti Foto</label>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="pid" id="pid" value="<?= $post->pid ?>">
          <input type="hidden" name="group" id="group" value="<?= $post->type ?>">
          <input type="hidden" name="old_images" id="old_images" value="<?= $post->img ?>">
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
  // Callable functions
  function get_comment_list() {
    $.ajax({
      url: "<?= base_url('comment/list') ?>",
      dataType: "json",
      type: "post",
      data: {
        pid: "<?= $post->pid ?>",
      },
      success: function(res) {
        if (res.status) {
          $("#comment_list_data").html(res.comments)
        }
        // $(".overlay").hide()
      }
    })
  }

  function submit_update_post_form(formData) {
    $.ajax({
      url: "<?= base_url('post/save') ?>",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      success: function(res) {
        if (res.status) {
          $("#post_modal_edit").modal("toggle")
          window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
        } else {
          $.each(res.errors, function(key, value) { //TODO (pending) : The image upload is optional, "valid status" is not needed if there is no image upload. 
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
  }

  // Main scripts
  $(document).ready(function() {
    // Get comment list
    get_comment_list()

    // Delete post (Fully using "sweetalert2" : A confirm dialog, with a function attached to the "Confirm"-button. https://sweetalert2.github.io/#examples)
    $(document).on("click", ".btn-delete-post", function() {
      let pid = $(this).data("id")
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
              pid: pid,
              images : "<?= $post->img ?>"
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

    // Chocolat (For post's images). From Chocolat v1.0.4's demo (The "example3" and "container2" with custom options. The "close button" is disabled via css and the "chocolat's keyboard event listener" is also disabled via js)
    <?php if (!empty($post->img)){ ?> //NOTE : If post has image.
    const { api } = Chocolat(document.querySelectorAll('#post-imgs .chocolat-image'), {
      container: document.querySelector('#container-post-imgs'),
      imageSize: 'cover',
      firstImageIndex: 0,
      loop: false,
      allowZoom: true
    })

    api.open()
    <?php } ?>

    // Update post (form modal with data)
    $(document).on("click", ".btn-edit-post", function() {
      let judul = $("#post_judul").text()
      let deskripsi = $("#post_deskripsi").text()
      $("#post_modal_edit").modal("toggle")
      $("#post_modal_edit_form #judul").text(judul)
      $("#post_modal_edit_form #deskripsi").text(deskripsi)
    })

    // Create comment (form submit)
    $(document).on("submit", "#comment_add_form", function(e) {
      e.preventDefault()
      let formData = new FormData(this);
      $.ajax({
        url: "<?= base_url('comment/save') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $("#comment_add_form #komentar").val('') // NOTE : To reset prev input
            get_comment_list()
          } else {
            $.each(res.errors, function(key, value) { 
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
    })

    // Update post (form submit)
    $(document).on("submit", "#post_modal_edit_form", function(e) {
      e.preventDefault()
      let formData = new FormData(this);

      <?php if (!empty($post->img)){ ?> //NOTE : If post has image.
      if($("#cb_update_image").prop("checked") == true){
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
            submit_update_post_form(formData)
          }
        })
      } else {
        submit_update_post_form(formData)
      }   
      <?php } else { ?> //NOTE : If post has no image.
      submit_update_post_form(formData)
      <?php } ?>
    })

    // Reset input valid status (All)
    $("textarea").on("click", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    $("input").on("click", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    // Show or hide file input (on update)
    $("#cb_update_image").on("click", function() {
      $("#files_input").toggle();
    })
  })
</script>
<?= $this->endSection() ?>