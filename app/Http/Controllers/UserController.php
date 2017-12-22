<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
	protected $userRepo;

	public function __construct(UserRepository $userRepo)
	{
		$this->userRepo = $userRepo;
	}


	public function index()
	{
		return $this->userRepo->getAll();
	}


	public function store(Request $request)
	{

        $validator = \Validator::make($request->all(), [
            'name' => 'max:30',
            'email' => 'max:50|email',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Validation Failed',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

		$user = $this->userRepo->create($request->all());
        return response()->json($user, 201);
	}

	public function update(Request $request, $id)
	{
		try {
			$user = $this->userRepo->update($request->all(), $id);
	        return response()->json($user, 200);
		} catch(\Exception $e) {
			return response()->json([
                'message'   => 'Record not found',
            ], 404); 
		}
	}

	public function delete($id)
	{
		$user = $this->userRepo->delete($id);
        return response()->json(null, 204);
	}

	public function find($id)
	{
		$user = $this->userRepo->find($id);

		if(!$user) {
			return response()->json([
                'message'   => 'Record not found',
            ], 404);
		}

		return response()->json($user, 201);
	}
}
