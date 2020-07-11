# Github API
A REST microservies that list the languages used by the 100 trending public repos on GitHub.\
This project is implemented by Laravel 7.19.0 framework.

## Main features
- List the languages used by the 100 trending public repos.
- Get list and number of repos used by each language.

#### List the languages used by the 100 trending public repos:
GET /languages route of this feature is implemented in web.php in routes folder.\
Implementation of this feature is in LanguagesController.php in Controllers folder in showLanguages function.\
The request of github api to get the 100 trending public repos is called then the array_column function is called to get the languages.\
The server send a JSON response contains the languages.

#### Get list and number of repos used by each language:
GET /repos-using-languages route of this feature is implemented in web.php in routes folder.\
Implementation of this feature is in LanguagesController.php in Controllers folder in showReposUsingLanguages function.\
For each language, array_filter built-in php function is called with callback function to get the repos used by this language.\
A JSON response is sent contains list and number of repos of each language.
