<x-layout page="catalogue">
    <div class="catalogue-header">
        <h1 class="title">
            Library Catalogue
            <span id="catalogue-count" class="catalogue-count"></span>
        </h1>

        {{-- Search --}}
        <div class="catalogue-search-wrap">
            <input type="search" id="catalogue-search" class="input catalogue-search"
                placeholder="Search by title or author...">
        </div>
    </div>

    {{-- Genre filter buttons --}}
    <nav id="catalogue-genres" class="genre-nav" aria-label="Filter by genre"></nav>

    {{-- Book grid: populated by catalogue.js --}}
    <div id="catalogue-grid" class="catalogue-grid">
        <p class="catalogue-loading">Loading books...</p>
    </div>

    {{-- Pagination: rendered by catalogue.js --}}
    <div id="catalogue-pagination" class="catalogue-pagination"></div>
</x-layout>
