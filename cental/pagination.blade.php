<style>
    .pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-link {
    margin: 0 5px;
    padding: 8px 12px;
    background-color: #f8f9fa;
    color: #8800ff;
    border: 1px solid #dee2e6;
    text-decoration: none;
    border-radius: 4px;
}

.pagination-link:hover {
    background-color: #e9ecef;
    color: #6900c5;
}

.pagination-link.active {
    background-color: #8800ff;
    color: #fff;
    pointer-events: none;
}

.pagination-disabled {
    margin: 0 5px;
    padding: 8px 12px;
    background-color: #e9ecef;
    color: #6c757d;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    pointer-events: none;
}

</style>


        <div class="pagination-wrapper">
            @if ($users->onFirstPage())
                <span class="pagination-disabled">Previous</span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="pagination-link">Previous</a>
            @endif

            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="pagination-link {{ $users->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="pagination-link">Next</a>
            @else
                <span class="pagination-disabled">Next</span>
            @endif
        </div>

{{-- advance  --}}

  <!-- Custom Pagination -->
  <div class="pagination-wrapper">
    @if ($users->onFirstPage())
        <span class="pagination-disabled">Previous</span>
    @else
        <a href="{{ $users->previousPageUrl() }}" class="pagination-link">Previous</a>
    @endif

    @php
        $currentPage = $users->currentPage();
        $lastPage = $users->lastPage();
        $startPage = max(1, $currentPage - 2); 
        $endPage = min($lastPage, $currentPage + 2); 

        if ($endPage - $startPage < 4) {
            $endPage = min($startPage + 4, $lastPage);
        }
        if ($startPage > 1) {
            $startPage = max(1, $endPage - 4);
        }
    @endphp

    @for ($page = $startPage; $page <= $endPage; $page++)
        <a href="{{ $users->url($page) }}" class="pagination-link {{ $users->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
    @endfor

    @if ($users->hasMorePages())
        <a href="{{ $users->nextPageUrl() }}" class="pagination-link">Next</a>
    @else
        <span class="pagination-disabled">Next</span>
    @endif
</div>