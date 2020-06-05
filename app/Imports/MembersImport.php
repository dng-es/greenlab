<?php

namespace App\Imports;

use App\Member;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MembersImport implements ToModel
{
/**
	 * @param array $row
	 *
	 * @return User|null
	 */
	public function model(array $row)
	{
		if ($member = Member::create([
			'code'     => $row[0],
			'vat'     => $row[1],
			'name'     => $row[2],
			'last_name'     => $row[3],
			'telephone'     => $row[4],
			'picture'     => 'default.jpg',
			'active'     => '1',
			'born_at'     => '1970-01-01',
			'notes'     => '',
			'email'    => $row[5], 
		])) return $member;
		else return false;
	}
}
