<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="label-modal"></span> Data @yield('title')</h5>
                
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="saveData" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    {{-- User --}}
                    {{-- <div class="form-group mb-3">
                        <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                        <select name="user_id" id="user_id" class="form-control"></select>
                        <small class="invalid-feedback" id="erroruser_id"></small>
                    </div> --}}

                    {{-- Title & Status --}}
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label for="title" class="form-label">Judul Tugas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title">
                            <small class="invalid-feedback" id="errortitle"></small>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="">-- Pilih Status --</option>
                                <option value="to-do">To Do</option>
                                <option value="in-progress">In Progress</option>
                                <option value="done">Done</option>
                            </select>
                            <small class="invalid-feedback" id="errorstatus"></small>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Deskripsi Tugas</label>
                        <textarea class="form-control summernote" id="description" name="description" rows="3"></textarea>
                        <small class="invalid-feedback" id="errordescription"></small>
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
