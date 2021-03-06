<?php
// the class course defines the structure of what every course object will look like. ie. each course will have an id, name_course, code_course etc...
// NOTE : For handiness I have the very same spelling as the database attributes
class Course {
  public $id;
  public $name_course;
  public $code_course;
  public $cao_points;
  public $start_date;
  public $image_id;



  public function __construct() {
    $this->id = null;
  }

  public function save() {
    throw new Exception("Not yet implemented");
  }

  public function delete() {
    throw new Exception("Not yet implemented");
  }

  public static function findAll() {
    $courses = array();

    try {
      // call DB() in DB.php to create a new database object - $db
      $db = new DB();
      $db->open();
      // $conn has a connection to the database
      $conn = $db->get_connection();
      

      // $select_sql is a variable containing the correct SQL that we want to pass to the database
      $select_sql = "SELECT * FROM courses";
      $select_stmt = $conn->prepare($select_sql);
      // $the SQL is sent to the database to be executed, and true or false is returned 
      $select_status = $select_stmt->execute();

      // if there's an error display something sensible to the screen. 
      if (!$select_status) {
        $error_info = $select_stmt->errorInfo();
        $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
        throw new Exception("Database error executing database query: " . $message);
      }
      // if we get here the select worked correctly, so now time to process the courses that were retrieved
      

      if ($select_stmt->rowCount() !== 0) {
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        while ($row !== FALSE) {
          // Create $course object, then put the id, name_course, code_course, cao_points etc into $course
          $course = new Course();
          $course->id = $row['id'];
          $course->name_course = $row['name_course'];
          $course->code_course = $row['code_course'];
          $course->cao_points = $row['cao_points'];
          $course->start_date = $row['start_date'];
          $course->image_id = $row['image_id'];

          // $course now has all it's attributes assigned, so put it into the array $courses[] 
          $courses[] = $course;
          
          // get the next course from the list and return to the top of the loop
          $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        }
      }
    }
    finally {
      if ($db !== null && $db->is_open()) {
        $db->close();
      }
    }

    // return the array of $courses to the calling code - index.php (about line 6)
    return $courses;
  }

  public static function findById($id) {
    throw new Exception("Not yet implemented");
  }
}
?>
