<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="/" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Buat Diskusi Baru</h1>
      <div class="section-header-breadcrumb">
        <!-- <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Posts</a></div>
        <div class="breadcrumb-item">Create New Post</div> -->
        <div class="breadcrumb-item active"><a href="/">Forum Diskusi</a></div>
        <div class="breadcrumb-item">Buat Diskusi Baru</div>
      </div>
    </div>

    <div class="section-body">
      <!-- <h2 class="section-title">Create New Post</h2>
      <p class="section-lead">
        On this page you can create a new post and fill in all fields.
      </p> -->

      <div class="row">
        <div class="col-12">
          <?php echo form_open('post/save') ?>
          <div class="card">
            <!-- <div class="card-header">
              <h4>Write Your Post</h4>
            </div> -->
            <div class="card-body">
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Judul</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control" name="post_title">
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis</label>
                <div class="col-sm-12 col-md-7">
                  <select class="form-control selectric" name="post_type">
                    <!-- <option>Tech</option>
                    <option>News</option>
                    <option>Political</option> -->
                    <option>public</option>
                    <option>private</option>
                  </select>
                </div>
              </div>
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                <div class="col-sm-12 col-md-7">
                  <textarea class="summernote-simple" name="post_text"></textarea>
                </div>
              </div>
              <!-- <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                <div class="col-sm-12 col-md-7">
                  <div id="image-preview" class="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="post_image" id="image-upload" />
                  </div>
                </div>
              </div> -->
              <!-- <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                <div class="col-sm-12 col-md-7">
                  <input type="text" class="form-control inputtags">
                </div>
              </div> -->
              <!-- <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                <div class="col-sm-12 col-md-7">
                  <select class="form-control selectric">
                    <option>Publish</option>
                    <option>Draft</option>
                    <option>Pending</option>
                  </select>
                </div>
              </div> -->
              <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                <div class="col-sm-12 col-md-7">
                  <button type="submit" class="btn btn-primary">Create Post</button>
                </div>
              </div>
            </div>
          </div>
          <?php echo form_close() ?> 
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>