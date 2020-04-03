<footer class="footer" style="background-color: #ededed">
    <div class="content has-text-centered">
        <p><img src='{{ asset("images/kolilogok/teljes_nagy.png") }}' width='150px'>
        <p>
            <strong>Mandák SmartKoli App</strong> created by <a href="https://hu.linkedin.com/in/agoston-fekete" target="_blank">Fekete Ágoston</a>.
            <br>Mandák grafikák by <a href="https://www.linkedin.com/in/lajos-m%C3%A1csai-b4a172165/" target="_blank">Mácsai Lajos</a>. Háttérképek by <a href="https://www.facebook.com/rompetydotcom/" target="_blank">Román Péter</a>.
        </p>
        <p>
            <a href="/privacy"><button class="button is-small is-outlined">
                <span class='icon'><i class="fas fa-user-lock"></i></span><span>Adatkezelési tájékoztató</span>
            </button></a>
        </p>
        <p>
            <a href='https://www.facebook.com/groups/492351804201360/' target='_blank'><img class='social-icon' src='{{ asset("images/icons/facebook.png") }}'></a>
            <a href='https://github.com/tonhal/smartkoli' target='_blank'><img class='social-icon' id="github-icon" src='{{ asset("images/icons/github.png") }}'></a>
        </p>
        <p>
            Jelenlegi verzió: <a href="https://github.com/tonhal/smartkoli/releases" target="_blank">{{ Config::get('app.version') }}</a>
        </p>
    </div>
</footer>
