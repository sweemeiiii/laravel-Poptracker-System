@extends('user_dashboard.layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Figurine</h2>

    <form action="{{ route('figurines.update', $figurine->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="series" class="form-label">Series</label>
            <select class="form-control" id="series" name="series">
                {{-- Show the current saved series as selected --}}
                <option value="{{ $figurine->series }}" selected>{{ $figurine->series }}</option>
        
                {{-- Other available series --}}
                @php
                    $seriesList = ['THE MONSTER', 'CRYBABY', 'DIMOO'];
                @endphp
        
                @foreach ($seriesList as $series)
                    @if ($series !== $figurine->series)
                        <option value="{{ $series }}">{{ $series }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="edition" class="form-label">Edition</label>
            <select class="form-control" id="edition" name="edition">
                {{-- Show the current saved edition as the default selected option --}}
                <option value="{{ $figurine->edition }}" selected>{{ $figurine->edition }}</option>
        
                {{-- Other options for selection --}}
                @php
                    $editions = [
                        'Crying Parade Series',
                        'Crying Again',
                        'Powerpuff Girls Series Figurines',
                        'Have a Seat Vinyl Plush Blind Box',
                        'Animal Kingdom Series Figures',
                    ];
                @endphp
        
                @foreach ($editions as $edition)
                    @if ($edition !== $figurine->edition)
                        <option value="{{ $edition }}">{{ $edition }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="purchaseDate" class="form-label">Purchase Date</label>
            <input type="date" class="form-control" id="purchaseDate" name="purchaseDate" value="{{ old('purchaseDate', $figurine->purchaseDate) }}">
        </div>

        <div class="mb-3">
            <label for="condition" class="form-label">Condition</label>
            <select class="form-control" id="condition" name="condition">
                <option value="New" {{ old('condition', $figurine->condition) == 'New' ? 'selected' : '' }}>New</option>
                <option value="Used" {{ old('condition', $figurine->condition) == 'Used' ? 'selected' : '' }}>Used</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="rarity" class="form-label">Rarity</label>
            <select class="form-control" id="rarity" name="rarity">
                {{-- Show the current saved rarity as the default selected --}}
                <option value="{{ $figurine->rarity }}" selected>{{ ucfirst($figurine->rarity) }}</option>
        
                {{-- Other rarity options --}}
                @php
                    $rarities = ['common', 'secret', 'super secret'];
                @endphp
        
                @foreach ($rarities as $rarity)
                    @if ($rarity !== $figurine->rarity)
                        <option value="{{ $rarity }}">{{ ucfirst($rarity) }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        

        <button type="submit" class="btn btn-success">Update Figurine</button>
        <a href="{{ route('figurines.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
