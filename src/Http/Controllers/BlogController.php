<?php namespace Ngakost\TitanWall\Http\Controllers;

use Illuminate\Contracts\View\Factory as view;

/**
 * @todo
 */

class BlogController extends PublicController
{
	public function index()
	{
        if (view()->exists('titanwall::public.blog.index')) {
            return view('titanwall::public.blog.index');
        }
	}
}
