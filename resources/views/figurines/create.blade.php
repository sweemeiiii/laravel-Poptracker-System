@extends('user_dashboard.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Add New Figurine</h2>
    <a href="{{ route('barcode.scan') }}" class="btn btn-primary">Add Figure with Barcode</a>
</div>

    <form action="{{ route('figurines.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="series" class="form-label">Series</label>
            <select class="form-control" id="series" name="series">
                <option value="THE MONSTER" {{ old('series') == 'THE MONSTER' ? 'selected' : '' }}>THE MONSTER</option>
                <option value="CRYBABY" {{ old('series') == 'CRYBABY' ? 'selected' : '' }}>CRYBABY</option>
                <option value="DIMOO" {{ old('series') == 'DIMOO' ? 'selected' : '' }}>DIMOO</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="edition" class="form-label">Edition</label> 
            <select class="form-control" id="edition" name="edition">
                <option value="Have a Seat Vinyl Plush Blind Box" {{ old('edition') == 'Have a Seat Vinyl Plush Blind Box' ? 'selected' : '' }}>Have a Seat Vinyl Plush Blind Box</option>
                <option value="COCA-COLA Series" {{ old('edition') == 'COCA-COLA Series' ? 'selected' : '' }}>COCA-COLA Series</option>
                <option value="Crying Again" {{ old('edition') == 'Crying Again' ? 'selected' : '' }}>Crying Again</option>
                <option value="Powerpuff Girls Series Figurines" {{ old('edition') == 'Powerpuff Girls Series Figurines' ? 'selected' : '' }}>Powerpuff Girls Series Figurines</option>
                <option value="DISNEY Series" {{ old('edition') == 'DISNEY Series' ? 'selected' : '' }}>DISNEY Series</option>
                <option value="Animal Kingdom Series Figures" {{ old('edition') == 'Animal Kingdom Series Figures' ? 'selected' : '' }}>Animal Kingdom Series Figures</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="purchaseDate" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchaseDate" name="purchaseDate" value="{{ old('purchaseDate') }}">
        </div>

        <div class="mb-3">
            <label for="condition" class="form-label">Condition</label>
            <select class="form-control" id="condition" name="condition">
                <option value="New" {{ old('condition') == 'New' ? 'selected' : '' }}>New</option>
                <option value="Used" {{ old('condition') == 'Used' ? 'selected' : '' }}>Used</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rarity" class="form-label">Rarity</label>
            <select class="form-control" id="rarity" name="rarity">
                <option value="common" {{ old('rarity') == 'Common' ? 'selected' : '' }}>Common</option>
                <option value="secret" {{ old('rarity') == 'Secret' ? 'selected' : '' }}>Secret</option>
                <option value="super secret" {{ old('rarity') == 'Super secret' ? 'selected' : '' }}>Super Secret</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success">Add Figurine</button>
        <a href="{{ route('figurines.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
