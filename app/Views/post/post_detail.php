<?= $this->extend('layout') ?>
<!-- [CONTENT] -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h4><b>Judul Diskusi : </b><span id="post_judul"><?= $post->pttl ?></span></h4>
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
              <div class="row" id="post_images">
              <?php if (!empty($post->img)){ $imgs = explode(",", $post->img); foreach ($imgs as $img) {?>
                <div class="col-2">
                  <a href="<?= base_url('imageRender/' . $img) ?>" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                    <img src="<?= base_url('imageRender/thumb' . $img) ?>" class="img-fluid mb-2" alt="white sample"/>
                  </a>
                </div>
              <?php } } ?>
              </div>
              <p id="post_deskripsi"><?= $post->texto ?></p>
              <button type="button" class="btn btn-danger btn-xs" id="btn-delete-post" data-id="<?= $post->pid ?>"><i class="far fa-trash-alt"></i> Hapus</button>
              <button type="button" class="btn btn-secondary btn-xs" id="btn-edit-post"><i class="far fa-edit"></i> Ubah</button>
              <span class="float-right text-muted">3 comments</span>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
        <div class="col-md-6">
          <div class="card card-widget"><!-- Box Comment -->
            <div style="height: 60px" class="card-header">
              <h5 class="d-flex justify-content-center"><b>Komentar Diskusi</b></h5>
            </div><!-- /.card-header -->
            <div class="card-footer card-comments" id="comment_list_data">
              <!-- NOTE : Get data using AJAX (Replace anything inside this "comment_list_data" after request) -->
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
                  <input type="hidden" name="cid" id="cid"> <!-- NOTE : Set using script (on comment edit)-->
                  <button type="submit" class="btn btn-primary btn-sm float-right">Kirim</button>
                  <button type="button" style="margin-right: 5px; display: none" class="btn btn-danger btn-sm float-right" id="btn-cancel-edit-comment">Batal</button>
                </div>
              </form>
            </div><!-- /.card-footer -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- [MODALS] -->
<!-- [MODALS] : Edit post -->
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
          <div style="display: none" class="form-group" id="images_input">
            <label for="images">Foto </label>
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

<!-- [OTHER] -->
<!-- [OTHER] : Edit comment (Temp, values set on script)-->
<div style="display: none">
  <form id="comment_edit_form">
    <div class="card-footer">
      <img class="img-fluid img-circle img-sm" src="<?= base_url('assets/dist/img/user4-128x128.jpg') ?>" alt="Alt Text">
      <div class="img-push"><!-- .img-push is used to add margin to elements next to floating images -->
        <div class="form-group">
          <textarea class="form-control" name="komentar" id="komentar" rows="3"></textarea>
          <div class="invalid-feedback"></div>
        </div>
        <input type="hidden" name="pid" id="pid" value="<?= $post->pid ?>">
        <input type="hidden" name="cid" id="cid"> <!-- NOTE : Set using script (on comment edit)-->
        <button type="submit" class="btn btn-primary btn-sm float-right">Kirim</button>
        <button type="button" style="margin-right: 5px; display: none" class="btn btn-danger btn-sm float-right" id="btn-cancel-edit-comment">Batal</button>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection() ?>

<!-- [SCRIPTS] -->
<?= $this->section('script') ?>
<script>
  //[A] Callable functions
  function set_errors(errors) {
    $.each(errors, function(key, value) {
      $('[id="' + key + '"]').addClass('is-invalid')
      $('[id="' + key + '"]').next().text(value)
      if (value == "") {
        $('[id="' + key + '"]').removeClass('is-invalid')
        $('[id="' + key + '"]').addClass('is-valid')
      }
    })
  }

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
        } else {
          $("#comment_list_data").html('<div style="height: 35px; padding-top: 4px; padding-bottom: 4px; margin-bottom: 0px" class="alert alert-warning"><p><i class="icon fas fa-exclamation-triangle"></i> Belum ada komentar!</p></div>')
        }
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

          //NOTE : Update post's elements with new value (From prev "formData". Image names is from res)
          $("#post_deskripsi").text(formData.get('deskripsi'))
          $("#post_judul").text(formData.get('judul'))

          if (res.images_change) {
            $("#post_images").empty() //NOTE : Clear prev image from element

            if($.isEmptyObject(res.images)) { //NOTE : Check if updated post has image
              $("#post_modal_edit_form #old_images").val(null)
            } else {
              let res_images_string = (res.images).toString()
              $("#post_modal_edit_form #old_images").val(res_images_string)

              $.each(res.images, function(index, value) {
                $("#post_images").append('<div class="col-2"><a href="<?= base_url('imageRender')  . '/' ?>'+ value +'" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery"><img src="<?= base_url('imageRender/thumb') ?>'+ value +'" class="img-fluid mb-2" alt="white sample"/></a></div>')
              })
            }
          }
        } else {
          set_errors(res.errors)
        }
      }
    })
  }
  
  function submit_likeordis(cid, type) {
    $.ajax({
      url: "<?= base_url('comment/like') ?>",
      dataType: "json",
      type: "post",
      data: {
        cid: cid,
        type: type
      },
      success: function(res) {
        if (res.status) {
          get_comment_list() //NOTE (Pending) : Better get the new values and set them to spesific element
        }
      }
    })
  }

  //[B] Main scripts
  $(document).ready(function() {
    // After loaded
    get_comment_list()

    // Ekko Lightbox (For post's images)
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault()
      $(this).ekkoLightbox({
        alwaysShowClose: true
      })
    })

    // Update post (Form modal with data)
    $(document).on("click", "#btn-edit-post", function() {
      //NOTE : Reset prev modal (If prev is closed)
      $("#post_modal_edit_form textarea").removeClass('is-invalid is-valid')
      $("#post_modal_edit_form input").removeClass('is-invalid is-valid')
      $("#post_modal_edit_form #cb_update_image").prop("checked", false);
      $("#images_input").hide();

      let judul = $("#post_judul").text()
      let deskripsi = $("#post_deskripsi").text()

      $("#post_modal_edit").modal("toggle")

      $("#post_modal_edit_form #judul").val(judul)
      $("#post_modal_edit_form #deskripsi").val(deskripsi)
    })

    // Update post (Form submit)
    $(document).on("submit", "#post_modal_edit_form", function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      let old_images = $("#post_judul").text(formData.get('old_images'))
      
      if (old_images != null) { //NOTE : Current post has image
        if($("#cb_update_image").prop("checked") == true){ //NOTE : User req change image
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) { //NOTE : User agree to change image
              submit_update_post_form(formData)
            } else { //NOTE : User not agree to change image
              $("#post_modal_edit_form #cb_update_image").prop("checked", false);
              $("#images_input").hide();
            }
          })
        } else { //NOTE : User not req change image
          submit_update_post_form(formData)
        }
      } else { //NOTE : Current post has no image
        submit_update_post_form(formData)
      }
    })

    // Show or hide images_input (On post update)
    $("#cb_update_image").on("click", function() {
      $("#images_input").toggle();
    })

    // Delete post (Fully using "sweetalert2")
    $(document).on("click", "#btn-delete-post", function() {
      let pid = $(this).data("id")
      let images = $("#post_modal_edit_form #old_images").val()

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
              images : images
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
                  window.location = "<?= base_url('group/' . $post->type) ?>"
                }
              })
            }
          })
        }
      })
    })

    // Update comment (Get the "comment_edit_form" and set it as temp)
    let hasCommentEditForm = false // NOTE : Global var (Not inside function)
    $(document).on("click", ".btn-edit-comment", function() {
      if (hasCommentEditForm) { //NOTE : Check if already has "temp_comment_edit_form"
        $("#temp_comment_edit_form").remove()
        $(".btn-edit-comment").prop('disabled', false)
        hasCommentEditForm = false
      }
      
      $(this).prop('disabled', true);

      let cid = $(this).data("cid")
      let comment_text = $("#comment" + cid + " " + "#comment_text").text()
      let editForm = $("#comment_edit_form").html()
      
      $("#comment" + cid).append('<form id="temp_comment_edit_form">' + editForm + '</form>')
      $("#temp_comment_edit_form #cid").val(cid)
      $("#temp_comment_edit_form #komentar").val(comment_text)
      $("#temp_comment_edit_form #btn-cancel-edit-comment").show()

      hasCommentEditForm = true

      // Cancel update comment (NOTE : Nested function)
      $(document).on("click", "#btn-cancel-edit-comment", function() {  
        $("#temp_comment_edit_form").remove()
        $("#comment" + cid + " " + ".btn-edit-comment").prop('disabled', false)
  
        hasCommentEditForm = false
      })
    })

    // Create comment (Form submit)
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
            //NOTE : Reset "comment_add_form"
            $("#comment_add_form #cid").val('')
            $("#comment_add_form #komentar").val('')

            $("#btn-cancel-edit-comment").hide()
            get_comment_list() //NOTE (Pending) : Better get the new values and set them to spesific element
          } else {
            set_errors(res.errors)
          }
        }
      })
    })

    // Update comment (Form submit)
    $(document).on("submit", "#temp_comment_edit_form", function(e) {
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
            get_comment_list() //NOTE (Pending) : Better get the new values and set them to spesific element
          } else {
            set_errors(res.errors) //NOTE (Pending) : Has the same field name with "add post", hence both field will show error
          }
        }
      })
    })

    // Delete comment (Fully using "sweetalert2")
    $(document).on("click", ".btn-delete-comment", function() {
      let cid = $(this).data("cid")

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
            url: "<?= base_url('comment/delete') ?>",
            dataType: "json",
            type: "post",
            data: {
              cid: cid,
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
                  get_comment_list()
                }
              })
            }
          })
        }
      })
    })

    // Like a comment
    $(document).on("click", "#btn-like-comment", function() {
      let cid = $(this).data("cid")
      submit_likeordis(cid, 'like')
    })

    // Dislike a comment
    $(document).on("click", "#btn-dislike-comment", function() {
      let cid = $(this).data("cid")
      submit_likeordis(cid, 'dislike')
    })

    // Reset input valid status (All)
    $("textarea").on("click", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    $("input").on("click", function() {
      $(this).removeClass('is-invalid is-valid')
    })
  })
</script>
<?= $this->endSection() ?>