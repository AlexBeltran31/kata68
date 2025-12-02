<?php
include 'menu.php';

$menu = new Menu();
while (true) {
    $menu->showOptions();
    $option = intval(trim(fgets(STDIN)));
    $menu->doAction($option);
}