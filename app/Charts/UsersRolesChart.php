<?php

namespace App\Charts;

use App\Role;
use App\User;
use ConsoleTVs\Charts\Classes\Highcharts\Chart;

class UsersRolesChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();


		$data = array();
		foreach (Role::withCount('users')->get() as $role) {
			$data['names'][] = $role->description; 
			$data['count'][] = $role->users_count; 
		}

		$this->labels($data['names']);
		$this->dataset('Usuarios por perfil', 'pie', $data['count'])
			->color(['#38c172', '#4dc0b5', '#3490dc']);

    }
}
