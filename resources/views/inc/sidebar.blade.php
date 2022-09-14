<script src="{{ asset('js/sidebar.js') }}" defer></script>
<link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <svg class="bi me-2" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-5 fw-semibold">Configuration Setup</span>
    </a>
    <ul class="list-unstyled ps-0">
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse"
                data-bs-target="#home-collapse" aria-expanded="true">
                Metadata
            </button>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="/lookups" class="link-dark rounded">Lookups</a></li>
                    <li><a href="#" class="link-dark rounded">blank</a></li>
                    <li><a href="#" class="link-dark rounded">Blank</a></li>
                </ul>
            </div>
        </li>



    </ul>
</div>
