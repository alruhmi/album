<?php

$router->get('', 'PicturesController@index');
$router->get('add', 'PicturesController@showAddForm');

$router->post('show-more', 'PicturesController@showMore');
$router->post('add', 'PicturesController@store');