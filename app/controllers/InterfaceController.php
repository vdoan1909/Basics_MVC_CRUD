<?php   
namespace App\Controllers;

interface InterfaceController{
    public function getCourse();
    public function deleteCourse($id);
    public function addCourseView();
    public function addCourse();
    public function courseDetail($id);
    public function updateCourse($id);
}