<?php

/* 
 * That's the file of the routes  
 */

// Main routes

$app->get('/', 'HomeController:index')->setName('index-page');
$app->post('/signin', 'HomeController:signIn');
$app->get('/user', 'HomeController:logged');

$app->post('/update', 'EventCrontroller:updateEvent');
$app->post('/delete', 'EventCrontroller:deleteEvent');
$app->post('/create', 'EventCrontroller:createEvent');