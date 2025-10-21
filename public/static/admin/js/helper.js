const datatableCall = (targetId, url, columns) => {
    $(`#${targetId}`).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: "GET",
            data: function (d) {
                d.mode = "datatable";
            },
        },
        columns: columns,
        lengthMenu: [
            [15, 30, 80, 250, -1],
            [15, 30, 80, 250, "All"],
        ],
    });
};


const ajaxCall = (url, method, data, successCallback, errorCallback) => {
    $.ajax({
        type: method,
        enctype: "multipart/form-data",
        url,
        cache: false,
        data,
        contentType: false,
        processData: false,
        headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content"),
        },
        dataType: "json",
        success: function (response) {
            successCallback(response);
        },
        error: function (error) {
            errorCallback(error);
        },
    });
};


const setButtonLoadingState = (buttonSelector, isLoading, title = "Simpan") => {
    const buttonText = isLoading
        ? `<div class="spinner-border spinner-border-sm me-2" role="status">
            </div>
        ${title}`
        : title;
    $(buttonSelector).prop("disabled", isLoading).html(buttonText);
};

const notification = (type, message) => {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: type,
        title: type === "success" ? "Success" : "Error",
        text: message,
    });
};

const getModal = (targetId, url = null, fields = null, hidefields = null) => {
    // Tampilkan modal
    $(`#${targetId}`).modal("show");

    // Reset validasi form
    $(`#${targetId} .form-control`).removeClass("is-invalid");
    $(`#${targetId} .invalid-feedback`).html("");

    // Jika ada elemen label modal, reset id dan ganti teks jadi "Tambah"
    const labelModal = $("#label-modal");
    if (labelModal.length) {
        $("#id").val("");
        labelModal.text("Tambah");
    }

    // Reset nilai semua input di modal jadi kosong
    $(`#${targetId} .form-control`).each(function () {
        const inputEl = $(this);
        if (inputEl.hasClass('summernote')) {
            inputEl.summernote('code', ''); // kosongkan editor
        } else {
            inputEl.val('');
        }
    });

    // Tampilkan semua form group dulu (reset jika sebelumnya ada yang disembunyikan)
    $(`#${targetId} .form-control`).each(function () {
        $(this).closest(".form-group").show();
    });

    // Jika ada field yang ingin disembunyikan, sembunyikan sekarang
    if (Array.isArray(hidefields)) {
        hidefields.forEach((fieldId) => {
            $(`#${targetId} #${fieldId}`).closest(".form-group").hide();
        });
    }

    // Jika ada url, berarti modal untuk edit, maka ambil data dari server
    if (url) {
        // Ubah label modal jadi "Edit"
        if (labelModal.length) {
            labelModal.text("Edit");
        }

        const successCallback = function (response) {
            if (fields && Array.isArray(fields)) {
                fields.forEach((field) => {
                    if (response.data && response.data[field] !== undefined) {
                        const inputEl = $(`#${targetId} #${field}`);
                        const value = response.data[field];
                            
                        // 🔥 Cek apakah elemen ini adalah Summernote
                        if (inputEl.hasClass('summernote')) {
                            inputEl.summernote('code', value ?? '');
                        } else {
                            inputEl.val(value);
                        }
                    }
                });
            }
        };

        const errorCallback = function (error) {
            console.error("Error getting data:", error);
        };

        ajaxCall(url, "GET", null, successCallback, errorCallback);
    }
};


const handleValidationErrors = (error, formId = null, fields = null) => {
    if (error.responseJSON.data && fields) {
        fields.forEach((field) => {
            if (error.responseJSON.data[field]) {
                $(`#${formId} #${field}`).addClass("is-invalid");
                $(`#${formId} #error${field}`).html(
                    error.responseJSON.data[field][0]
                );
            } else {
                $(`#${formId} #${field}`).removeClass("is-invalid");
                $(`#${formId} #error${field}`).html("");
            }
        });
    } else {
        notification("error", error.responseJSON.message);
    }
};

const handleSuccess = (
    response,
    dataTableId = null,
    modalId = null,
    redirect = null
) => {
    if (dataTableId !== null) {
        notification("success", response.message);
        $(`#${dataTableId}`).DataTable().ajax.reload();
    }

    if (modalId !== null) {
        $(`#${modalId}`).modal("hide");
    }

    if (redirect !== null) {
        if (redirect === "no") {
            notification("success", response.message ?? response);
        } else {
            notification("success", response.message ?? response);
            setTimeout(() => {
                window.location.href = redirect;
            }, 1500);
        }
    }
};

const handleError = (
    error,
    dataTableId = null,
    modalId = null,
    redirect = null
) => {
    let errorMessage = '';

    if (error.responseJSON && error.responseJSON.message) {
        errorMessage = error.responseJSON.message;
    } else if (error.message) {
        errorMessage = error.message;
    } else {
        errorMessage = JSON.stringify(error);
    }

    if (dataTableId !== null) {
        notification("error", errorMessage);
        $(`#${dataTableId}`).DataTable().ajax.reload();
    }

    if (modalId !== null) {
        $(`#${modalId}`).modal("hide");
    }

    if (redirect !== null) {
        if (redirect === "no") {
            notification("error", errorMessage);
        } else {
            notification("error", errorMessage);
            setTimeout(() => {
                window.location.href = redirect;
            }, 1500);
        }
    } else {
        notification("error", errorMessage);
    }
};


const confirmDelete = (url, tableId) => {
    Swal.fire({
        title: "Apakah Kamu Yakin?",
        text: "Ingin menghapus data ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            const data = null;

            const successCallback = function (response) {
                handleSuccess(response, tableId, null);
            };

            const errorCallback = function (error) {
                handleError(error, tableId, null);
            };

            ajaxCall(url, "DELETE", data, successCallback, errorCallback);
        }
    });
};

// Membuat Helper Select2
const select2ToJson = (selector, url) => {
    const selectElement = $(selector);

    // menghindari duplikasi select option 
    if (selectElement.children().length > 0) {
        return; // tidak melanjutkan proses jika select option sudah ada
    }

    const successCallback = function (response) {
        selectElement.append(
            $("<option>", { value: "", text: "-- Pilih Data --" })
        );

        response.data.forEach(function (row) {
            const option = $("<option>", { value: row.id, text: row.name });
            console.log(row);
            selectElement.append(option);
        });

        selectElement.select2({
            theme: "bootstrap4",
            width: "100%",
            dropdownParent: $("#createModal"),
        });
    };

    const errorCallback = function (error) {
        console.error(error);
    };

    ajaxCall(url, "GET", null, successCallback, errorCallback);
};