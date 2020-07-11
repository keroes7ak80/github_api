<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LanguagesController extends Controller
{
	private function getRepos()
	{
		$response = Http::get('https://api.github.com/search/repositories?q=created:>2020-07-10&sort=stars&order=desc&per_page=100');
    	$repos=json_decode($response->body());
    	$repos=$repos->items;

    	return $repos;
	}

	private function getLanguages()
	{
		$repos=$this->getRepos();
    	$languages=array_column($repos, 'language'); // Get languages of all repos
    	$languages=array_filter($languages); // Remove nulls
    	$languages = array_values($languages); 
    	return $languages;
	}


    public function showLanguages()
    {
    	return  response()->json($this->getLanguages());
	}

}
