<?php
class Post
{
  public $id;
  public $title;
  public $description;
  // public $image;
  // public $status;
  // public $create_at;
  // public $update_at;

  function __construct($id, $title, $description)
      // , $image, $static, $create_at, $update_at)
  {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    // $this->image = $image;
    // $this->status = $status;
    // $this->create_at = $create_at;
    // $this->update_at = $update_at;
  }

  static function all()
  {
    $list = [];
    $db = DB::getInstance();
    $req = $db->query('SELECT * FROM posts');

    foreach ($req->fetchAll() as $item) {
        $list[] = new Post($item['id'], $item['title'], $item['description']);
           // , $item['image'], $item['status'], $item['create_at'], $item['update_at']);
    }

    return $list;
  }

   static function find($id)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $req->execute(array('id' => $id));

    $item = $req->fetch();
    if (isset($item['id'])) {
      return new Post($item['id'], $item['title'], $item['description']);
    }
    return null;
  }
}
