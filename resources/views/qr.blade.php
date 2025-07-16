@extends('user_dashboard.layout') 

@section('content')
    <div class="container mt-4">
        <h3>Welcome to Your Dashboard</h3>
        
        <!-- QR Code Section -->
        <div class="qr-code-container text-center mt-4">
            <h5>Scan to View My Collection</h5>
            <div id="qrcode"></div>
        </div>

        <!-- Other dashboard content -->
    </div>
@endsection

@section('scripts')
    <!-- Include QR Code JS Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userCollectionURL = "{{ route('user.dashboard', ['id' => auth()->user()->id]) }}"; // URL to user's collection
            var qrCode = new QRCode(document.getElementById("qrcode"), {
                text: userCollectionURL,
                width: 200,
                height: 200
            });
        });
    </script>
@endsection
