@unless ($breadcrumbs->isEmpty())

    <ol class="breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class=""><a href="{{ $breadcrumb->url }}"><i class="{{ $breadcrumb->icon }}"></i> {{ $breadcrumb->title }}</a></li>                
            @else
                <li class="active"><i class="{{ $breadcrumb->icon }}"></i> {{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>

@endunless