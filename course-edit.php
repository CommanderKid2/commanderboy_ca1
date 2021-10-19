<?php require_once 'config.php';

// i never changed 'course' to 'course

try {
  $rules = [
    'course_id' => 'present|integer|min:1'
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }
  $course_id = $request->input('course_id');
  /*Retrieving a customer object*/
  $course = course::findById($course_id);
  if ($course === null) {
    throw new Exception("Illegal request parameter");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  // it's getting an error but sending me to a page that doesn't exist
  // at least it's not breaking
  $request->redirect("/course-index.php");
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit course</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/form.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">


</head>

<body>
  <div class="container-fluid p-0">
    <?php require 'include/navbar.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1 class="t-peta engie-head pt-5 pb-5">Edit course</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form method="post" action="<?= APP_URL ?>/course-update.php" enctype="multipart/form-data">

              <!--This is how we pass the ID-->
              <input type="hidden" name="course_id" value="<?= $course->id ?>" />

              <!-- so the user can't intereact. This form is for viewing only.-->
              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Title</label>
                <input name="name_course" placeholder="Title" type="text" id="title" class="form-control" value="<?= $course->name_course ?>"  />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Code course</label>
                <input name="code_course" placeholder="Title" type="text" id="title" class="form-control" value="<?= $course->code_course ?>"  />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">CAO points</label>
                <input name="cao_points" placeholder="Title" type="text" id="title" class="form-control" value="<?= $course->cao_points ?>"  />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueCapacity">Start Date</label>
                <input name="start_date" placeholder="Start Date" type="date" class="form-control" id="startDate" value="<?= $course->start_date ?>"  />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="location">Location</label>
                <select class="form-control" name="location" id="location" >
                  <!-- triple === means if it is equal. So is location is equal to "USA" display USA, if location is equal to "Belgium" display ...you get the idea..-->
                  <option value="USA" <?= (($course->location === "USA") ? "selected" : "") ?>>USA</option>
                  <option value="Belgium" <?= (($course->location === "Belgium") ? "selected" : "") ?>>Belgium</option>>
                  <option value="Brazil" <?= (($course->location === "Brazil") ? "selected" : "") ?>>Brazil</option>
                  <option value="UK" <?= (($course->location === "UK") ? "selected" : "") ?>>UK</option>
                  <option value="Germany" <?= (($course->location === "Germany") ? "selected" : "") ?>>Germany</option>
                  <option value="Japan" <?= (($course->location === "Japan") ? "selected" : "") ?>>Japan</option>
                  <option value="Netherlands" <?= (($course->location === "Netherlands") ? "selected" : "") ?>>Netherlands</option>
                  <option value="Hungary" <?= (($course->location === "Hungary") ? "selected" : "") ?>>Hungary</option>
                  <option value="Morocco" <?= (($course->location === "Morocco") ? "selected" : "") ?>>Morocco</option>
                  <option value="Spain" <?= (($course->location === "Spain") ? "selected" : "") ?>>Spain</option>
                  <option value="Canada" <?= (($course->location === "Canada") ? "selected" : "") ?>>Canada</option>
                  <option value="Croatia" <?= (($course->location === "Croatia") ? "selected" : "") ?>>Croatia</option>
                  <option value="Philippines" <?= (($course->location === "Philippines") ? "selected" : "") ?>>Philippines</option>
                </select>
              </div>

              


              <div class="form-group">
                <label class="labelHidden" for="venueDescription">Image</label>
                <?php
                try {
                  $image = Image::findById($course->image_id);
                } catch (Exception $e) {
                }
                if ($image !== null) {
                ?>
                  <img src="<?= APP_URL . "/" . $image->file_name ?>" width="205px" alt="image" class="mt-2 mb-2" />
                <?php
                }
                ?>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/course-view.php">Cancel</a>
                <button type="submit" class="btn btn-primary">Store</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/course.js"></script>

  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</body>

</html>