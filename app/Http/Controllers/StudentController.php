<?php namespace App\Http\Controllers;

    use App\Student;

    use Illuminate\Http\Request;

    class StudentController extends Controller
    {
        public function index() {
            $students = Student::all();
            return $this->createSucessResponse($students, 200);
        }
        public function show($id) {

        $student = Student::find($id);
        if($student){
          return $this->createSucessResponse($student, 200);
        }
          return $this->createErrorResponse("The student with id {$id} does not exist", 404);
        }
        public function store(Request $request) {
          $this->validateRequest($request);
          $student = Student::create($request->all());
          return $this->createSucessResponse("The student with id {$student->id} has been created",201);
        }
        public function update(Request $request, $student_id) {
            $student = Student::find($student_id);
            if($student){
              $this->validateRequest($request);

              $student->name = $request -> get('name');
              $student->phone = $request -> get('phone');
              $student->address = $request -> get('address');
              $student->career = $request -> get('career');

              $student->save();
              return $this->createSucessResponse("The student with id {$student->id} has been updated",200);
            }
        }
        public function destroy($student_id)
        {
          $student = Student::find($student_id);
          if($student){
            $student->courses()->detach();
            $student->delete();
            return $this->createSucessResponse("The student with id {$student->id} has been removed",200);
          }
          return $this->createErrorResponse("The student with id {$student_id} does not exist", 404);
        }
        function validateRequest($request) {
          $rules = Student::$rules;
          $this->validate($request, $rules);
        }
    }
?>
