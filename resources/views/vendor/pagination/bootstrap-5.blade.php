@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center align-items-center mb-0 gap-2">

            {{-- Önceki Sayfa Linki --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link border-0 bg-transparent text-secondary d-flex align-items-center px-3 py-2 rounded-pill opacity-50" aria-hidden="true">
                        <i data-lucide="chevron-left" style="width: 18px; height: 18px;"></i>
                        <span class="ms-1 d-none d-sm-inline fw-medium">Önceki</span>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link border-0 text-body bg-transparent shadow-sm d-flex align-items-center px-3 py-2 rounded-pill transition-all" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i data-lucide="chevron-left" style="width: 18px; height: 18px;"></i>
                        <span class="ms-1 d-none d-sm-inline fw-medium">Önceki</span>
                    </a>
                </li>
            @endif

            {{-- Sayfa Numaraları --}}
            @foreach ($elements as $element)
                {{-- Üç Nokta (...) Ayırıcı --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link border-0 bg-transparent text-secondary px-2 py-2 fw-bold">{{ $element }}</span>
                    </li>
                @endif

                {{-- Link Dizisi --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link border-0 bg-primary text-white px-3 py-2 rounded-pill shadow fw-semibold" style="min-width: 42px; text-align: center;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link border-0 bg-transparent text-secondary px-3 py-2 rounded-pill fw-medium" href="{{ $url }}" style="min-width: 42px; text-align: center;">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Sonraki Sayfa Linki --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link border-0 text-body bg-transparent shadow-sm d-flex align-items-center px-3 py-2 rounded-pill transition-all" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <span class="me-1 d-none d-sm-inline fw-medium">Sonraki</span>
                        <i data-lucide="chevron-right" style="width: 18px; height: 18px;"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link border-0 bg-transparent text-secondary d-flex align-items-center px-3 py-2 rounded-pill opacity-50" aria-hidden="true">
                        <span class="me-1 d-none d-sm-inline fw-medium">Sonraki</span>
                        <i data-lucide="chevron-right" style="width: 18px; height: 18px;"></i>
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
