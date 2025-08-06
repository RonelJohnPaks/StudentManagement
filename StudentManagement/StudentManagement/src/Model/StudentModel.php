<?php

namespace Benatero\StudentManagement\Model;
use Benatero\StudentManagement\Core\Crud;

class StudentModel implements Crud {
    
    public $id;
    public $fullname;
    public $yearlevel;
    public $course;
    public $section;

    public function __construct()
    {
        $this->id = "";
        $this->fullname = "";
        $this->yearlevel = "";
        $this->course = "";
        $this->section =  "";
    }

    public function displayInfo(){
        echo "ID : ".$this->id."\n";
        echo "Name : ".$this->fullname."\n";
        echo "Year Level : ".$this->yearlevel."\n";
        echo "Course : ".$this->course."\n";
        echo "Section : ".$this->section."\n";
    }

    public function create($fullname, $yearlevel, $course, $section){
        try{
            $sql = "INSERT INTO students (fullname, yearlevel, course, section) VALUES (?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $fullname, $yearlevel, $course, $section);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function read(){
        try{
            $sql = "SELECT * FROM students";
            $result  = $this->conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }
    public function update(){
        try {
            $sql = "UPDATE students SET fullname = ?, yearlevel = ?, course = ?, section = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssss", $fullname, $yearlevel, $course, $section, $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function delete(){
        try {
            $sql = "DELETE FROM students WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}