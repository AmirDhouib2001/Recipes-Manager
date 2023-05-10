<?php $logged=isset($_SESSION['nickname']) ?>

<header class="header1">
    <div class="logo-container">
        <img src="/images/Zwita2.png" alt="Logo">
    </div>
    <div class="search-dropdown-container">
        <form class="search-form" method="post">

            <input type="text" placeholder="Search">
            <button type="submit" name="search">Search</button>
        </form>
        <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
                <label class="radio">
                    <input type="radio" name="menu-item" value="item1">
                    <span>Item 1</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="item2">
                    <span>Item 2</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="item3">
                    <span>Item 3</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="item4">
                    <span>Item 4</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="item5">
                    <span>Item 5</span>
                </label>
                <label class="radio">
                    <input type="radio" name="menu-item" value="item6">
                    <span>Item 6</span>
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
    <a class="login-btn"  role="button" href="elements/login.php">Login</a>
    <?php endif; ?>





</header>
