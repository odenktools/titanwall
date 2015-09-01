<?php namespace Ngakost\TitanWall\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class PublicController extends BaseController
{
	protected $_mainMenu = null;

	/**
	 * @todo
	 */
    public function __construct(){}
}