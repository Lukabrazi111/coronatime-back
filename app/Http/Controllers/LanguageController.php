<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
	public function change($lang)
	{
		session(['lang' => $lang]);

		return redirect()->back();
	}
}
