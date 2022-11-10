<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Item</h5>
      </div>
      <?= form_open('post/delete', ['id' => 'form-delete-post']); ?>
      <div class="modal-body">
        
        <input type="hidden" name="id" id="item_id" value="<?= $item["id"]; ?>">

        Apakah anda yakin ingin menghapus data berikut?
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Delete</button>
      </div>

      <?= form_close(); ?>

    </div>
  </div>
</div>