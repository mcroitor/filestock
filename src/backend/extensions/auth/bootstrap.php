<?php

use Mc\Router;
use Mc\User;

Router::post('/auth/register', function (): string {
	$body = Router::getBody();

	try {
		$email = (string) ($body['email'] ?? '');
		$password = (string) ($body['password'] ?? '');
		$username = isset($body['username']) ? (string) $body['username'] : null;

		$user = User::register($email, $password, $username);
		return Router::json($user, 201);
	} catch (\InvalidArgumentException $exception) {
		return Router::json([
			'error' => [
				'code' => 'bad_request',
				'message' => 'Invalid or incomplete payload',
				'status' => 400
			]
		], 400);
	} catch (\DomainException $exception) {
		return Router::json([
			'error' => [
				'code' => 'conflict',
				'message' => 'User already exists',
				'status' => 409
			]
		], 409);
	} catch (\Throwable $exception) {
		error_log('Register error: ' . $exception->getMessage());
		return Router::json([
			'error' => [
				'code' => 'internal_error',
				'message' => 'Internal Server Error',
				'status' => 500
			]
		], 500);
	}
});

Router::post('/auth/login', function (): string {
	$body = Router::getBody();

	try {
		$email = (string) ($body['email'] ?? '');
		$password = (string) ($body['password'] ?? '');

		$user = User::login($email, $password);
		return Router::json($user, 200);
	} catch (\InvalidArgumentException $exception) {
		return Router::json([
			'error' => [
				'code' => 'bad_request',
				'message' => 'Invalid or incomplete payload',
				'status' => 400
			]
		], 400);
	} catch (\UnexpectedValueException $exception) {
		return Router::json([
			'error' => [
				'code' => 'unauthorized',
				'message' => 'Invalid credentials',
				'status' => 401
			]
		], 401);
	} catch (\Throwable $exception) {
		error_log('Login error: ' . $exception->getMessage());
		return Router::json([
			'error' => [
				'code' => 'internal_error',
				'message' => 'Internal Server Error',
				'status' => 500
			]
		], 500);
	}
});

Router::post('/auth/logout', function (): string {
	try {
		User::logout();
		return Router::json([
			'status' => 'ok'
		], 200);
	} catch (\Throwable $exception) {
		error_log('Logout error: ' . $exception->getMessage());
		return Router::json([
			'error' => [
				'code' => 'internal_error',
				'message' => 'Internal Server Error',
				'status' => 500
			]
		], 500);
	}
});

Router::post('/auth/reset', function (): string {
	return Router::json([
		'endpoint' => '/auth/reset',
		'status' => 'not_implemented',
		'message' => 'Reset endpoint created and waiting for business logic implementation'
	], 501);
});
