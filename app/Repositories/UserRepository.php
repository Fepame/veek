<?php 

namespace App\Repositories;

use App\User;

class UserRepository
{
	
	protected $user;

	function __construct(User $user)
	{
		$this->user = $user;
	}

	public function getAll()
	{
		return $this->user->all();
	}

	public function create($data)
	{
		return $this->user->create($data);
	}

	public function update($request, $id)
	{
		$updatedUser = $this->user->findOrFail($id);
		$updatedUser->update($request);
		return $updatedUser;
	}

	public function delete($id)
	{
		$updatedUser = $this->user->findOrFail($id);
		$updatedUser->delete();
	}

	public function find($id)
	{
		return $this->user->find($id);
	}
}