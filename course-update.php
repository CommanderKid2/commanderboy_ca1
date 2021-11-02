<?php
require_once 'config.php';

try {
    // $request = new HttpRequest();

    // $locations = [
    //     "USA",  "Belgium", "Brazil", "UK",
    //     "Hungary", "Morocco", "Spain",
    //     "Germany", "Japan", "Netherlands",
    //     "Canada", "Croatia", "Philippines"
    // ];

    $rules = [
        "course_id" => "present|integer|min:1",
        "name_course" => "present|minlength:2|maxlength:64",   
        "code_course" => "present|minlength:2|maxlength:64",   
        "cao_points" => "present|minlength:2|maxlength:64", 
        "start_date" => "present|minlength:10|maxlength:10",        
    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        // commented out because we don't have the 'fileupload' class yet
        // $image = null;
        // if (FileUpload::exists('profile')) {
        //     //If a file was uploded for profile,
        //     //create a FileUpload object
        //     $file = new FileUpload("profile");
        //     $filename = $file->get();
        //     //Create a new image object and save it.
        //     $image = new Image();
        //     $image->filename = $filename;

        //     // you must implement save() function in the Image.php class
        //     $image->save();
        // }
                
        $course = Course::findById($request->input("course_id"));
        $course->name_course = $request->input("name_course");
        $course->code_course = $request->input("code_course");
        $course->cao_points = $request->input("cao_points");
        $course->start_date = $request->input("start_date");        
        /*If not null, the user must have uploaded an image, so reset the image id to that of the one we've just uploaded.*/
        if ($image !== null) {
            $festival->image_id = $image->id;
        }

        // you must implement the save() function in the Festival class
        $course->save();

        $request->session()->set("flash_message", "The course was successfully updated in the database");
        $request->session()->set("flash_message_class", "alert-info");
        /*Forget any data that's already been stored in the session.*/
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");

        $request->redirect("/course-index.php");
    } else {
        $course_id = $request->input("course_id");
        /*Get all session data from the form and store under the key 'flash_data'.*/
        $request->session()->set("flash_data", $request->all());
        /*Do the same for errors.*/
        $request->session()->set("flash_errors", $request->errors());

        $request->redirect("/course-edit.php?course_id=" . $course_id);
    }    
} catch (Exception $ex) {
    //redirect to the create page...
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    // not yet implemented
    // breaking but redirecting to wrong page

    $request->redirect("/course-index.php");
}