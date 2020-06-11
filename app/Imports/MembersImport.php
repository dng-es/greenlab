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

		try {
			$member = Member::create([
				'code'     => $row[0],
				'vat'     => $row[1],
				'name'     => $row[2],
				'last_name'     => $row[3],
				'telephone'     => $row[4],
				'email'    => $row[5], 
				'picture'     => 'default.jpg',
				'active'     => '1',
				'born_at'     => '1970-01-01',
				'notes'     => '',
			]);

			return $member;
		} catch (\Exception $e) { // It's actually a QueryException but this works too
			if ($e->getCode() == 23000) {
				abort(500, 'Duplicate entry CODE: '.$row[0]);
			}
		}
	}
}
