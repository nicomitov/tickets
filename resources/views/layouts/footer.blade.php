<footer class="footer">
    <div class="footer-block buttons">

    </div>

    <div class="footer-block author">
        <ul>
            <li>
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <a href="{{ route('lang.switch', $lang) }}" class="nav-link text-uppercase">
                            {{ $lang }}
                        </a>
                    @endif
                @endforeach

            </li>
            <li>
                <a class="nav-link unclickable">
                {{ config('app.name', 'Laravel') }} v. {{ config('app.version') }}
                </a>
            </li>
        </ul>
    </div>
</footer>
