<?php

use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

$router->get("/", [\App\Controllers\CourseController::class, "getCourse"]);
$router->get("list-course", [\App\Controllers\CourseController::class, "getCourse"]);
$router->get("delete-course/{id}", [\App\Controllers\CourseController::class, "deleteCourse"]);
$router->get("add-course", [\App\Controllers\CourseController::class, "addCourseView"]);
$router->post("post-course", [\App\Controllers\CourseController::class, "addCourse"]);
$router->get("course-detail/{id}", [\App\Controllers\CourseController::class, "courseDetail"]);
$router->post("update-course/{id}", [\App\Controllers\CourseController::class, "updateCourse"]);

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

echo $response;
