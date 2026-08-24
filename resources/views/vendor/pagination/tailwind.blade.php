@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;font-family:'Plus Jakarta Sans',sans-serif">

    {{-- Info teks --}}
    <p style="font-size:12px;color:#64748b;margin:0">
        @if ($paginator->firstItem())
            Menampilkan <strong>{{ $paginator->firstItem() }}</strong>–<strong>{{ $paginator->lastItem() }}</strong>
            dari <strong>{{ $paginator->total() }}</strong> data
        @else
            {{ $paginator->count() }} data
        @endif
    </p>

    {{-- Tombol halaman --}}
    <div style="display:flex;gap:4px;align-items:center;flex-wrap:wrap">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:7px;border:1.5px solid #f1f5f9;background:#f8fafc;color:#cbd5e1;cursor:not-allowed;font-size:13px" aria-disabled="true">
                <i class="bi bi-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:7px;border:1.5px solid #e2e8f0;background:white;color:#475569;text-decoration:none;font-size:13px;transition:all .15s"
               onmouseover="this.style.borderColor='#1c64f2';this.style.color='#1c64f2';this.style.background='#eff6ff'"
               onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';this.style.background='white'"
               aria-label="{{ __('pagination.previous') }}">
                <i class="bi bi-chevron-left"></i>
            </a>
        @endif

        {{-- Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                {{-- Ellipsis --}}
                <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;font-size:12px;color:#94a3b8;cursor:default">…</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              style="display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 8px;border-radius:7px;border:1.5px solid #1c64f2;background:#1c64f2;color:white;font-size:12px;font-weight:700;cursor:default">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           style="display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:32px;padding:0 8px;border-radius:7px;border:1.5px solid #e2e8f0;background:white;color:#475569;text-decoration:none;font-size:12px;font-weight:600;transition:all .15s"
                           onmouseover="this.style.borderColor='#1c64f2';this.style.color='#1c64f2';this.style.background='#eff6ff'"
                           onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';this.style.background='white'"
                           aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:7px;border:1.5px solid #e2e8f0;background:white;color:#475569;text-decoration:none;font-size:13px;transition:all .15s"
               onmouseover="this.style.borderColor='#1c64f2';this.style.color='#1c64f2';this.style.background='#eff6ff'"
               onmouseout="this.style.borderColor='#e2e8f0';this.style.color='#475569';this.style.background='white'"
               aria-label="{{ __('pagination.next') }}">
                <i class="bi bi-chevron-right"></i>
            </a>
        @else
            <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:7px;border:1.5px solid #f1f5f9;background:#f8fafc;color:#cbd5e1;cursor:not-allowed;font-size:13px" aria-disabled="true">
                <i class="bi bi-chevron-right"></i>
            </span>
        @endif

    </div>
</nav>
@endif
