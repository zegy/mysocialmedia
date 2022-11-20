<?= $this->extend('layout') ?>
<!-- CONTENT -->
<?= $this->section('content') ?> 
<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-6">
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
          <div id="group_list_data">
            <!-- NOTE : Get data using AJAX (Replace anything inside this "group_list_data" after request) -->
          </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?= $this->endSection() ?>

<!-- SCRIPTS -->
<?= $this->section('script') ?>
<script>
  // Callable functions
  function get_group_list() {
    $.ajax({
      url: "<?= base_url('group_list') ?>",
      dataType: "json",
      type: "post",
      success: function(res) {
        if (res.status) {
          $("#group_list_data").html(res.groups)
        }
        else
        {
        //   $("#post_list_data").html('<div class="card-body" style="height: 355px;"><h3>Belum ada diskusi di forum ini</h3>Silahkan buat diskusi perdana dari anda!</div>')
        }
        // $(".overlay").hide()
      }
    })
  }

  // Main scripts
  $(document).ready(function() {
    // Get post list
    get_group_list()
  })
</script>
<?= $this->endSection() ?>