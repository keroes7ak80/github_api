<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LanguagesController extends Controller
{
	private function getRepos()
	{
		$response = Http::get('https://api.github.com/search/repositories?q=created:>2020-06-10&sort=stars&order=desc&per_page=100');
    	$repos=json_decode($response->body())->items;

    	return $repos;
	}

	private function getLanguagesAndRepos()
	{
		$repos=$this->getRepos();
    	$languages=array_column($repos, 'language'); // Get languages of all repos
    	$languages=array_values(array_unique(array_filter($languages))); // Remove nulls
    	return ['languages'=>$languages,'repos'=>$repos];
	}


    public function showLanguages()
    {
    	return  response()->json($this->getLanguagesAndRepos()['languages']);
	}

	public function showReposUsingLanguages()
	{
		$languages_repos=$this->getLanguagesAndRepos();
		$languages=$languages_repos['languages'];
		$repos=$languages_repos['repos'];
		
		$response=[];
		foreach ($languages as $key => $language) {
			
			// A callback function sent as a parameter to 
			// array_filter funnction to return repos of a certain language
			$filter_callback=function ($value,$key) use ($language) {
			return $value->language==$language;
			};
			$repos_using_language=array_values(array_filter($repos,$filter_callback,ARRAY_FILTER_USE_BOTH));

			$language_data=['language'=>$language,'number_of_repos'=>count($repos_using_language),'repos'=>$repos_using_language];
			array_push($response, $language_data);
		}

		return  response()->json($response);
	}
}
