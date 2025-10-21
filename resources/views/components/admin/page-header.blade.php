<style>
.kasir-nav {
    background: rgba(255, 255, 255, 0.2); 
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 8px 20px;
    margin: 0 auto;
    width: fit-content;
    box-shadow: 0 2px 10px rgba(0,0,0,0.15);
}
.kasir-nav .nav-link {
    color: #fff;
    font-weight: 500;
}
.kasir-nav .nav-link.active {
    background: #fff;
    color: #007bff;
    border-radius: 20px;
}

/* box statistik */
.stats-box {
    background: rgba(255, 255, 255, 0.685); 
    border-radius: 16px;
    padding: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    text-align: center;
    width: 100%;
    max-width: 190px;
    margin-left: auto;
}

.stats-box h4 {
    font-size: 1.5rem;
    margin: 0;
}
</style>

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <div class="pcoded">
            <!-- Page-header start -->
            <div class="page-header pt-5">
                <div class="page-block">
                    <div class="row align-items-center">
                        
                        <!-- kiri -->
                        <div class="col-md-4 col-4">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Dashboard</h5>
                                {{-- <p class="m-b-0">Halo {{ Auth::user()->name }}, sistem kasir siap digunakan.</p> --}}
                            </div>
                        </div>

                        <!-- tengah -->
                        <div class="col-md-4 col-4 text-center">
                            <div class="kasir-nav">
                                <ul class="nav nav-tabs justify-content-center mb-0">
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('admin/tasks') ? 'active' : '' }}" href="/admin/tasks">
                                            <i class="fa fa-cutlery"></i> Tasks
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="/admin/users">
                                            <i class="fa fa-shopping-cart"></i> Users
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- kanan -->
                        <div class="col-md-4 col-4">
                            <div class="stats-box">
                                <span class="fw-bold d-block text-dark">
                                    {{-- Transaksi Hari Ini</i> <b style="font-size: 1rem">{{ $jumlahTransaksiPerHari }}</b> --}}
                                </span>
                                {{-- <small class="fw-bold text-success"><b style="font-size: 1.1rem">{{ formatRupiah($totalNominalPerHari) }}</b></small><br> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Page-header end -->
        </div>
    </div>
</div>
