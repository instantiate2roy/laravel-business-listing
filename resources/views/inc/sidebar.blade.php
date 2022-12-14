<script src="{{ asset('js/sidebar.js') }}" defer></script>
<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <svg class="bi me-2" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-5 fw-semibold">{{ $sidebar->title }}</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">

            <div class="show" id="home-collapse">

                <ul class="btn-toggle-nav list-group fw-normal pb-1 small">
                    @foreach ($sidebar->items as $item)
                        <li>
                            <a href="{{ $item->nav_url }}"
                                class="list-group-item {{ $item->active }}">{{ $item->nav_name }}</a>
                        </li>
                    @endforeach
                </ul>


            </div>
        </li>
    </ul>
</div>
