@extends('user_dashboard.layout')

@section('content')
    <h2>My Owned Figurines</h2>

    <!-- 🔍 Search and Sort -->
    <div class="d-flex justify-content-between align-items-center my-3 flex-wrap gap-3">
        <input type="text" id="searchInput" class="form-control w-50" placeholder="Search figurine name...">

        <select id="sortSelect" class="form-select w-25">
            <option value="">Sort By</option>
            <option value="name">Name (A-Z)</option>
            <option value="edition">Edition (A-Z)</option>
        </select>
    </div>

    <!-- 📦 Grouped Series -->
    @forelse($groupedOwned as $seriesName => $items)
    <div class="p-3 mb-4 border rounded series-box" style="border: 1px solid black !important;" data-series="{{ $seriesName }}">

            <h4>{{ $seriesName }} <span class="badge bg-secondary">{{ $items->count() }} items</span></h4>
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-4 mb-4 figurine-card" 
                    data-name="{{ strtolower($item->figurine->name) }}" 
                    data-edition="{{ strtolower($item->figurine->edition) }}"
                    data-series="{{ strtolower($item->figurine->series) }}" >
                        <div class="card position-relative">
                            <form action="{{ route('owned.destroy', $item->figurine_id) }}" method="POST" 
                                onsubmit="return confirm('Are you sure you want to remove this figurine from your collection?');"
                                class="position-absolute top-0 end-0 m-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                            <img src="{{ asset('storage/' . $item->figurine->imagePath) }}" 
                                class="card-img-top img-fluid mx-auto mt-3"
                                style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;" 
                                alt="Figurine Image">
                            <div class="card-body text-center">
                                <h5>{{ $item->figurine->name }}</h5>
                                <p>Edition: {{ $item->figurine->edition }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <p>You have not added any figurines to your collection yet.</p>
    @endforelse

    <!-- 🔍 Search and Sort Script -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            document.querySelectorAll('.figurine-card').forEach(card => {
                const name = card.dataset.name || '';
                const series = card.dataset.series || '';
                const matches = name.includes(query) || series.includes(query);
                card.style.display = matches ? '' : 'none';
            });
        });


        sortSelect.addEventListener('change', function () {
            const sortBy = this.value;
            document.querySelectorAll('.series-box').forEach(box => {
                const row = box.querySelector('.row');
                const cards = Array.from(row.querySelectorAll('.figurine-card'));

                cards.sort((a, b) => {
                    const aVal = a.dataset[sortBy] ?? '';
                    const bVal = b.dataset[sortBy] ?? '';
                    return aVal.localeCompare(bVal);
                });

                // Re-append in sorted order
                cards.forEach(card => row.appendChild(card));
            });
        });
    </script>
@endsection


{{-- @section('content')
    <h2>My Owned Figurines</h2>

    <div class="row">
        @foreach ($owned as $item)
            <div class="col-md-4 mb-4">
                <div class="card position-relative">
                    <!-- Remove button at top-right corner -->
                    <form action="{{ route('owned.destroy', $item->figurine_id) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to remove this figurine from your collection?');"
                          class="position-absolute top-0 end-0 m-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>

                    <img src="{{ asset('storage/' . $item->figurine->imagePath) }}" 
                         class="card-img-top img-fluid mx-auto mt-3"
                         style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px;" 
                         alt="Figurine Image">
                    <div class="card-body text-center">
                        <h5>{{ $item->figurine->name }}</h5>
                        <p>Series: {{ $item->figurine->series }}</p>
                        <p>Edition: {{ $item->figurine->edition }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection --}}
