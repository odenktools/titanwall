<?php namespace Ngakost\TitanWall\Http\Controllers;

use Ngakost\TitanWall\Models\FieldType;

class FieldTypeController extends TitanWallController
{
    /**
     * @return void
     */
    public function index()
    {
        if (view()->exists('titanwall::admin.modules.fieldtype.index')) {
            return view('titanwall::admin.modules.fieldtype.index');
        }
    }
	
	/**
	 * @todo
	 */	
	public function getTestmodel()
	{
		$field_type = FieldType::all();
		
		echo json_encode($field_type);
		
	}
	
}