@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center mt-7">

        <div class="sm:flex-1 sm:flex sm:items-center sm:justify-center">
            <div>
                <span id="paginate" class="relative z-0 inline-flex rtl:flex-row-reverse gap-1">
                    @php
                        $pageInfo = [
                            'previousPage' => $paginator->currentPage() > 1 ? $paginator->currentPage() - 1 : null,
                            'nextPage' => $paginator->currentPage() < $paginator->lastPage() ? $paginator->currentPage() + 1 : null,
                            'firstPage' => 1,
                            'lastPage' => $paginator->lastPage(),
                        ];
                    @endphp
                    {{-- Previous Page Link --}}
                    @if (!$paginator->onFirstPage())
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex justify-center items-center px-2 py-2 text-sm border border-gray-300 bg-gray-300 rounded-lg hover:bg-gray-400 w-8 h-8 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="inline-flex justify-center items-center px-2 py-2 text-sm text-white border {{ $role == 'staff' ? 'border-primary bg-primary' : 'border-primary-user bg-primary-user' }} rounded-lg w-8 h-8 transition ease-in-out duration-150">{{ $page }}</span>
                                    </span>
                                @elseif (in_array($page, $pageInfo))
                                    <a href="{{ $url }}" class="inline-flex justify-center items-center px-2 py-2 text-sm border border-gray-300 bg-gray-300 rounded-lg hover:bg-gray-400 w-8 h-8 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @elseif (in_array($page - 1, $pageInfo))
                                    <span aria-disabled="true">
                                        <span class="inline-flex justify-center items-center px-2 py-2 text-sm border border-gray-300 bg-gray-300 rounded-lg hover:bg-gray-400 w-8 h-8 transition ease-in-out duration-150">...</span>
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex justify-center items-center px-2 py-2 text-sm border border-gray-300 bg-gray-300 rounded-lg hover:bg-gray-400 w-8 h-8 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            >
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
