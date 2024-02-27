<?php

namespace App\Models;

class Course extends BaseModel
{
    private $table = "course";

    public function getListCourse()
    {
        $sql = "select * from $this->table";
        $this->setQuery($sql);
        return $this->loadAllRows();
    }

    public function deleteCourse($id)
    {
        $sql = "delete from $this->table where id = ?";
        $this->setQuery($sql);
        $this->execute([$id]);
    }

    public function addCourse($course_name, $image, $price, $teacher_name, $description)
    {
        $sql = "insert into $this->table (course_name, image, price, teacher_name, description) values (?, ?, ?, ? ,?)";
        $this->setQuery($sql);
        $this->execute([$course_name, $image, $price, $teacher_name, $description]);
    }

    public function courseDetail($id)
    {
        $sql = "select * from $this->table where id = ?";
        $this->setQuery($sql);
        return $this->loadRow([$id]);
    }

    public function updateCourse($id, $course_name, $image, $price, $teacher_name, $description)
    {
        if (!empty($image)) {
            $sql = "update $this->table set course_name = ?, image = ?, price = ?, teacher_name = ?, description = ? where id = ?";
            $this->setQuery($sql);
            $this->execute([$course_name, $image, $price, $teacher_name, $description, $id]);
        } else {
            $sql = "update $this->table set course_name = ?, price = ?, teacher_name = ?, description = ? where id = ?";
            $this->setQuery($sql);
            $this->execute([$course_name, $price, $teacher_name, $description, $id]);
        }
    }
}
