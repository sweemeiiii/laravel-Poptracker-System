@extends('user_dashboard.layout')

@section('content')
<div class="container mt-4">
    <h1>My Collection</h1>

    <div class="text-align left mb-3">
        <a href="{{ route('figurines.create') }}" class="btn btn-primary">Add New Figurine</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
       <!-- Sidebar (Filters) -->
    <div class="col-lg-3 col-md-4 mb-4">
        <div class="p-3 bg-light rounded">
            <h4 class="mb-3">Search Filter</h4>
            <form method="GET" action="{{ route('figurines.index') }}">
                <!-- Series Filter -->
                <div class="mb-3">
                    <label class="form-label fw-bold d-block">Series</label>
                    <div class="accordion-filter">

                    <!-- The Monster -->
                    <div class="series-group mb-2">
                        <div class="d-flex justify-content-between align-items-center series-header" onclick="toggleEdition('monster')">
                            <div>
                                <input type="checkbox" name="series[]" value="The Monster"
                                    {{ in_array('The Monster', (array) request('series', [])) ? 'checked' : '' }}>
                                <label class="ms-2">The Monster</label>
                            </div>
                            <span id="toggle-icon-monster">+</span>
                        </div>
                        <div class="edition-options ms-4 mt-2 d-none" id="edition-monster">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="edition[]" id="monster-edition1"
                                    value="Have a Seat Vinyl Plush Blind Box"
                                    {{ in_array('Have a Seat Vinyl Plush Blind Box', (array) request('edition', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="monster-edition1">
                                    Have a Seat Vinyl Plush Blind Box
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="edition[]" id="monster-edition2"
                                    value="COCA-COLA Series"
                                    {{ in_array('COCA-COLA Series', (array) request('edition', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="monster-edition2">
                                    COCA-COLA Series
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Dimoo -->
                    <div class="series-group mb-2">
                        <div class="d-flex justify-content-between align-items-center series-header" onclick="toggleEdition('dimoo')">
                            <div>
                                <input type="checkbox" name="series[]" value="Dimoo"
                                    {{ in_array('Dimoo', (array) request('series', [])) ? 'checked' : '' }}>
                                <label class="ms-2">Dimoo</label>
                            </div>
                            <span id="toggle-icon-dimoo">+</span>
                        </div>
                        <div class="edition-options ms-4 mt-2 d-none" id="edition-dimoo">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="edition[]" id="dimoo-edition1"
                                    value="DISNEY Series"
                                    {{ in_array('DISNEY Series', (array) request('edition', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="dimoo-edition1">
                                    DISNEY Series
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="edition[]" id="dimoo-edition2"
                                    value="Animal Kingdom Series Figurines"
                                    {{ in_array('Animal Kingdom Series Figurines', (array) request('edition', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="dimoo-edition2">
                                    Animal Kingdom Series Figurines
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Crybaby -->
                    <div class="series-group mb-2">
                        <div class="d-flex justify-content-between align-items-center series-header" onclick="toggleEdition('crybaby')">
                            <div>
                                <input type="checkbox" name="series[]" value="Crybaby"
                                    {{ in_array('Crybaby', (array) request('series', [])) ? 'checked' : '' }}>
                                <label class="ms-2">Crybaby</label>
                            </div>
                            <span id="toggle-icon-crybaby">+</span>
                        </div>
                        <div class="edition-options ms-4 mt-2 d-none" id="edition-crybaby">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="edition[]" id="crybaby-edition1"
                                    value="Crying Again"
                                    {{ in_array('Crying Again', (array) request('edition', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="crybaby-edition1">
                                    Crying Again
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="edition[]" id="crybaby-edition2"
                                    value="Powerpuff Girls Series Figurines"
                                    {{ in_array('Powerpuff Girls Series Figurines', (array) request('edition', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="crybaby-edition2">
                                    Powerpuff Girls Series Figurines
                                </label>
                            </div>
                        </div>
                    </div>

                </div> <!-- .accordion-filter -->
            </div> 
                    <script>
                        function toggleEdition(id) {
                            const editionDiv = document.getElementById('edition-' + id);
                            const icon = document.getElementById('toggle-icon-' + id);

                            if (editionDiv.classList.contains('d-none')) {
                                editionDiv.classList.remove('d-none');
                                icon.textContent = '-';
                            } else {
                                editionDiv.classList.add('d-none');
                                icon.textContent = '+';
                            }
                        }
                    </script>

                   <!-- Rarity Filter -->
                    <div class="mb-2">
                        <label class="form-label fw-bold">Rarity</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rarity[]" value="Common" 
                                {{ in_array('Common', (array) request('rarity', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">Common</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rarity[]" value="Secret" 
                                {{ in_array('Secret', (array) request('rarity', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">Secret</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rarity[]" value="Super Secret" 
                                {{ in_array('Super Secret', (array) request('rarity', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">Super Secret</label>
                        </div>
                    </div>

                    <!-- Condition Filter -->
                    <div class="mb-2">
                        <label class="form-label fw-bold">Condition</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="condition[]" value="New" 
                                {{ in_array('New', (array) request('condition', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">New</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="condition[]" value="Used" 
                                {{ in_array('Used', (array) request('condition', [])) ? 'checked' : '' }}>
                            <label class="form-check-label">Used</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    <a href="{{ route('figurines.index') }}" class="btn btn-secondary w-100 mt-2">Clear Filters</a>
                </form>
            </div>
        </div>

        <!-- Main Content (Figurine Collection) -->
        <div class="col-lg-9 col-md-8">
            <!-- Search Bar -->
            <div class="flex items-center gap-2 p-4 bg-gray-100 rounded-lg">
                <form method="GET" action="{{ route('figurines.index') }}" class="relative w-full max-w-md">
                    <input type="text" name="search" class="w-full p-2 pl-10 border rounded-lg focus:ring focus:ring-red-300" 
                        placeholder="Search figurines..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">🔍</button>
                </form>
            </div>

                <!-- Filtering and Sorting Form (Moved Below Search) -->
            <form method="GET" action="{{ route('figurines.index') }}" class="mb-4 d-flex gap-3 mt-3">
                <!-- Filter by Series -->
                <select name="series" class="form-select" onchange="this.form.submit()">
                    <option value="all">All Series</option>
                    @foreach($series as $s)
                        <option value="{{ $s }}" {{ request('series') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>

                <!-- Filter by Rarity -->
                <select name="rarity" class="form-select" onchange="this.form.submit()">
                    <option value="all">All Rarities</option>
                    @foreach($rarities as $r)
                        <option value="{{ $r }}" {{ request('rarity') == $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>

                <!-- Sorting -->
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="date_added" {{ request('sort') == 'date_added' ? 'selected' : '' }}>Latest</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                    
                </select>
            </form>
        
            <!-- Figurine Grid -->
            <div class="row">
                @foreach($figurines as $figurine)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 d-flex justify-content-center">
                        <div class="card text-center shadow-sm position-relative">
                            <!-- Top-left stacked icons -->
                <div class="position-absolute top-0 start-0 m-2 d-flex flex-column align-items-start">
                    @if (in_array($figurine->id, $ownedIds))
                        <i class="fas fa-check-circle mb-1" style="color: #b8ed78; font-size: 1.5rem;" title="Owned"></i>
                    @endif
                    @if (in_array($figurine->id, $wishlistIds))
                        <i class="fas fa-heart" style="color: #ff8fa3; font-size: 1.5rem;" title="Wishlist"></i>
                    @endif
                </div>
                
                            <!-- Dropdown Menu -->
                            <div class="dropdown position-absolute top-0 end-0 m-2">
                                <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    ⋮
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item d-flex align-items-center" href="{{ route('figurines.edit', $figurine->id) }}">
                                            <i class="fa fa-pen me-2"></i> Edit
                                        </a>
                                    </li>
                                
                                    <li>
                                        <form action="{{ route('figurines.destroy', $figurine->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this figurine?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                                <i class="fa fa-trash me-2"></i> Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <!-- Clickable Image -->
                            <a href="{{ route('figurines.show', $figurine->id) }}" class="text-decoration-none">
                                <img src="{{ asset('storage/' . $figurine->imagePath) }}" class="img-fluid" alt="{{ $figurine->name }}">
                            </a>
                            <span style="
                            padding: 5px 10px; 
                            border-radius: 5px; 
                            font-weight: bold; 
                            display: inline-block;
                            background-color: 
                                {{ strtolower($figurine->rarity) === 'common' ? '#d97917' : 
                                (strtolower($figurine->rarity) === 'secret' ? '#6a0dad' : 
                                (strtolower($figurine->rarity) === 'super secret' ? '#686c53 ' : 'gray')) }};
                            color: white;
                            border: 1px solid #ccc;
                            ">
                                {{ strtoupper($figurine->rarity ?? 'N/A') }}
                            </span>

                            <div class="card-body text-start" style="font-family: 'Poppins', sans-serif;">
                                <p class="card-text">NAME: {{ $figurine->name}}</p>
                                <p class="card-text">SERIES: {{ $figurine->series }}</p>
                                <p class="card-text">EDITION: {{ $figurine->edition ?? 'N/A' }}</p>
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $figurines->appends(request()->query())->links() }}
            </div>
            
            <style>
                .rarity-box {
                    display: inline-block;
                    padding: 5px 10px;
                    border-radius: 5px;
                    font-weight: bold;
                    color: rgb(3, 3, 3);
                    text-transform: uppercase;
                    font-size: 14px;
                    margin-top: 10px; 
                }
            </style>

            @if($figurines->isEmpty())
                <p class="text-center">No figurines in your collection yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
