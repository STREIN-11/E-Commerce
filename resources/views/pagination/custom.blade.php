<nav>
    <div style="display: flex; justify-content: center; align-items: center; gap: 0.25rem; margin-top: 1rem;">
        @if ($paginator->hasPages())
            @if ($paginator->onFirstPage())
                <span style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #9ca3af; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">‹</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">‹</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #9ca3af; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span style="padding: 0.25rem; background: #3b82f6; color: white; border: 1px solid #3b82f6; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #374151; text-decoration: none; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">›</a>
            @else
                <span style="padding: 0.25rem; border: 1px solid #e5e7eb; color: #9ca3af; border-radius: 4px; font-size: 0.75rem; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">›</span>
            @endif
        @endif
    </div>
</nav>