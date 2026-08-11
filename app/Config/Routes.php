<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'DashboardController::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login', ['filter' => 'guest']);
$routes->post('login', 'AuthController::attempt', ['filter' => 'guest']);
$routes->get('register', 'AuthController::register', ['filter' => 'guest']);
$routes->post('register', 'AuthController::storeRegistration', ['filter' => 'guest']);
$routes->post('logout', 'AuthController::logout', ['filter' => 'auth']);
$routes->get('akun', 'AccountController::edit', ['filter' => 'auth']);
$routes->post('akun', 'AccountController::update', ['filter' => 'auth']);

$routes->group('admin', ['filter' => ['auth', 'role:super_admin']], static function ($routes) {
    $routes->get('/', 'DashboardController::superAdmin');
    $routes->get('admin-jurnal', 'Admin\\UserController::index');
    $routes->post('admin-jurnal/(:num)/status', 'Admin\\UserController::toggleStatus/$1');
});

$routes->group('jurnal', ['filter' => ['auth', 'role:admin_jurnal']], static function ($routes) {
    $routes->get('/', 'DashboardController::journalAdmin');
    $routes->get('dokumentasi', 'DocumentationController::index');
    $routes->get('data', 'JournalManagementController::index');
    $routes->get('data/tambah', 'JournalManagementController::create');
    $routes->post('data', 'JournalManagementController::store');
    $routes->get('data/(:num)/ubah', 'JournalManagementController::edit/$1');
    $routes->post('data/(:num)', 'JournalManagementController::update/$1');
    $routes->post('data/(:num)/hapus', 'JournalManagementController::delete/$1');
    $routes->get('(:num)/kriteria', 'EvaluationController::start/$1', ['filter' => 'journal_access']);
    $routes->get('(:num)', 'JournalController::show/$1', ['filter' => 'journal_access']);
    $routes->post('(:num)/evaluasi', 'EvaluationController::create/$1', ['filter' => 'journal_access']);
    $routes->get('evaluasi/(:num)', 'EvaluationController::show/$1', ['filter' => 'journal_access:evaluation']);
    $routes->post('evaluasi/(:num)', 'EvaluationController::save/$1', ['filter' => 'journal_access:evaluation']);
    $routes->get('evaluasi/(:num)/rubrik', 'RubricController::show/$1', ['filter' => 'journal_access:evaluation']);
    $routes->post('evaluasi/(:num)/rubrik', 'RubricController::save/$1', ['filter' => 'journal_access:evaluation']);
    $routes->post('evaluasi/(:num)/disinsentif', 'RubricController::addDisincentive/$1', ['filter' => 'journal_access:evaluation']);
});
