<nav class="navbar is-fixed-top is-light" role="navigation" aria-label="main navigation" style="background-color: #ededed">
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
                    <span class='icon' style="color: #e3c900"><i class="fas fa-tshirt"></i></span><span>Mosások</span>
                </a>
        
                <a class="navbar-item" href="/guests">
                    <span class='icon' style="color:crimson"><i class="fas fa-bed"></i></span><span>Vendégtáblázat</span>
                </a>

                <a class="navbar-item" href="/files">
                    <span class='icon' style="color: #217537"><i class="fas fa-file-alt"></i></span><span>Feltöltések</span>
                </a>

                <a class="navbar-item" href="https://trello.com/b/iRXaTCho/koli" target="_blank">
                    <span class='icon' style="color: #017ac2"><i class="fab fa-trello"></i></span><span>Hibabejelentés</span>
                </a>
            </div>
        
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                     <a class="navbar-link">
                        <span class='icon'><i class="fas fa-user"></i></span><span>{{ auth()->user()->name }}</span>                        
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

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach( el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });
        }

    });
</script>
      