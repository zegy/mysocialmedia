<div class="modal fade" id="post_modal_add_batch" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new Item</h5>
      </div>
      <?= form_open('admin_tools/create_posts', ['id' => 'form-data']); ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="group">Group (Manual input)</label>
          <input type="text" name="group" id="group" class="form-control">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="user">User</label>
          <select name="user" id="user" class="form-control">
            <option value="">-- Pilih --</option>
            <option value="1">un_admin</option>
            <option value="2">un_dosen</option>
            <option value="3">un_mahasiswa</option>
          </select>
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="count">Jumlah</label>
          <input type="number" name="count" id="count" class="form-control">
          <div class="invalid-feedback"></div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

      <?= form_close(); ?>

    </div>
  </div>
</div>