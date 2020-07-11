<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LanguagesController extends Controller
{
    public function showLanguages()
    {
    	$response = Http::get('https://api.github.com/search/repositories?q=created:>2020-07-10&sort=stars&order=desc&per_page=100');
    	$repos=json_decode($response->body());
    	return  response()->json($repos);
	}
}
