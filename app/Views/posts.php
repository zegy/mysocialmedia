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
          
          <!-- get data by ajax -->
          <div class="source-data"></div>

        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?= $this->endSection() ?>

<!-- ================================================ SCRIPTS ================================================ -->
<script> //NOTE Inside this "$(document).ready(function)", this "script" tag is not needed, it just only to make it readable
  <?= $this->section('script') ?>
  function source_data() {
    $.ajax({
      url: "<?= base_url('fordis/' . $group) ?>",
      dataType: "json",
      success: function(res) {
        $(".source-data").html(res)
      }
    })
  }
  source_data()

  $(document).on("click", ".btn-refresh-post", function() {
    source_data()
  })

  $(document).on("click", ".btn-add-post", function() {
    $.ajax({
      url: "<?= base_url('post/get_add_post_modal') ?>",
      dataType: "json",
      success: function(res) {
        $(".view-modal").html(res)
        $(".modal").modal("toggle")
      }
    })
  })
  <?= $this->endSection() ?>
</script>