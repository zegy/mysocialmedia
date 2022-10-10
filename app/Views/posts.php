<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
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

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Fixed Header Table</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap projects">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($posts) { foreach ($posts as $post) { ?>
                  <tr>
                    <td>183</td>
                    <td>
                      <img alt="Avatar" class="table-avatar" src="<?= base_url('assets/dist/img/avatar.png') ?>">
                      <a href="<?php echo base_url('user/showprofile/' . $post->uid) ?>"><?= $post->nome ?></a>
                    </td>
                    <td><?= $post->data ?></td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <!-- <td><span class="badge bg-success">Approved</span></td> -->
                    <!-- <td><span class="badge bg-danger">Denied</span></td> -->
                    <td><a href="<?= base_url('comment/show/'.$post->pid) ?>"><?= $post->pttl ?></a></td>
                  </tr>
                  <?php } } else { ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <!-- column -->
        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">General Elements</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Text</label>
                      <input type="text" class="form-control" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Text Disabled</label>
                      <input type="text" class="form-control" placeholder="Enter ..." disabled>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Textarea</label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Textarea Disabled</label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                    </div>
                  </div>
                </div>
  
                <!-- input states -->
                <div class="form-group">
                  <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                    success</label>
                  <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                    warning</label>
                  <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                    error</label>
                  <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                </div>
  
                <div class="row">
                  <div class="col-sm-6">
                    <!-- checkbox -->
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">Checkbox</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" checked>
                        <label class="form-check-label">Checkbox checked</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" disabled>
                        <label class="form-check-label">Checkbox disabled</label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio1">
                        <label class="form-check-label">Radio</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="radio1" checked>
                        <label class="form-check-label">Radio checked</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" disabled>
                        <label class="form-check-label">Radio disabled</label>
                      </div>
                    </div>
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Select</label>
                      <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Select Disabled</label>
                      <select class="form-control" disabled>
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  </div>
                </div>
  
                <div class="row">
                  <div class="col-sm-6">
                    <!-- Select multiple-->
                    <div class="form-group">
                      <label>Select Multiple</label>
                      <select multiple class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Select Multiple Disabled</label>
                      <select multiple class="form-control" disabled>
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>