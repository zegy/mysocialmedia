<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new Item</h5>
      </div>
      <?= form_open('admin_tools/create_posts', ['id' => 'form-data']); ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="text" name="price" id="price" class="form-control">
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="category">category</label>
          <select name="category" id="category" class="form-control">
            <option value="">-- Choose --</option>
            <option value="kaos">Kaos</option>
            <option value="kemeja">Kemeja</option>
          </select>
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group">
          <label for="detail">Detail</label>
          <textarea name="detail" id="detail" cols="30" rows="3" class="form-control"></textarea>
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