@extends('user_dashboard.layout')    

@section('content')
<div class="container-fluid">

    {{-- Welcome Header --}}
    <div class="mb-4">
        <h2 class="fw-bold">Welcome to Your Dashboard</h2>
        <p class="text-muted">Track your collectible progress and stats here.</p>
    </div>

    {{-- Calculate total count for display --}}
    @php
        $totalFigurines = $ownedCount + $wishlistCount + $duplicateCount;
    @endphp

    {{-- Collection Summary Cards --}}
    <div class="row g-4">
        <!-- Total Collection -->
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Total Collection</h5>
                    <h2>{{ $totalFigurines }}</h2>
                </div>
            </div>
        </div>

        <!-- Owned Figurines Card -->
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Owned Figurines</h5>
                    <h2>{{ $ownedCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Wishlist Figurines Card -->
        <div class="col-md-4">
            <div class="card bg-warning text-dark shadow-sm h-100">
                <div class="card-body text-center">
                    <h5>Wishlist Figurines</h5>
                    <h2>{{ $wishlistCount }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Collection Progress Bars --}}
    <div class="mt-5">
        <h4 class="fw-bold">Collection Progress</h4>

        <!-- Owned Progress Bar -->
        <div class="progress my-3" style="height: 50px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                role="progressbar" style="width: {{ $ownedPercentage }}%;"
                aria-valuenow="{{ $ownedPercentage }}" aria-valuemin="0" aria-valuemax="100">
                Owned ({{ $ownedCount }}) - {{ $ownedPercentage }}%
            </div>
        </div>

        <!-- Wishlist Progress Bar -->
        <div class="progress my-3" style="height: 50px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark"
                role="progressbar" style="width: {{ $wishlistPercentage }}%;"
                aria-valuenow="{{ $wishlistPercentage }}" aria-valuemin="0" aria-valuemax="100">
                Wishlist ({{ $wishlistCount }}) - {{ $wishlistPercentage }}%
            </div>
        </div>

        <!-- Duplicate Progress Bar -->
        <div class="progress my-3" style="height: 50px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                role="progressbar" style="width: {{ $duplicatePercentage }}%;"
                aria-valuenow="{{ $duplicatePercentage }}" aria-valuemin="0" aria-valuemax="100">
                Duplicate ({{ $duplicateCount }}) - {{ $duplicatePercentage }}%
            </div>
        </div>
    </div>

    {{-- Visuals Section (Charts and QR Code) --}}
    <div class="row mt-5 g-4">
        <!-- Pie Chart Card -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4 h-100">
                <h5 class="text-center mb-3">Visual Collection Progress</h5>
                <canvas id="collectionChart"></canvas>
            </div>
        </div>

        <!-- QR Code Display -->
        <div class="col-md-6">
            <div class="card shadow-sm p-4 text-center h-100 position-relative">
                <h5 class="mb-3">Your Collection QR Code</h5>
                <div class="qr-btn-container">
                    <button id="openQrModal" class="btn qr-btn">
                        <img class="icon" src="{{ asset('images/qrcode.png') }}" alt="QR Code Icon"> Your Collection QR Code
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code Modal -->
    <div id="qrModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-4 p-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Your Collection QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="modal-qrcode" class="mb-4"></div>
                    <div class="d-flex justify-content-center align-items-center bg-light rounded-pill p-2 px-3">
                        <input type="text" id="modal-qr-url" class="form-control border-0 bg-transparent" readonly>
                        <button id="copyQrUrl" class="btn btn-sm btn-outline-secondary ms-2">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="copyToast" class="position-fixed top-0 start-50 translate-middle-x m-4 toast align-items-center text-white bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                URL copied to clipboard!
            </div>
        </div>
    </div>

</div>

{{-- Chart.js Pie Chart Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('collectionChart').getContext('2d');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ["Owned", "Wishlist", "Duplicate"],
                datasets: [{
                    data: [{{ $ownedCount }}, {{ $wishlistCount }}, {{ $duplicateCount }}],
                    backgroundColor: ["#28a745", "#ffc107", "#dc3545"]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true
            }
        });
    });
</script>

{{-- QR Code Generator --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const qrModal = new bootstrap.Modal(document.getElementById('qrModal'));
        const qrUrl = "{!! route('owned.index', ['id' => auth()->user()->id]) !!}";

        document.getElementById('openQrModal').addEventListener('click', () => {
            // Generate QR code inside modal
            const modalQrContainer = document.getElementById("modal-qrcode");
            modalQrContainer.innerHTML = "";
            new QRCode(modalQrContainer, {
                text: qrUrl,
                width: 200,
                height: 200
            });

            document.getElementById("modal-qr-url").value = qrUrl;
            qrModal.show();
        });

        // Copy to clipboard and show toast
        document.getElementById("copyQrUrl").addEventListener("click", () => {
            const input = document.getElementById("modal-qr-url");
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);

            const toast = new bootstrap.Toast(document.getElementById('copyToast'));
            toast.show();

            // Hide toast after 2 seconds
            setTimeout(() => {
                toast.hide();
            }, 2000);
        });
    });
</script>

@endsection

<style>
    .qr-btn {
        background-color: red !important; /* Ensure the background is red by default */
        color: white !important; /* Make the text white */
        font-size: 0.7rem; /* Smaller font size */
        padding: 5px 10px; /* Reduced padding for a smaller button */
        border-radius: 25px; /* Round rectangle shape */
        transition: background-color 0.3s ease;
        width: auto; /* Button width adjusts automatically to the text size */
        border: none; /* Remove default button border */
        display: flex;
        align-items: center; /* Center align the content */
        justify-content: center; /* Center the content */
        margin: 0 auto; /* Centers the button horizontally */
    }

    .qr-btn img {
        width: 15px; /* Adjust icon size to be smaller */
        height: 15px; /* Adjust icon size to be smaller */
        margin-right: 5px; /* Space between the icon and text */
    }

    .qr-btn:hover {
        background-color: black !important; /* Hover color change to black */
    }

    #copyToast {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050; /* Ensure it stays on top of other elements */
    }
</style>
