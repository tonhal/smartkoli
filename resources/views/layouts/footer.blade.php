<footer class="border-top text-center">
    <div class="container">
        <img class="my-4" src='{{ asset("images/kolilogok/teljes_nagy.png") }}' width='150px'>
        <p><small class="text-muted">
            <strong>Mandák SmartKoli App</strong> created by <a href="https://hu.linkedin.com/in/agoston-fekete" target="_blank">Fekete Ágoston</a>.
            <br>Mandák grafikák by <a href="https://www.linkedin.com/in/lajos-m%C3%A1csai-b4a172165/" target="_blank">Mácsai Lajos</a>. Háttérképek by <a href="https://www.facebook.com/rompetydotcom/" target="_blank">Román Péter</a>.
        </small></p>
        <p class="text-muted">
            <a href="/privacy" class="btn btn-sm btn-outline-secondary">
                <span class='icon'><i class="fas fa-user-lock"></i></span><span>Adatkezelési tájékoztató</span>
            </a>
        </p>
        <p class="text-muted">
            <a href='https://www.facebook.com/groups/492351804201360/' target='_blank'><img height="32px" width="32px" class='social-icon' src='{{ asset("images/icons/facebook.png") }}'></a>
            <a href='https://github.com/tonhal/smartkoli' target='_blank'><img height="32px" width="32px" class='social-icon' id="github-icon" src='{{ asset("images/icons/github.png") }}'></a>
        </p>
        <p class="mb-0 pb-4 text-muted">
            Jelenlegi verzió: <a href="https://github.com/tonhal/smartkoli/releases" target="_blank">{{ Config::get('app.version') }}</a>
        </p>
    </div>
</footer>