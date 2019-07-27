<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @if (isset($thread))
        {{ $thread->title }} -
        @endif
        @if (isset($category))
        {{ $category->title }} -
        @endif
        {{ trans('forum::general.home_title') }}
    </title>

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <style>
        textarea {
            min-height: 200px;
        }

        .deleted {
            opacity: 0.65;
        }
    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>

<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">

                <div id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        <li class="nav-item"><a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a></li>

                        <li class="nav-item">
                            <a class="nav-link" href="/home">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/forum">Forum</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Field Reports</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

            <div class="container">
                @include ('forum::partials.breadcrumbs')
                @include ('forum::partials.alerts')

                @yield('content')
            </div>

        </main>
    </div>

    <script>
        var toggle = $('input[type=checkbox][data-toggle-all]');
        var checkboxes = $('table tbody input[type=checkbox]');
        var actions = $('[data-actions]');
        var forms = $('[data-actions-form]');
        var confirmString = "{{ trans('forum::general.generic_confirm') }}";

        function setToggleStates() {
            checkboxes.prop('checked', toggle.is(':checked')).change();
        }

        function setSelectionStates() {
            checkboxes.each(function() {
                var tr = $(this).parents('tr');

                $(this).is(':checked') ? tr.addClass('active') : tr.removeClass('active');

                checkboxes.filter(':checked').length ? $('[data-bulk-actions]').removeClass('hidden') : $('[data-bulk-actions]').addClass('hidden');
            });
        }

        function setActionStates() {
            forms.each(function() {
                var form = $(this);
                var method = form.find('input[name=_method]');
                var selected = form.find('select[name=action] option:selected');
                var depends = form.find('[data-depends]');

                selected.each(function() {
                    if ($(this).attr('data-method')) {
                        method.val($(this).data('method'));
                    } else {
                        method.val('patch');
                    }
                });

                depends.each(function() {
                    (selected.val() == $(this).data('depends')) ? $(this).removeClass('hidden'): $(this).addClass('hidden');
                });
            });
        }

        setToggleStates();
        setSelectionStates();
        setActionStates();

        toggle.click(setToggleStates);
        checkboxes.change(setSelectionStates);
        actions.change(setActionStates);

        forms.submit(function() {
            var action = $(this).find('[data-actions]').find(':selected');

            if (action.is('[data-confirm]')) {
                return confirm(confirmString);
            }

            return true;
        });

        $('form[data-confirm]').submit(function() {
            return confirm(confirmString);
        });
    </script>

    @yield('footer')
</body>

</html>