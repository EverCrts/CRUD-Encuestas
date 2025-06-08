@if ($paginator->hasPages())
    <div class="flex flex-col items-center">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            {!! __('Showing') !!}
            @if ($paginator->firstItem())
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->lastItem() }}</span>
            @else
                <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->count() }}</span>
            @endif
            {!! __('of') !!}
            <span class="font-semibold text-gray-900 dark:text-white">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </span>

        <!-- Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-400 bg-gray-800 rounded-s cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-400 bg-gray-800 border-0 border-s border-gray-700 rounded-e cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>
    </div>
@endif
