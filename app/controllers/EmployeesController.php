<?php

class EmployeesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		// Show a listing of employees.
		$employeesAll = Employee::all();
		//print_r($employeesAll);
		$employees = Employee::orderBy('id', 'DESC')->paginate(10);
		$viewCount =count($employees);
		$countAll = count($employeesAll);
		return View::make('employee.index', compact('employees', 'viewCount', 'countAll'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('employee.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// get the POST data
		$data = Input::all();

print_r($data);exit;

		$image = $data['photo'];
		print_r($data);exit;
		// create a new model instance
		$employee = new Employee();



		// attempt validation
		if ($employee->validate($data))
		{
			// success code
			$employee->first_name = Input::get('first_name');
			$employee->last_name = Input::get('last_name');
			$employee->email = Input::get('email');



			if($image) {
				// Images destination
				$img_dir = "images/employees/" . date("h-m-y");
				$img_thumb_dir = $img_dir . "/thumbs";
				// Create folders if they don't exist
				if (!file_exists($img_dir)) {
					mkdir($img_dir, 0777, true);
					mkdir($img_thumb_dir, 0777, true);
				}
				$filename = $image->getClientOriginalName();
				$pathL = public_path($img_dir . "-" . $filename);
				$pathS = public_path($img_thumb_dir . "-" . $filename);
				Image::make($image->getRealPath())->resize(900, 600)->save($pathL);
				Image::make($image->getRealPath())->resize(60, 60)->save($pathS);
				$employee->photo = "images/employees/" . date("h-m-y")."-".$filename;
			}
			$employee->save();
			// redirect
			Session::flash('message', 'Successfully Added!');
			return Redirect::to('employee');
		}else{
			// failure, get errors
			$errors = $employee->errors();
			Session::flash('errors', $errors);
			//return Redirect::to('employee/create')->withInput()->withErrors($errors);
			return Redirect::to('employee/create');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}





	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$employee = Employee::find($id);
		$employee->delete();
		// redirect
		Session::flash('message', 'Successfully deleted!');
		return Redirect::back();
	}


	public function gallery()
	{
		$employees = DB::table('employees')->paginate(3);;
		//$list = File::allFiles('images/gallery');
		return View::make('employee.gallery', compact('employees'));
	}


	public function massDelete()
	{
		Employee::destroy(Request::get('id'));
		//exit;
		Session::flash('message', 'You have successfully deleted ');
		return Redirect::back();
	}

	public function upload()
	{
		$image = Input::file('photo');
		$filename  = date('mY') . '.' . $image->getClientOriginalExtension();
		$path = public_path('images/employees/' . $filename);
		Image::make($image->getRealPath())->resize(468, 249)->save($path);
		//$product->image = 'img/products/'.$filename;
		//$product->save();
		echo $filename;
		exit;
	}



}
