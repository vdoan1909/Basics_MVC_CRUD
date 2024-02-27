<?php

namespace App\Controllers;

use App\Models\Course;

class CourseController extends BaseController
{
    private $course;

    public function __construct()
    {
        $this->course = new Course();
    }

    public function getCourse()
    {
        $courses = $this->course->getListCourse();
        $this->render('course.index', compact('courses'));
    }

    public function deleteCourse($id)
    {
        $this->course->deleteCourse($id);
        redirect("success", "Xoa thanh cong", "list-course");
    }

    public function addCourseView()
    {
        $this->render("course.add");
    }

    public function addCourse()
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $course_name = $_POST["course_name"];
            $image = $_FILES["image"];
            $price = $_POST["price"];
            $teacher_name = $_POST["teacher_name"];
            $description = $_POST["description"];

            $pngJpg = ['png', 'jpg'];
            $checkImage = pathinfo($image["name"], PATHINFO_EXTENSION);

            if (empty($course_name)) {
                $errors[] = "Ten khoa hoc dang trong";
            }

            if (empty($image["name"])) {
                $errors[] = "Anh dang trong";
            } else {
                // png PNG
                if (!in_array(strtolower($checkImage), $pngJpg)) {
                    $errors[] = "Anh phai dung dinh dang png, jpg";
                }
            }

            if (empty($price)) {
                $errors[] = "Gia khoa hoc dang trong";
            } else {
                if (!is_numeric($price)) {
                    $errors[] = "Gia khoa hoc phai la 1 so";
                } else {
                    if ($price < 0) {
                        $errors[] = "Gia khoa hoc phai la 1 so > 0";
                    }
                }
            }

            if (empty($teacher_name)) {
                $errors[] = "Ten giang vien dang trong";
            }

            if (empty($description)) {
                $errors[] = "Mo ta khoa hoc dang trong";
            } else {
                if (strlen($description) < 10) {
                    $errors[] = "Mo ta khoa hoc phai lon hon 10 ky tu";
                }
            }

            if (count($errors) > 0) {
                redirect("errors", $errors, "add-course");
            } else {
                move_uploaded_file($image["tmp_name"], "images/" . $image["name"]);
                $this->course->addCourse($course_name, $image["name"], $price, $teacher_name, $description);
                redirect("success", "Them thanh cong", "add-course");
            }
        }
    }

    public function courseDetail($id)
    {
        $courseDetail = $this->course->courseDetail($id);
        $this->render("course.update", compact("courseDetail"));
    }

    public function updateCourse($id)
    {
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $course_name = $_POST["course_name"];
            $image = $_FILES["image"];
            $price = $_POST["price"];
            $teacher_name = $_POST["teacher_name"];
            $description = $_POST["description"];

            $pngJpg = ['png', 'jpg'];
            $checkImage = pathinfo($image["name"], PATHINFO_EXTENSION);

            if (empty($course_name)) {
                $errors[] = "Ten khoa hoc dang trong";
            }

            if (!empty($image["name"])) {
                if (!in_array(strtolower($checkImage), $pngJpg)) {
                    $errors[] = "Anh phai dung dinh dang png, jpg";
                } else {
                    $name_img = $image["name"];
                    $base_name = basename($name_img);
                    $update_img = "images/" . $base_name;
                    move_uploaded_file($image["tmp_name"], $update_img);
                }
            } else {
                $base_name = "";
                $update_img = "";
            }


            if (empty($price)) {
                $errors[] = "Gia khoa hoc dang trong";
            } else {
                if (!is_numeric($price)) {
                    $errors[] = "Gia khoa hoc phai la 1 so";
                } else {
                    if ($price < 0) {
                        $errors[] = "Gia khoa hoc phai la 1 so > 0";
                    }
                }
            }

            if (empty($teacher_name)) {
                $errors[] = "Ten giang vien dang trong";
            }

            if (empty($description)) {
                $errors[] = "Mo ta khoa hoc dang trong";
            } else {
                if (strlen($description) < 10) {
                    $errors[] = "Mo ta khoa hoc phai lon hon 10 ky tu";
                }
            }

            if (count($errors) > 0) {
                redirect("errors", $errors, "course-detail/{$id}");
            } else {
                $this->course->updateCourse($id, $course_name, $base_name, $price, $teacher_name, $description);
                redirect("success", "Sua thanh cong", "list-course");
            }
        }
    }
}
