@extends('layouts.admin')

@section('title', 'User')
@section('main')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Hover table card start -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                        <h4>@yield('title')</h4>
                        <span>Silakan kelola <code>Data @yield('title')</code> sesuai kebutuhan bisnis Anda</span>
                        </div>
                        <div>
                            <button id="createBtn" class="btn btn-success btn-sm" onclick="getModal('createModal')">
                                <i class="bi bi-plus me-2"></i>Tambah
                            </button>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table id="tbl_list" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">Foto</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@include('admin.user.create')
@endsection
@push('script')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const inputPhoto = document.getElementById("photo");
    const previewPhoto = document.getElementById("photoPreview");
    const cropContainer = document.getElementById("cropContainer");
    const cropImage = document.getElementById("cropImage");
    const cropApply = document.getElementById("cropApply");
    const cropCancel = document.getElementById("cropCancel");
    const rotateLeft = document.getElementById("rotateLeft");
    const rotateRight = document.getElementById("rotateRight");
    let cropper = null;

    // Saat user pilih foto baru
    inputPhoto.addEventListener("change", function(e) {
        const file = e.target.files[0];
        if (!file) return;

        if (!file.type.startsWith("image/")) {
            alert("File harus berupa gambar!");
            inputPhoto.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            cropImage.src = event.target.result;
            cropContainer.style.display = "block";

            if (cropper) cropper.destroy();
            cropper = new Cropper(cropImage, {
                aspectRatio: 1, // square
                viewMode: 1,
                autoCropArea: 1,
                background: false,
            });
        };
        reader.readAsDataURL(file);
    });

    // Tombol rotasi
    rotateLeft.addEventListener("click", () => cropper && cropper.rotate(-90));
    rotateRight.addEventListener("click", () => cropper && cropper.rotate(90));

    // Tombol batal crop
    cropCancel.addEventListener("click", function() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        cropContainer.style.display = "none";
        inputPhoto.value = "";
    });

    // Tombol gunakan hasil crop
    cropApply.addEventListener("click", function() {
        if (!cropper) return;

        cropper.getCroppedCanvas({
            width: 800,
            height: 800,
            imageSmoothingQuality: "high"
        }).toBlob(function(blob) {
            const croppedFile = new File([blob], `photo-${Date.now()}.png`, { type: "image/png" });
            
            // Ganti file input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(croppedFile);
            inputPhoto.files = dataTransfer.files;

            // Tampilkan hasil crop di preview
            previewPhoto.src = URL.createObjectURL(croppedFile);

            // Reset cropper
            cropper.destroy();
            cropper = null;
            cropContainer.style.display = "none";
        });
    });

    // Reset ketika modal ditutup
    const modal = document.getElementById("createModal");
    modal.addEventListener("hidden.bs.modal", function() {
        if (cropper) cropper.destroy();
        cropper = null;
        cropContainer.style.display = "none";
        cropImage.src = "";
        inputPhoto.value = "";
    });
});
</script>

<script>
    $(document).ready(function () {
        datatableCall('tbl_list', '{{ route('admin.users.index') }}', [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'photo',
            name: 'photo',
        },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'email',
            name: 'email',
        },
        {
            data: 'role',
            name: 'role',
        },
        {
            data: 'action',
            name: 'action',
        },
        ]);

        $("#saveData").submit(function(e) {
                setButtonLoadingState("#saveData .btn.btn-primary", true);
                e.preventDefault();
                const kode = $("#saveData #id").val();
                let url = "{{ route('admin.users.store') }}";
                const data = new FormData(this);

                if (kode !== "") {
                    data.append("_method", "PUT");
                    url = `/admin/users/${kode}`;
                }

                const successCallback = function(response) {
                    // $('#saveData #image').parent().find(".dropify-clear").trigger('click');
                    setButtonLoadingState("#saveData .btn.btn-primary", false);
                    handleSuccess(response, "tbl_list", "createModal");
                };

                const errorCallback = function(error) {
                    setButtonLoadingState("#saveData .btn.btn-primary", false);
                    handleError(error, 'dataTableId', 'modalId');
                    handleValidationErrors(error, "saveData", ["name", "email", "password", "role", "image"]);
                };
                
                ajaxCall(url, "POST", data, successCallback, errorCallback);
            });
    });
</script>
@endpush
