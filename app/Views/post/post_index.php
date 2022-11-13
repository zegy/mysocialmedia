<?= $this->extend('layout') ?>
<!-- CONTENT -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-9">
          <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simple Tables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content"><!-- Main content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="overlay">
              <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>
            <div class="card-header">
              <button class="btn btn-primary btn-sm btn-add-post"><i class="fa fa-plus"></i></button>
              <button class="btn btn-success btn-sm btn-refresh-post"><i class="fas fa-sync-alt"></i></button>
              <button class="btn btn-secondary btn-sm btn-refresh-post"><i class="fas fa-bars"></i></button>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 140px; margin: 0px">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div><!-- /.card-header -->
            <div class="post_list"><!-- NOTE : Get data using AJAX -->
              <div class="card-body" style="height: 355px;"><!-- NOTE : act as "empty table" so "loading" overlay animation will be at the center of the card. This element will replaced with the one from the "source" -->
                <h3>Belum ada diskusi di forum ini</h3>
                Silahkan buat diskusi perdana dari anda!
              </div><!-- /.card-body -->
            </div>
          </div><!-- /.card -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<!-- MODALS -->
<div class="modal fade" id="post_modal_add" tabindex="-1" role="dialog" aria-labelledby="post_modal_add_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new Item</h5>
      </div>
      <?= form_open('post/create', ['id' => 'post_modal_add_form']); ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="group">Judul</label>
          <input type="text" name="judul" id="judul" class="form-control">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="group">Deskripsi</label>
          <input type="text" name="deskripsi" id="deskripsi" class="form-control">
          <div class="invalid-feedback"></div>
        </div>
        <div id="actions" class="row">
          <div class="col-lg-6">
            <div class="btn-group w-100">
              <span class="btn btn-success col fileinput-button">
                <i class="fas fa-plus"></i>
                <span>Add files</span>
              </span>
              <button type="submit" class="btn btn-primary col start">
                <i class="fas fa-upload"></i>
                <span>Start upload</span>
              </button>
              <button type="reset" class="btn btn-warning col cancel">
                <i class="fas fa-times-circle"></i>
                <span>Cancel upload</span>
              </button>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center">
            <div class="fileupload-process w-100">
              <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
              </div>
            </div>
          </div>
        </div>
        <div class="table table-striped files" id="previews">
          <div id="template" class="row mt-2">
            <div class="col-auto">
                <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
            </div>
            <div class="col d-flex align-items-center">
                <p class="mb-0">
                  <span class="lead" data-dz-name></span>
                  (<span data-dz-size></span>)
                </p>
                <strong class="error text-danger" data-dz-errormessage></strong>
            </div>
            <div class="col-4 d-flex align-items-center">
                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>
            <div class="col-auto d-flex align-items-center">
              <div class="btn-group">
                <button class="btn btn-primary start">
                  <i class="fas fa-upload"></i>
                  <span>Start</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>Cancel</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                  <i class="fas fa-trash"></i>
                  <span>Delete</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="group" id="group" value="<?= $group ?>">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<!-- SCRIPTS -->
<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    function get_post_list(page_no) {
      var page = page_no //NOTE : Optional, used in pagination
    
      $.ajax({
        url: "<?= base_url('post/list') ?>",
        dataType: "json",
        type: "post",
        data: {
          group: "<?= $group ?>",
          page: page
        },
        success: function(res) {
          if (res.status) {
            $(".post_list").html(res.posts)
          }
          $(".overlay").hide()
        }
      })
    }
    
    get_post_list()
    
    $(document).on("click", ".btn-pagination", function(e) {
      e.preventDefault()
      
      $(".overlay").show();
      let page = $(this).attr('id')
      get_post_list(page)
    })
    
    $(document).on("click", ".btn-refresh-post", function() {
      $(".overlay").show()
      get_post_list()
    })
    
    $(document).on("click", ".btn-add-post", function() { //NOTE : Using custom modal, semi using "sweetalert2" (Because it's multiple inputs method is not flexible)
      $("#post_modal_add").modal("toggle")
    })
    
    $(document).on("submit", "#post_modal_add_form", function(e) {
      e.preventDefault()
    
      $.ajax({
        url: $(this).attr("action"),
        type: $(this).attr("method"),
        data: $(this).serialize(),
        dataType: "json",
        success: function(res) {
          if (res.status) {
            $(".modal").modal("toggle")
            window.location = "<?= base_url('group') ?>" + "/" + res.group + "/detail/" + res.pid
          } else {
            $.each(res.errors, function(key, value) {
              $('[name="' + key + '"]').addClass('is-invalid')
              $('[name="' + key + '"]').next().text(value)
              if (value == "") {
                $('[name="' + key + '"]').removeClass('is-invalid')
                $('[name="' + key + '"]').addClass('is-valid')
              }
            })
          }
        }
      })
    
      $("#post_modal_add_form input").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })
      $("#post_modal_add_form select").on("click", function() {
        $(this).removeClass('is-invalid is-valid')
      })
    })
    
    // $(document).on("click", ".table-avatar", function(e) {
    //   e.preventDefault()
    
    //   const id = $(this).attr('id')
    
    //   $.ajax({
    //     url: "<?= base_url('user/user_sum_modal') ?>",
    //     dataType: "json",
    //     type: "post",
    //     data: {
    //       uid: id
    //     },
    //     success: function(res) {
    //       $(".view-modal").html(res)
    //       $(".modal").modal("toggle")
    //     }
    //   })
    // })

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false
    
    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)
    
    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "/target-url", // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    })
    
    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    })
    
    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })
    
    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })
    
    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })
    
    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
    }
    // DropzoneJS Demo Code End
  })
</script>
<?= $this->endSection() ?>