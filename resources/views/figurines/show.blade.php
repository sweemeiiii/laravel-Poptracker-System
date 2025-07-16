@extends('user_dashboard.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items">
        <h1>{{ $figurine->name }}</h1>

        <div class="d-flex justify-content-between align-items-right">
        <!-- Wishlist Button -->
        <form action="{{ route('wishlists.store') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="figurine_id" value="{{ $figurine->id }}">
            <button type="submit" class="btn btn-light me-2"> <!-- Added "me-2" for spacing -->
                <i class="fas fa-heart"></i>
            </button>
        </form>

        <!-- Add to Owned Button -->
        <form action="{{ route('owned.store') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="figurine_id" value="{{ $figurine->id }}">
            <button type="submit" class="btn btn-success me-2"> <!-- Added "me-2" for spacing -->
                <i class="fas fa-check-circle"></i>
            </button>
        </form>

        <!-- Add to Duplicates Button -->
        <form action="{{ route('duplicates.store') }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="figurine_id" value="{{ $figurine->id }}">
            <button type="submit" class="btn btn-warning"> 
                <i class="fas fa-clone"></i>
            </button>
        </form>
        </div>
    </div>

    <div class="text-center">
        <img src="{{ asset('storage/' . $figurine->imagePath) }}" class="img-fluid" alt="{{ $figurine->name }}">
    </div>

    <div class="mt-4">
        <h4>Details</h4>
        <ul class="list-group">
            <li class="list-group-item"><strong>Brand:</strong> POP MART</li>
            <li class="list-group-item"><strong>Size:</strong> 
                <ul>
                    <li>Height: about 8*7*20cm (including hanging loop)</li>
                    <li>Height: about 8*7*15cm (excluding hanging loop)</li>
                </ul>
            </li>
            <li class="list-group-item"><strong>Series:</strong> {{ $figurine->series }}</li>
            <li class="list-group-item"><strong>Edition:</strong> {{ $figurine->edition ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Condition:</strong> {{ $figurine->condition ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Purchase Date:</strong> {{ $figurine->purchaseDate }}</li>
            {{-- <li class="list-group-item"><strong>Categories:</strong> {{ $figurine->categories }}</li> --}}
            <li class="list-group-item">
                <strong>Rarity:</strong> 
                <span style="
                    padding: 5px 10px; 
                    border-radius: 5px; 
                    font-weight: bold; 
                    display: inline-block;
                    background-color: 
                        {{ strtolower($figurine->rarity) === 'common' ? 'white' : 
                           (strtolower($figurine->rarity) === 'secret' ? 'gold' : 
                           (strtolower($figurine->rarity) === 'super secret' ? '#eddded' : 'gray')) }};
                    color: black;
                    border: 1px solid #ccc;
                ">
                    {{ ucfirst($figurine->rarity) }}
                </span>
            </li>
            
            
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('figurines.index') }}" class="btn btn-secondary">Back to Collection</a>
    </div>
</div>
@endsection
