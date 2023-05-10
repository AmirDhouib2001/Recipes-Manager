<?php $logged=isset($_SESSION['nickname']) ?>

<header class="header1">
    <div class="logo-container">
        <img src="/images/Zwita2.png" alt="Logo">
    </div>
    <div class="search-dropdown-container">
        <form class="search-form" method="post" action="/projetweb/elements/search.php">

            <input type="text" name="search" placeholder="Search">
            <button type="submit" >Search</button>
        </form>
        <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
                <label class="radio">
                    <input type="radio" name="menu-item" value="Chaud">
                    <span>Chaud</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="Froid">
                    <span>Froid</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="Salé">
                    <span>Salé </span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="Sucré ">
                    <span>Sucré </span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="entrée">
                    <span>Entrée </span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="Dessert">
                    <span>Dessert</span>
                </label>
            </div>
        </div>
    </div>
    <?php if($logged):?>
        <div class="dropdown1">
            <button class="login-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo htmlspecialchars($_SESSION['nickname']) ; ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" id="dropdownitem" href="/projetweb/elements/AjouterRecette.php">Ajouter</a>
                <a class="dropdown-item" id="dropdownitem" href="/projetweb/elements/logout.php">Logout</a>
            </div>
        </div>
    <?php else: ?>
    <a class="login-btn"  role="button" href="/projetweb/elements/login.php">Login</a>
    <?php endif; ?>



</header>
