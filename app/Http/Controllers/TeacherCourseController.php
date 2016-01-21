<?php namespace App\Http\Controllers;

    use App\Teacher;
    use App\Course;
    use Illuminate\Http\Request;
    class TeacherCourseController extends Controller
    {
        public function index($teacher_id){
            $teacher = Teacher::find($teacher_id);

            if($teacher){
                $courses = $teacher->courses;
                return $this->createSucessResponse($courses,200);
            }
            return $this->createErrorResponse("Teacher does not exist with the id $teacher_id", 404);
        }
        public function store(Request $request, $teacher_id){
          $teacher = Teacher::find($teacher_id);
          if($teacher){
            $this->validateRequest($request);

            $course = Course::create(
              [
                'title'       => $request->get('title'),
                'description' => $request->get('description'),
                'value'       => $request->get('value'),
                'teacher_id'  => $teacher->id
              ]
            );
          return $this->createSucessResponse('The course with the course id {$course->id} has been created and associated with the teacher with the id{$teacher->id}',201);
          }
          return $this->createErrorResponse('Teacher with id {$teacher_id} does not exist',404);

        }
        public function update(Request $request,$teacher_id,$course_id)
        {
          $teacher = Teacher::find($teacher_id);
          if($teacher){
            $course = Course::find($course_id);
            if($course){
              $this->validateRequest($request);
              $course->title = $request->get('title');
              $course->description = $request->get('description');
              $course->value = $request->get('value');
              $course->teacher_id = $teacher->id;

              $course->save();
              return $this->createSucessResponse('The course with the id {$course->id} has been updated',200);
            }
          }
          return $this->createErrorResponse('Teacher with the id {$teacher_id} does not exist',404);
        }
        public function destroy($teacher_id, $course_id) {
          $teacher = Teacher::find($teacher_id);
          if($teacher){
            $course = Course::find($course_id);
            if($course){
              if($teacher->courses()->find($course_id)){
                $course->students()->detach();
                $course->delete();
                return $this->createSucessResponse('The course with the id {$course->id} was removed',200);
              }
              return $this->createErrorResponse('The teacher with the id {$teacher_id} is not associated with the course with the id {$course_id}',404);
            }
          }
          return $this->createErrorResponse('Teacher with the id {$teacher_id} does not exist',404);
        }
        function validateRequest($request) {
          $rules =  [
            'title'       => 'required',
            'description' => 'required',
            'value'       => 'required|numeric'
        	];
          $this->validate($request);
        }


    }


?>
