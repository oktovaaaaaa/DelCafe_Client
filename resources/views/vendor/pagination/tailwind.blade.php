@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                    &larr; {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-200">
                    &larr; {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-200">
                    {!! __('pagination.next') !!} &rarr;
                </a>
            @else
                <span class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-md">
                    {!! __('pagination.next') !!} &rarr;
                </span>
            @endif
        </div>

        <div class="hidden sm:flex sm:items-center sm:justify-between w-full">
            <p class="text-sm text-gray-700">
                {!! __('Showing') !!} <span class="font-medium">{{ $paginator->firstItem() }}</span> {!! __('to') !!} <span class="font-medium">{{ $paginator->lastItem() }}</span> {!! __('of') !!} <span class="font-medium">{{ $paginator->total() }}</span> {!! __('results') !!}
            </p>

            <div class="flex space-x-1">
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 border border-gray-300 rounded-l-md">&larr;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-200">&larr;</a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-2 text-gray-700 border border-gray-300">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-2 text-white bg-blue-500 border border-blue-500">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 hover:bg-gray-200">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-200">&rarr;</a>
                @else
                    <span class="px-3 py-2 text-gray-400 border border-gray-300 rounded-r-md">&rarr;</span>
                @endif
            </div>
        </div>
    </nav>
@endif
