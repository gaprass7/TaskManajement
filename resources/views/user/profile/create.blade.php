<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="label-modal"></span> Data @yield('title')
                </h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saveData" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <div class="col-md-12 text-center">
                        <div style="margin-top: 10px;">
                            <img src="" id="photoPreview" width="180px" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name">
                        <small class="invalid-feedback" id="errorname"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email">
                        <small class="invalid-feedback" id="erroremail"></small>
                    </div>
                    <!-- Input password hanya muncul saat Tambah -->
                    <div class="form-group mb-3 password-field">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="invalid-feedback" id="errorpassword"></small>
                    </div>

                    <div class="form-group mb-3 password-field">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        <small class="invalid-feedback" id="errorpassword_confirmation"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-control">
                            <option value="">-- Pilih Data --</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <small class="invalid-feedback" id="errorrole"></small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input type="file" onchange="readFoto(event)" class="form-control" id="photo" name="photo">
                        <small class="invalid-feedback" id="errorphoto"></small>
                    </div>
                    <!-- Area cropper -->
<div id="cropContainer" class="text-center" style="display:none;">
  <div class="mb-2">
    <img id="cropImage" style="max-width:100%; max-height:300px;">
  </div>
  <div class="d-flex justify-content-center gap-2 mb-2">
    <button type="button" id="rotateLeft" class="btn btn-outline-secondary btn-sm">↺</button>
    <button type="button" id="rotateRight" class="btn btn-outline-secondary btn-sm">↻</button>
    <button type="button" id="cropApply" class="btn btn-primary btn-sm">Gunakan</button>
    <button type="button" id="cropCancel" class="btn btn-secondary btn-sm">Batal</button>
  </div>
</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
