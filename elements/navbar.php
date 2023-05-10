<?php $logged=isset($_SESSION['nickname']) ?>
<div class="menu-bar">
    <div class="menu-bar1"></div>
    <div class="menu-bar2"></div>
    <div class="menu-bar3"></div>
</div>
<h3 class="logo">
    <span class="ok">Zwita Food</span>
</h3>
<div class="cart">
    <i class="fa fa-shopping-cart"></i>
</div>
<nav>
    <ul class="nav-links">
        <li><a href="#footer" class="first-menu">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="/projetweb/elements/menu.php">Cuisine</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
    <?php if($logged):?>
        <a role="button" class="cart-btn" href="/projetweb/elements/AjouterRecette.php">Ajouter</a>
    <?php else: ?>
    <div></div>
    <?php endif; ?>
</nav>
