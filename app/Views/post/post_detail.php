<?= $this->extend('layout') ?>
<!-- [CONTENT] -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1><b>DETAIL </b>DISKUSI <span class="text-uppercase"><?= $post->post_group ?></h1>
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
                <img class="img-circle" src="<?= base_url('resource/users/thumb' . $post->user_profile_picture) ?>" alt="User Image">
                <span class="username"><a href="<?= base_url('user/detail/' . $post->user_pk) ?>"><?= $post->user_full_name ?></a></span>
                <span class="description">Dibuat pada : <?= $post->post_date_time ?></span>
              </div><!-- /.user-block -->
            </div><!-- /.card-header -->
            <div style="background-color: #f8f9fa" class="card-body"><!-- Custom style to match the comments card (background-color) -->
              <p><b>Judul : </b><span id="post_judul"><?= $post->post_title ?></span></p>
              <div class="row" id="post_images">
              <?php if (!empty($post->post_img)){ $imgs = explode(",", $post->post_img); foreach ($imgs as $img) {?>
                <div class="col-2">
                  <a href="<?= base_url('resource/posts/' . $img) ?>" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                    <img src="<?= base_url('resource/posts/thumb' . $img) ?>" class="img-fluid mb-2" alt="white sample"/>
                  </a>
                </div>
              <?php } } ?>
              </div>
              <p><b>Detail : </b><span id="post_deskripsi"><?= $post->post_text ?></span></p>
              <?php if (session('id') == $post->user_pk || session('role') == 'admin') { ?>
              <button type="button" class="btn btn-danger btn-xs" id="btn-delete-post" data-id="<?= $post->post_pk ?>"><i class="far fa-trash-alt"></i> Hapus</button>
              <button type="button" class="btn btn-secondary btn-xs" id="btn-update-post"><i class="far fa-edit"></i> Ubah</button>
              <?php } else { ?>
              <button type="button" class="btn btn-secondary btn-xs" id="btn-sub"><i class="fas fa-bell"></i> Terima notifikasi untuk post ini</button>
              <?php } ?>
              <span class="float-right text-muted" id="count_comments"></span>
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
              <form id="comment_create_form">
                <img class="img-fluid img-circle img-sm" src="<?= base_url('resource/users/thumb' . session('picture')) ?>" alt="Alt Text">
                <div class="img-push"><!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="form-group">
                    <textarea class="form-control" name="komentar" id="komentar" rows="3"></textarea>
                    <div class="invalid-feedback"></div>
                  </div>
                  <input type="hidden" name="pid" id="pid" value="<?= $post->post_pk ?>">
                  <input type="hidden" name="uid" id="uid" value="<?= $post->user_pk ?>">
                  <input type="hidden" name="group" id="group" value="<?= $post->post_group ?>">
                  <button type="submit" class="btn btn-info btn-sm float-right">Kirim</button>
                  <!-- <button type="button" style="margin-right: 5px; display: none" class="btn btn-danger btn-sm float-right" id="btn-cancel-update-comment">Batal</button> -->
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
<!-- [MODALS] : Update post -->
<form id="post_modal_update_form">
  <div class="modal fade" id="post_modal_update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
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
            <div class="form-check">
            <input type="checkbox" class="form-check-input" name="cb_update_image" id="cb_update_image">
            <label class="form-check-label" for="cb_update_image">Hapus / Ganti Foto</label>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" name="pid" id="pid" value="<?= $post->post_pk ?>">
          <input type="hidden" name="old_images" id="old_images" value="<?= $post->post_img ?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</form>

<!-- [OTHER] -->
<!-- [OTHER] : Update comment (Temp, values set on script)-->
<div style="display: none">
  <form id="comment_update_form">
    <div class="card-footer">
      <img class="img-fluid img-circle img-sm" src="<?= base_url('resource/users/thumb' . session('picture')) ?>" alt="Alt Text">
      <div class="img-push"><!-- .img-push is used to add margin to elements next to floating images -->
        <div class="form-group">
          <textarea class="form-control" name="update_komentar" id="update_komentar" rows="3"></textarea>
          <div class="invalid-feedback"></div>
        </div>
        <input type="hidden" name="cid" id="cid"> <!-- NOTE : Set using script (on comment update)-->
        <button type="submit" class="btn btn-info btn-sm float-right">Kirim</button>
        <button type="button" style="margin-right: 5px; display: none" class="btn btn-danger btn-sm float-right" id="btn-cancel-update-comment">Batal</button>
      </div>
    </div>
  </form>
</div>
<?= $this->endSection() ?>

<!-- [SCRIPTS] -->
<?= $this->section('script') ?>
<script>
  //[0] FCM
  function sub() {
    // These registration tokens come from the client FCM SDKs.
    const registrationTokens = [
      messaging.getToken({vapidKey: 'BHZtAg-u53KvMH6h_Q9p9pg87-ihoOXJZbbvSbQkXZ0uVpmB1_JkIu5H-dDzTE-LIrIFTbA9lj48BTKfuxsUbZg'})
    ];
  
    const topic = 'post1';
    
    // Subscribe the devices corresponding to the registration tokens to the topic.
    messaging.subscribeToTopic(registrationTokens, topic)
      .then((response) => {
        // See the MessagingTopicManagementResponse reference documentation for the contents of response.
        console.log('Successfully subscribed to topic:', response);
      })
      .catch((error) => {
        console.log('Error subscribing to topic:', error);
      });
  }

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
        pid: "<?= $post->post_pk ?>",
      },
      success: function(res) {
        if (res.status) {
          $("#comment_list_data").html(res.comments)
          $("#count_comments").text(res.comments_count + ' ' + 'Komentar')
        } else {
          $("#comment_list_data").html('<div style="height: 35px; padding-top: 4px; padding-bottom: 4px; margin-bottom: 0px" class="alert alert-warning"><p><i class="icon fas fa-exclamation-triangle"></i> Belum ada komentar!</p></div>')
          $("#count_comments").text('0 Komentar')
        }
      }
    })
  }

  function submit_update_post_form(formData) {
    $("#post_modal_update .overlay").show()

    $.ajax({
      url: "<?= base_url('post/update') ?>",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      success: function(res) {
        if (res.status) {
          $("#post_modal_update").modal("toggle")

          //NOTE : Update post's elements with new value (From prev "formData". Image names is from res)
          $("#post_deskripsi").text(formData.get('deskripsi'))
          $("#post_judul").text(formData.get('judul'))

          if (res.images_change) {
            $("#post_images").empty() //NOTE : Clear prev image from element

            if($.isEmptyObject(res.images)) { //NOTE : Check if updated post has image
              $("#post_modal_update_form #old_images").val('')
            } else {
              let res_images_string = (res.images).toString()
              $("#post_modal_update_form #old_images").val(res_images_string)

              $.each(res.images, function(index, value) {
                $("#post_images").append('<div class="col-2"><a href="<?= base_url('resource/posts')  . '/' ?>'+ value +'" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery"><img src="<?= base_url('resource/posts/thumb') ?>'+ value +'" class="img-fluid mb-2" alt="white sample"/></a></div>')
              })
            }
          }
        } else {
          set_errors(res.errors)
          $("#post_modal_update .overlay").hide()
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

    // Sub to post (FCM)
    $(document).on("click", "#btn-sub", function() {
      sub()
    })

    // Update post (Form modal with data)
    $(document).on("click", "#btn-update-post", function() {
      //NOTE : Reset prev modal (If prev is closed)
      $("#post_modal_update_form textarea").removeClass('is-invalid is-valid')
      $("#post_modal_update_form input").removeClass('is-invalid is-valid')
      $("#post_modal_update_form #cb_update_image").prop("checked", false);
      $("#images_input").hide();

      let judul = $("#post_judul").text()
      let deskripsi = $("#post_deskripsi").text()

      $("#post_modal_update").modal("toggle")

      $("#post_modal_update_form #judul").val(judul)
      $("#post_modal_update_form #deskripsi").val(deskripsi)
    })

    // Update post (Form submit)
    $(document).on("submit", "#post_modal_update_form", function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      let old_images = formData.get('old_images')
      
      if (old_images != '') { //NOTE : Current post has image
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
              $("#post_modal_update_form #cb_update_image").prop("checked", false);
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
              if (res.status) {
                Swal.fire({
                  title: 'Deleted!',
                  text: "Your file has been deleted.",
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location = "<?= base_url('group/' . $post->post_group) ?>"
                  }
                })
              } else {
                // FATAL ERROR
              }
            }
          })
        }
      })
    })

    // Update comment (Get the "comment_update_form" and set it as temp)
    let hasCommentUpdateForm = false // NOTE : Global var (Not inside function)
    $(document).on("click", ".btn-update-comment", function() {
      if (hasCommentUpdateForm) { //NOTE : Check if already has "temp_comment_update_form"
        $("#temp_comment_update_form").remove()
        $(".btn-update-comment").prop('disabled', false)
        hasCommentUpdateForm = false
      }
      
      $(this).prop('disabled', true);

      let cid = $(this).data("cid")
      let comment_text = $("#comment_" + cid + " " + "#comment_text").text()
      let updateForm = $("#comment_update_form").html()
      
      $("#comment_" + cid).append('<form id="temp_comment_update_form">' + updateForm + '</form>')
      $("#temp_comment_update_form #cid").val(cid)
      $("#temp_comment_update_form #komentar").val(comment_text)
      $("#temp_comment_update_form #btn-cancel-update-comment").show()

      hasCommentUpdateForm = true

      // Cancel update comment (NOTE : Nested function)
      $(document).on("click", "#btn-cancel-update-comment", function() {  
        $("#temp_comment_update_form").remove()
        $("#comment_" + cid + " " + ".btn-update-comment").prop('disabled', false)
  
        hasCommentUpdateForm = false
      })
    })

    // Create comment (Form submit)
    $(document).on("submit", "#comment_create_form", function(e) {
      e.preventDefault()

      $("#comment_create_form button[type='submit']").prop('disabled', true)

      let formData = new FormData(this);
      
      $.ajax({
        url: "<?= base_url('comment/create') ?>",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        success: function(res) {
          if (res.status) {
            //NOTE : Reset "comment_create_form"
            $("#comment_create_form #cid").val('')
            $("#comment_create_form #komentar").val('')

            $("#btn-cancel-update-comment").hide()
            get_comment_list() //NOTE (Pending) : Better get the new values and set them to spesific element
            $("#comment_create_form button[type='submit']").prop('disabled', false)

          } else {
            set_errors(res.errors)
            $("#comment_create_form button[type='submit']").prop('disabled', false)
          }
        }
      })
    })

    // Update comment (Form submit)
    $(document).on("submit", "#temp_comment_update_form", function(e) {
      e.preventDefault()

      let formData = new FormData(this);
      
      $.ajax({
        url: "<?= base_url('comment/update') ?>",
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
            set_errors(res.errors) //NOTE (Pending) : Has the same field name with "create post", hence both field will show error
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
    $(document).on("click", ".btn-like-comment", function() {
      let cid = $(this).data("cid")
      submit_likeordis(cid, 'like')
    })

    // Dislike a comment
    $(document).on("click", ".btn-dislike-comment", function() {
      let cid = $(this).data("cid")
      submit_likeordis(cid, 'dislike')
    })

    // Reset input valid status on click
    $(document).on("click", "textarea", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    $(document).on("click", "input", function() {
      $(this).removeClass('is-invalid is-valid')
    })

    // Reset / hide any modal overlay after modal close
    $('.modal').on('hidden.bs.modal', function () {
      $(".overlay").hide()
    })
  })
</script>
<?= $this->endSection() ?>