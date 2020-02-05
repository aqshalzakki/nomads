<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Paket Travel -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">travel packages</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $countTravelPackages }}
                </div>
            </div>
            <div class="col-auto">
                <i style="color: #5bc0de;" class="fas fa-hotel fa-2x"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Transaksi -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">transactions</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $countTransactions }}
                </div>
            </div>
            <div class="col-auto">
                <i style="color: #428bca;" class="fas fa-dollar-sign fa-2x"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Pending -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending</div>
                <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            {{ $countPendingTransactions }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <i style="color: #e8cb48 !important;" class="fas fa-spinner fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Sukses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">success</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                    {{ $countSuccessTransactions }}
                </div>
            </div>
            <div class="col-auto">
                <i style="color: #5cb85c;" class="fas fa-check fa-2x"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    
</div>