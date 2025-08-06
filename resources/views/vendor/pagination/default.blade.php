<style>
    .pagination-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #30363d;
        font-family: sans-serif;
    }

    .pagination-summary {
        font-size: 14px;
        color: #8b949e;
    }

    .pagination-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    @media (min-width: 768px) {
        .pagination-container {
            flex-direction: row;
            justify-content: space-between;
        }
    }

    .pagination-button, .pagination-dots {
        display: inline-block;
        padding: 8px 14px;
        color: #8b949e;
        background-color: #161b22;
        border: 1px solid #30363d;
        border-radius: 6px;
        text-decoration: none;
        transition: background-color 0.2s ease, border-color 0.2s ease;
        line-height: 1;
        text-align: center;
    }

    a.pagination-button:hover {
        background-color: #21262d;
        border-color: #8b949e;
    }

    .pagination-button.active {
        background-color: #1f6feb;
        border-color: #1f6feb;
        color: #fff;
        cursor: default;
    }

    .pagination-button.disabled {
        background-color: transparent;
        border-color: transparent;
        color: #484f58;
        cursor: not-allowed;
    }

    .pagination-dots {
        background-color: transparent;
        border-color: transparent;
        padding: 8px 4px;
    }
</style>

@if ($paginator->hasPages())
    <div class="pagination-container">
        <div class="pagination-summary">
            @if ($paginator->total() > 0)
                @if ($paginator->firstItem() === $paginator->lastItem())
                    Showing result {{ $paginator->firstItem() }} of {{ $paginator->total() }}
                @else
                    Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
                @endif
            @else
                No results found
            @endif
        </div>
        <div class="pagination-links">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-button disabled">Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-button" rel="prev">Previous</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-button active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-button">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-button" rel="next">Next</a>
            @else
                <span class="pagination-button disabled">Next</span>
            @endif
        </div>
    </div>
@endif
