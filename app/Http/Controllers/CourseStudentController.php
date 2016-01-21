<?php namespace App\Http\Controllers;

    use App\Course;

    class CourseStudentController extends Controller
    {
      public function index($course_id){
          $course = Course::find($course_id);

          if($course){
              $students = $course->students;
              return $this->createSucessResponse($students,200);
          }
          return $this->createErrorResponse("Course does not exist with the id $course_id", 404);
      }
      public function store($course_id, $student_id){
        $course = Course::find($course_id);
        if($course){
          $student = Student::find($student_id);
          if($student){
            if($course->students()->find($student->id)){
              $this->createErrorResponse('Student already in course',409);
            }
            $course->$student->attach($student->id);
            return $this->createSucessResponse('The student with the id{$student->id} has been added to the course',201);
          }
          return $this->createErrorResponse('Unable to find student resourse',404);
        }
        return $this->createErrorResponse('Unable to find course resourse',404);
      }
      public function destroy($course_id, $student_id){
        $course = Course::find($course_id);
        if($course){
          $student = Student::find($student_id);
          if($student){
            if(!$course->students()->find($student->id)){
              $this->createErrorResponse('Student with the id {$student->id} is not in the course',404);
            }
            $course->$student->detach($student->id);
            return $this->createSucessResponse('The student with the id{$student->id} has been added to the course',200);
          }
          return $this->createErrorResponse('Unable to find student resourse',404);
        }
        return $this->createErrorResponse('Unable to find course resourse',404);
      }
    }


?>
