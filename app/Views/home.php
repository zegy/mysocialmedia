<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Forum Diskusi</h1>
      <div class="section-header-button">
        <a href="features-post-create.html" class="btn btn-primary">Buat Diskusi</a>
      </div>
      <!-- <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Posts</a></div>
        <div class="breadcrumb-item">All Posts</div>
      </div> -->
    </div>
    <div class="section-body">
      <!-- <h2 class="section-title">Posts</h2>
      <p class="section-lead">
        You can manage all posts, such as editing, deleting and more.
      </p> -->

      <div class="row">
        <div class="col-12">
          <div class="card mb-0">
            <div class="card-body">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Forum Diskusi Publik <span class="badge badge-white">5</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Forum Diskusi Dosen <span class="badge badge-primary">1</span></a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#">Pending <span class="badge badge-primary">1</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Trash <span class="badge badge-primary">0</span></a>
                </li> -->
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <!-- <div class="card-header">
              <h4>All Posts</h4>
            </div> -->
            <div class="card-body">
              <!-- <div class="float-left">
                <select class="form-control selectric">
                  <option>Action For Selected</option>
                  <option>Move to Draft</option>
                  <option>Move to Pending</option>
                  <option>Delete Pemanently</option>
                </select>
              </div> -->
              <div class="float-right">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="clearfix mb-3"></div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <!-- <th class="text-center pt-2">
                      <div class="custom-checkbox custom-checkbox-table custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                      </div>
                    </th> -->
                    <th>Judul diskusi</th>
                    <!-- <th>Category</th> -->
                    <th>Pembuat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                  </tr>
                  <?php if($posts) { foreach ($posts as $post) { ?>
                  <tr>
                    <!-- <td>
                      <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                        <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                      </div>
                    </td> -->
                    <td>Apakah boleh menggunakan nilai TUTEP yang lama?
                      <div class="table-links">
                        <a href="#">View</a>
                        <div class="bullet"></div>
                        <a href="#" class="edit_post" data-toggle="modal" data-id="<?= $post->pid;?>" data-text="<?= $post->texto;?>">Edit</a>
                        <div class="bullet"></div>
                        <a href="#" class="text-danger delete_post" data-toggle="modal" data-id="<?= $post->pid;?>">Trash</a>
                      </div>
                    </td>
                    <!-- <td>
                      <a href="#">Web Developer</a>,
                      <a href="#">Tutorial</a>
                    </td> -->
                    <td>
                      <a href="#">
                        <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title=""> <div class="d-inline-block ml-1">Rizal Fakhri</div>
                      </a>
                    </td>
                    <td>2018-01-20</td>
                    <td><div class="badge badge-primary">Terjawab</div></td>
                    <!-- <td><div class="badge badge-warning">Pending</div></td> -->
                    <!-- <td><div class="badge badge-danger">Draft</div></td> -->
                  </tr>
                  <?php } } else { ?>
                    <!-- TODO if empty -->
                  <?php } ?>
                </table>
              </div>
              <div class="float-right">
                <nav>
                  <ul class="pagination">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Edit Post [ -->
<form action="post/update" method="post">
  <div class="modal fade" tabindex="-1" role="dialog" id="editPostModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">UBAH DISKUSI</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label>Detail diskusi</label> <!-- TODO change to text area -->
              <input type="text" class="form-control post_text" name="text" placeholder="">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <input type="hidden" class="post_id" name="pid" >
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- Modal Edit Post ] -->

<!-- Modal Delete Post [ -->
<form action="post/delete" method="post">
  <div class="modal fade" tabindex="-1" role="dialog" id="deletePostModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">KONFIRMASI</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <h6>Apakah anda yakin akan menghapus postingan ini?</h6>
            </div>
         </div>
          <div class="modal-footer bg-whitesmoke br">
              <input type="hidden" class="post_id" name="pid" >
              <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-primary">Yes</button>
          </div>
        </div>
    </div>
  </div>
</form>
<!-- Modal Delete Post ] -->

<?= $this->endSection() ?>