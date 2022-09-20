<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if (isset($navBar) && isset($navBar->left->items))
                        <ul class="navbar-nav me-auto">
                            @foreach ($navBar->left->items as $leftNavitem)
                                @if (isset($leftNavitem->children) && count($leftNavitem->children) > 0)
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle"
                                            href="{{ $leftNavitem->nav_url }}" role="button" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false" v-pre>
                                            <span
                                                class="{{ $leftNavitem->nav_fa_fa_icon }}">&nbsp;{{ $leftNavitem->nav_name }}</i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            @foreach ($leftNavitem->children as $childitem)
                                                <a class="dropdown-item" href="{{ $childitem->nav_url }}"><span
                                                        class="{{ $childitem->nav_fa_fa_icon }}">&nbsp;{{ $childitem->nav_name }}</span></a>
                                            @endforeach
                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item"><a class="nav-link" href="{{ $leftNavitem->nav_url }}"><span
                                                class="{{ $leftNavitem->nav_fa_fa_icon }}">&nbsp;{{ $leftNavitem->nav_name }}</span></a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (isset($navBar) && isset($navBar->right->items))
                                @foreach ($navBar->right->items as $rightNavitem)
                                    @if (isset($rightNavitem->children))
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle"
                                                href="{{ $rightNavitem->nav_url }}" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <span
                                                    class="{{ $rightNavitem->nav_fa_fa_icon }}">&nbsp;{{ $rightNavitem->nav_name }}</i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                @foreach ($rightNavitem->children as $childitem)
                                                    <a class="dropdown-item" href="{{ $childitem->nav_url }}"><span
                                                            class="{{ $childitem->nav_fa_fa_icon }}">&nbsp;{{ $childitem->nav_name }}</span></a>
                                                @endforeach
                                            </div>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $rightNavitem->nav_url }}">
                                                <span
                                                    class="{{ $rightNavitem->nav_fa_fa_icon }}">&nbsp;{{ $rightNavitem->nav_name }}</span></a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="">Your Profile</a>
                                    <a class="dropdown-item" href="">Settings</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('inc.messages')
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/ckeditor_classic/ckeditor.js') }}"></script>
    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            if (document.getElementById('ck_editor_element')) {
                CKEDITOR.replace('ck_editor_element');
            }
        });
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                document.getElementById('notification_message_div').remove();
            }, 5000);
        });
    </script>
    <script type="text/javascript" defer>
        function doSubmit(e, formID, confirmMsg) {
            e.preventDefault();
            if (confirm(confirmMsg)) {
                let deleteForm = document.getElementById(formID);
                deleteForm.submit();
            }
        }
    </script>
</body>

</html>
