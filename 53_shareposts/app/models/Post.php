<?php
class Post {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getPosts() {
        $this->db->query("
            select a.id as postId, a.title, a.body, b.name, a.created_at
              from posts a
                     inner join users b
                             on a.user_id = b.id
             order by a.created_at desc
        ");

        $results = $this->db->resultSet();

        return $results;
    }

    public function addPost($data) {
        $this->db->query("
            insert into posts(user_id, title, body)
            values(:user_id, :title, :body)
        ");

        $this->db->bind(":user_id", $data["user_id"]);
        $this->db->bind(":title", $data["title"]);
        $this->db->bind(":body", $data["body"]);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function editPost($data) {
        $this->db->query("
            update posts
               set title = :title,
                   body = :body
             where id = :id
        ");

        $this->db->bind(":title", $data["title"]);
        $this->db->bind(":body", $data["body"]);
        $this->db->bind(":id", $data["id"]);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function deletePost($data) {
        $this->db->query("
            delete
              from posts
             where id = :id
        ");

        $this->db->bind(":id", $data["id"]);

        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function getPostById($id) {
        $this->db->query("
            select a.id as postId, a.user_id, a.title, a.body, b.name, a.created_at
              from posts a
                     inner join users b
                             on a.user_id = b.id
             where a.id = :id
        ");

        $this->db->bind(":id", $id);
        $result = $this->db->single();

        return $result;        
    }
}