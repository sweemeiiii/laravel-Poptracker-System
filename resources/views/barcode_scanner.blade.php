@extends('user_dashboard.layout')

@section('content')
<div class="container mt-4">
    <h2>Scan Figurine Barcode</h2>
    
    <!-- Back to Add Figurine Button -->
    <a href="{{ route('figurines.create') }}" class="btn btn-secondary mb-3">← Back to Add Figurine</a>

    <!-- Toggle Buttons -->
    <div class="mb-3">
        <button id="scanBtn" class="btn btn-outline-danger me-2">Scan</button>
        <button id="keyInBtn" class="btn btn-outline-danger">Key In</button>
    </div>

    <div class="row">
        <!-- Scanner Section and Fill-in Fields -->
        <div class="col-md-12 d-flex">
            <!-- Scanner Section -->
            <div id="scannerSection" class="mb-4" style="flex: 1; padding-right: 20px;">
                <div id="scanner-container" style="width: 100%; height: 322px; border: 2px solid #ccc;"></div>
                <!-- Clear Button for Scanner Section -->
                <button class="btn" id="clearScannerBtn" style="color: grey; text-decoration: underline; margin-top: 10px;">Clear</button>
            </div>

            <!-- Fill-in Section -->
            <div id="fillInSection" class="mb-4" style="flex: 1;">
                <div id="keyInSection" class="col-md-12 mb-4" style="display: none;">
                    <p>Key in the barcode number below:</p>
                    <div class="d-flex flex-wrap justify-content-start mb-3" id="digitInputs">
                        @for ($i = 0; $i < 10; $i++)
                            <input type="text" maxlength="1" class="form-control text-center me-1 mb-2 digit-box" style="width: 40px; height: 50px; font-size: 20px;">
                        @endfor
                    </div>
                    <button class="btn btn-success" id="submitDigitsBtn">Submit</button>
                    <button class="btn" id="clearKeyInBtn" style="color: grey; text-decoration: underline; margin-left: 10px;">Clear</button>
                </div>

                <!-- Shared Fill-in Form -->
                <form action="{{ route('figurines.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Series</label>
                        <input type="text" name="series" id="series" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Edition</label>
                        <input type="text" name="edition" id="edition" class="form-control" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Upload Image</label>
                        <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" required>
                        @if ($errors->has('image'))
                            <div class="invalid-feedback">
                                Please upload an image.
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label>Purchase Date</label>
                        <input type="date" name="purchase_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Condition</label>
                        <select name="condition" class="form-control" required>
                            <option value="new">New</option>
                            <option value="used">Used</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rarity">Rarity</label>
                        <select class="form-control" id="rarity" name="rarity">
                            <option value="common">Common</option>
                            <option value="secret">Secret</option>
                            <option value="super secret">Super Secret</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Add Figurine</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://unpkg.com/@ericblade/quagga2@1.2.6/dist/quagga.min.js"></script>
<script>
    const scanBtn = document.getElementById('scanBtn');
    const keyInBtn = document.getElementById('keyInBtn');
    const scannerSection = document.getElementById('scannerSection');
    const keyInSection = document.getElementById('keyInSection');
    const clearScannerBtn = document.getElementById('clearScannerBtn');

    scanBtn.addEventListener('click', () => {
        scannerSection.style.display = 'block';
        keyInSection.style.display = 'none';
        scanBtn.style.backgroundColor = '#C00000';
        scanBtn.style.color = 'white';
        keyInBtn.style.backgroundColor = 'white';
        keyInBtn.style.color = '#C00000';
    });

    keyInBtn.addEventListener('click', () => {
        scannerSection.style.display = 'none';
        keyInSection.style.display = 'block';
        keyInBtn.style.backgroundColor = '#C00000';
        keyInBtn.style.color = 'white';
        scanBtn.style.backgroundColor = 'white';
        scanBtn.style.color = '#C00000';
    });

    clearScannerBtn.addEventListener('click', () => {
        document.getElementById('name').value = '';
        document.getElementById('series').value = '';
        document.getElementById('edition').value = '';
        document.getElementById('rarity').value = 'common';
    });

    // QuaggaJS init
    window.addEventListener('load', () => {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#scanner-container'),
                constraints: {
                    width: 480,
                    height: 320,
                    facingMode: "environment"
                }
            },
            decoder: {
                readers: ["code_128_reader"]
            },
            locate: true
        }, function(err) {
            if (err) {
                console.error(err);
                alert("Error initializing barcode scanner.");
                return;
            }
            Quagga.start();
        });

        let lastScannedCode = null;

        Quagga.onDetected(result => {
            const code = result.codeResult.code;
            if (code !== lastScannedCode) {
                lastScannedCode = code;

                fetch(`/barcode-lookup/${code}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            document.getElementById('name').value = data.name;
                            document.getElementById('series').value = data.series;
                            document.getElementById('edition').value = data.edition;
                            document.getElementById('rarity').value = data.rarity;
                        }
                    })
                    .catch(err => {
                        console.error("Fetch error:", err);
                        alert("Failed to retrieve figurine details.");
                    });

                setTimeout(() => {
                    lastScannedCode = null;
                }, 3000);
            }
        });
    });

    // KEY IN SECTION LOGIC
    const digitInputs = document.querySelectorAll('.digit-box');

    digitInputs.forEach((input, index) => {
        input.addEventListener('input', (e) => {
            const value = input.value;
            if (/^[0-9]$/.test(value) && index < digitInputs.length - 1) {
                digitInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && input.value === '' && index > 0) {
                digitInputs[index - 1].focus();
            }
        });
    });

    document.getElementById('submitDigitsBtn').addEventListener('click', () => {
        const barcode = Array.from(digitInputs).map(input => input.value).join('');
        if (barcode.length !== 10) {
            alert("Please enter a 10-digit barcode.");
            return;
        }

        fetch(`/barcode-lookup/${barcode}`)
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById('name').value = data.name;
                    document.getElementById('series').value = data.series;
                    document.getElementById('edition').value = data.edition;
                    document.getElementById('rarity').value = data.rarity;
                }
            })
            .catch(err => {
                console.error("Fetch error:", err);
                alert("Failed to retrieve figurine details.");
            });
    });

    document.getElementById('clearKeyInBtn').addEventListener('click', () => {
        digitInputs.forEach(input => input.value = '');
        document.getElementById('name').value = '';
        document.getElementById('series').value = '';
        document.getElementById('edition').value = '';
        document.getElementById('rarity').value = 'common';
        digitInputs[0].focus();
    });
</script>
@endsection
