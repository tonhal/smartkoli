<nav class="navbar is-fixed-top is-info" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <p class="navbar-item">
                <img src='{{ asset("images/kolilogok/szoveg_nagy.png") }}'>
            </p>
        
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">
                    Mosások
                </a>
        
                <a class="navbar-item" href="https://docs.google.com/spreadsheets/d/1BrPCjQ9-M2iomLdU1OXIHOhCMwranRmO58yU1Yj-L58/edit?usp=sharing" target="_blank">
                    Vendégtáblázat
                </a>

                <a class="navbar-item" href="https://trello.com/b/iRXaTCho/koli" target="_blank">
                    Fáj a pöcsöm!
                </a>

                <a class="navbar-item" href="https://trello.com/b/iRXaTCho/koli" target="_blank">
                    Dokumentumok
                </a>
            </div>
        
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                     <a class="navbar-link">
                        {{ auth()->user()->name }}
                     </a>
                     <div class="navbar-dropdown">
                        <a class="navbar-item" href='/logout'>
                           Kijelentkezés
                        </a>
                     </div>
                </div>
            </div>
        </div>
    </div>
</nav>
      