<?php

/* 
 * That's the file of the routes  
 */

// Main routes

$app->get('/', 'HomeController:index')->setName('index-page');
$app->post('/signin', 'HomeController:signIn');
$app->get('/user', 'HomeController:logged');
$app->get('/logout', 'HomeController:logout');

$app->get('/push', 'HomeController:push');

$app->post('/update', 'EventController:updateEvent');
$app->post('/delete', 'EventController:deleteEvent');
$app->post('/create', 'EventController:createEvent');