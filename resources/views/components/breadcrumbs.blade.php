@props(['items' => []])

@if(count($items) > 0)
<nav class="breadcrumbs" aria-label="Breadcrumb">
    <a href="{{ route('dashboard') }}">{{ __('ui.Dashboard') }}</a>
    @foreach($items as $item)
        <span>/</span>
        @if($loop->last)
            <strong>{{ $item['title'] }}</strong>
        @else
            <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
        @endif
    @endforeach
</nav>
@endif
