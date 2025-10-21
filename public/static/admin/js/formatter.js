const formatRupiah = (angka) => {
    var reverse = angka.toString().split("").reverse().join(""),
        ribuan = reverse.match(/\d{1,3}/g);
    ribuan = ribuan.join(".").split("").reverse().join("");
    return "Rp " + ribuan;
};

const formatTime = (datetimeStr) => {
    const date = new Date(datetimeStr);
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    return `${hours}:${minutes}`;
};

function statusBadge(status) {
    const statusIcon = (status == '0') ? '<i class="bi bi-x-circle me-1"></i>' : '<i class="bi bi-check-circle me-1"></i>';
    
    const statusClass = (status == '0') ? 'bg-danger' : 'bg-success';
    
    const statusText = (status == '0') ? 'Unpaid' : 'Paid';

    // Kembalikan elemen badge sebagai string HTML
    return `<span class='badge d-inline-flex align-items-baseline ${statusClass}'>${statusIcon} ${statusText}</span>`;
}

function orderStatusBadge(status) {
    let statusIcon, statusClass, statusText;

    // Tentukan ikon, kelas, dan teks berdasarkan status
    switch (status) {
        case 'cancel':
            statusIcon = '<i class="bi bi-x-circle me-1"></i>';
            statusClass = 'bg-danger';
            statusText = 'Menunggu Pembayaran';
            break;

        case 'process':
            statusIcon = '<i class="bi bi-arrow-repeat me-1"></i>';
            statusClass = 'bg-warning';
            statusText = 'Dalam Proses';
            break;

        case 'done':
            statusIcon = '<i class="bi bi-check-circle me-1"></i>';
            statusClass = 'bg-success';
            statusText = 'Pesanan Selesai';
            break;

        default:
            statusIcon = '<i class="bi bi-question-circle me-1"></i>';
            statusClass = 'bg-secondary';
            statusText = 'Unknown';
            break;
    }

    // Kembalikan elemen badge sebagai string HTML
    return `<span class='badge d-inline-flex align-items-baseline ${statusClass}'>${statusIcon} ${statusText}</span>`;
}