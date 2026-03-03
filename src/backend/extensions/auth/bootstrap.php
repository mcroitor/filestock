<?php

use Mc\Router;

Router::post('/auth/register', function (): string {
	return Router::json([
		'endpoint' => '/auth/register',
		'status' => 'not_implemented',
		'message' => 'Register endpoint created and waiting for business logic implementation'
	], 501);
});

Router::post('/auth/login', function (): string {
	return Router::json([
		'endpoint' => '/auth/login',
		'status' => 'not_implemented',
		'message' => 'Login endpoint created and waiting for business logic implementation'
	], 501);
});

Router::post('/auth/logout', function (): string {
	return Router::json([
		'endpoint' => '/auth/logout',
		'status' => 'not_implemented',
		'message' => 'Logout endpoint created and waiting for business logic implementation'
	], 501);
});

Router::post('/auth/reset', function (): string {
	return Router::json([
		'endpoint' => '/auth/reset',
		'status' => 'not_implemented',
		'message' => 'Reset endpoint created and waiting for business logic implementation'
	], 501);
});
