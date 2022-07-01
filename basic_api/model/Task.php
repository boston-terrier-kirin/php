<?php
class TaskException extends Exception {}

class Task {
    private $id;
    private $title;
    private $description;
    private $deadline;
    private $completed;

    public function __construct($id, $title, $description, $deadline, $completed) {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setDeadline($completed);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDeadline() {
        return $this->deadline;
    }

    public function setDeadline($deadline) {
        $this->deadline = $deadline;
    }

    public function getCompleted() {
        return $this->completed;
    }

    public function setCompleted($completed) {
        $this->completed = $completed;
    }

    public function returnTaskAsArray() {
        $task = [];
        $task["id"] = $this->getId();
        $task["title"] = $this->getTitle();
        $task["description"] = $this->getDescription();
        $task["deadline"] = $this->getDeadline();
        $task["completed"] = $this->getCompleted();

        return $task;
    }
}
?>