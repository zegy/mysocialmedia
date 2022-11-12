<?= $this->extend('layout') ?>
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
              <!-- <h3 class="card-title">Fixed Header Table</h3> -->
              <button class="btn btn-primary btn-sm btn-add-post"><i class="fa fa-plus"></i></button>
              <button class="btn btn-success btn-sm btn-refresh-post"><i class="fas fa-sync-alt"></i></button>
              <button class="btn btn-secondary btn-sm btn-refresh-post"><i class="fas fa-bars"></i></button>
              <div class="card-tools">
                <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
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

            <!-- get data by ajax -->
            <div class="source-data">
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

<?= $this->endSection() ?>

<!-- ================================================ SCRIPTS ================================================ -->
<script> //NOTE Inside this "$(document).ready(function)", this "script" tag is not needed, it just only to make it readable
  <?= $this->section('script') ?>
  function source_data(page_no) {
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
          $(".source-data").html(res.posts)
          $(".overlay").hide()
        } else {
          $(".overlay").hide()
        }
      }
    })
  }

  source_data()

  $(document).on("click", ".btn-pagination", function(e) {
    e.preventDefault()
    
    $(".overlay").show();
    const page = $(this).attr('id')
    source_data(page)
  })

  $(document).on("click", ".btn-refresh-post", function() {
    $(".overlay").show()
    source_data()
  })

  $(document).on("click", ".btn-add-post", function() { //NOTE : Using custom modal, semi using "sweetalert2" (Because it's multiple inputs method is not flexible)
    $.ajax({
      url: "<?= base_url('post/get_add_post_modal') ?>",
      dataType: "json",
      success: function(res) {
        $(".view-modal").html(res)
        $(".modal").modal("toggle")
      }
    })
  })

  $(document).on("click", ".table-avatar", function(e) {
    e.preventDefault()

    const id = $(this).attr('id')

    $.ajax({
      url: "<?= base_url('user/user_sum_modal') ?>",
      dataType: "json",
      type: "post",
      data: {
        uid: id
      },
      success: function(res) {
        $(".view-modal").html(res)
        $(".modal").modal("toggle")
      }
    })
  })
  <?= $this->endSection() ?>
</script>