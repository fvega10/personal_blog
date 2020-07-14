<?php 
    if(isset($_SESSION['login']))
    {
?>

      <ul id="slide-out" class="sidenav">
        <li><div class="user-view">
          <div class="background">
            <img src="/assets/media/office.jpg">
          </div>
          <a href="#user"><img class="circle" src="/assets/media/avatar-img.png"></a>
          <a href="#name"><span class="white-text name">Fabricio Vega Ugalde</span></a>
          <a href="#email"><span class="white-text email">fabriciovu@gmail.com</span></a>
        </div></li>
        <li><a href="/posts/index.php"><i class="material-icons">card_travel</i>Articulos</a></li>
        <li><a href="/categories/index.php"><i class="material-icons">filter_none</i> Categories</a></li>
        <li><a href="/applications/index.php"><i class="material-icons">desktop_mac</i> Aplicaciones</a></li>
        <li><a href="/contact/index.php"><i class="material-icons">email</i> Mensajes recibidos</a></li>
        <li><div class="divider"></div></li>
        <li>
          <a class="red-text text-darken-1" href="/authenticate/index.php?action=logout">
            <i class="material-icons red-text text-darken-1">power_settings_new</i>
            Logout
          </a>
        </li>
      </ul>
      <a href="#" data-target="slide-out" class="menu sidenav-trigger waves-effect waves-light btn"><i class="material-icons">menu</i></a>
<?php
    }
?>