## Laravel API Boilerplate (JWT Edition)

Laravel API Boilerplate is a ready-to-use "starting pack" that you can use to build your first API in seconds. As you can easily imagine, it is built on top of the awesome Laravel Framework.

It also benefits from three pacakages:

* JWT-Auth - [tymondesigns/jwt-auth](https://github.com/tymondesigns/jwt-auth)
* Dingo API - [dingo/api](https://github.com/dingo/api)
* Laravel-CORS [barryvdh/laravel-cors](http://github.com/barryvdh/laravel-cors)

With a similar foundation is really easy to get up and running in no time. I just made an "integration" work, adding here and there something that I found useful.

## Installation

```bash
$ composer create-project francescomalatesta/laravel-api-boilerplate-jwt
```

## Usage

I wrote a couple of articles on this project that explain how to write an entire sample application with this boilerplate. You can find it on Sitepoint:

* [How to Build an API-Only JWT-Powered Laravel App](https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/)
* [How to Consume Laravel API with AngularJS](https://www.sitepoint.com/how-to-consume-laravel-api-with-angularjs/)

## Main Features

### A Ready-To-Use AuthController

I've put an "AuthController" in _App\Api\V1\Controllers_. It supports the four basic authentication/password recovery operations:

* _login()_;
* _signup()_;
* _recovery()_;
* _reset()_;

In order to work with them, you just have to make a POST request with the required data.

You will need:

* _login_: just email and password;
* _signup_: whatever you like: you can specify it in the config file;
* _recovery_: just the user email address;
* _reset_: token, email, password and password confirmation;

### A Separate File for Routes

You can specify your routes in the `api_routes.php` file, that will be automatically loaded. In this file you will find many examples of routes.

### Secrets Generation

Every time you create a new project starting from this repository, the _php artisan jwt:generate_ command will be executed.

## Configuration

As I already told before, this boilerplate is based on _dingo/api_ and _tymondesigns/jwt-auth_ packages. So, you can find many informations about configuration <a href="https://github.com/tymondesigns/jwt-auth/wiki/Configuration" target="_blank">here</a> and <a href="https://github.com/dingo/api/wiki/Configuration">here</a>.

However, there are some extra options that I placed in a _config/boilerplate.php_ file.

* **signup_fields**: you can use this option to specify what fields you want to use to create your user;
* **signup_fields_rules**: you can use this option to specify the rules you want to use for the validator instance in the signup method;
* **signup_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _201 Created_ response;
* **reset_token_release**: if "true", an access token will be released from the signup endpoint if everything goes well. Otherwise, you will just get a _200_ response;
* **recovery_email_subject**: here you can specify the subject for your recovery data email;

## Creating Endpoints

You can create endpoints in the same way you could to with using the single _dingo/api_ package. You can <a href="https://github.com/dingo/api/wiki/Creating-API-Endpoints" target="_blank">read its documentation</a> for details.

After all, that's just a boilerplate! :)

## Cross Origin Resource Sharing

If you want to enable CORS for a specific route or routes group, you just have to use the _cors_ middleware on them.

Thanks to the _barryvdh/laravel-cors_ package, you can handle CORS easily. Just check <a href="https://github.com/barryvdh/laravel-cors" target="_blank">the docs at this page</a> for more info.

## Notes

I currently removed the _VerifyCsrfToken_ middleware from the _$middleware_ array in _app/Http/Kernel.php_ file. If you want to use it in your project, just use the route middleware _csrf_ you can find, in the same class, in the _$routeMiddleware_ array.

## Feedback

I currently made this project for personal purposes. I decided to share it here to help anyone with the same needs. If you have any feedback to improve it, feel free to make a suggestion, or open a PR!

============== Curl Commands =====================

$ php artisan api:routes
+------+----------+--------------------+------+--------------------------------------------------+-----------+------------+----------+------------+
| Host | Method   | URI                | Name | Action                                           | Protected | Version(s) | Scope(s) | Rate Limit |
+------+----------+--------------------+------+--------------------------------------------------+-----------+------------+----------+------------+
|      | POST     | /api/auth/login    |      | App\Api\V1\Controllers\AuthController@login      | No        | v1         |          |            |
|      | POST     | /api/auth/signup   |      | App\Api\V1\Controllers\AuthController@signup     | No        | v1         |          |            |
|      | POST     | /api/auth/recovery |      | App\Api\V1\Controllers\AuthController@recovery   | No        | v1         |          |            |
|      | POST     | /api/auth/reset    |      | App\Api\V1\Controllers\AuthController@reset      | No        | v1         |          |            |
|      | POST     | /api/book/store    |      | App\Api\V1\Controllers\BookController@store      | Yes       | v1         |          |            |
|      | GET|HEAD | /api/book          |      | App\Api\V1\Controllers\BookController@index      | Yes       | v1         |          |            |
|      | GET|HEAD | /api/books         |      | App\Api\V1\Controllers\BookController@index      | Yes       | v1         |          |            |
|      | GET|HEAD | /api/books/{id}    |      | App\Api\V1\Controllers\BookController@show       | Yes       | v1         |          |            |
|      | PUT      | /api/books/{id}    |      | App\Api\V1\Controllers\BookController@update     | Yes       | v1         |          |            |
|      | DELETE   | /api/books/{id}    |      | App\Api\V1\Controllers\BookController@destroy    | Yes       | v1         |          |            |
|      | DELETE   | /api/books         |      | App\Api\V1\Controllers\BookController@destroyAll | Yes       | v1         |          |            |
+------+----------+--------------------+------+--------------------------------------------------+-----------+------------+----------+------------+

curl -X POST -F 'name=Mursaleen' -F 'email=mursaleen@gmail.com' -F 'password=something' http://localhost:8000/api/auth/signup

curl -X POST -F 'email=mursaleen@gmail.com' -F 'password=something' http://localhost:8000/api/auth/login


curl -X POST -F 'title=Mursaleens Book' -F "author_name=Mursaleen" -F 'pages_count=132' http://localhost:8000/api/book/store?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

curl -X POST -F 'title=Mursaleens second book' -F "author_name=Mursaleen Selim" -F 'pages_count=136' http://localhost:8000/api/book/store?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

curl --request GET http://localhost:8000/api/book?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

curl --request GET http://localhost:8000/api/books?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

curl --request GET http://localhost:8000/api/books/9?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU
curl --request GET http://localhost:8000/api/books/8?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

curl -X PUT -d 'title=Mursaleens First book' -d "author_name=Mursaleen Selim Monon" -d 'pages_count=140' http://localhost:8000/api/books/8?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

curl -X PUT -d 'title=Mursaleens excellent book' -d 'author_name=Excellent Monon' -d 'pages_count=1234' http://localhost:8000/api/books/8?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU

$ curl -v -X DELETE http://localhost:8000/api/books/10?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU
*   Trying ::1...
* Connected to localhost (::1) port 8000 (#0)
> DELETE /api/books/10?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU HTTP/1.1
> Host: localhost:8000
> User-Agent: curl/7.43.0
> Accept: */*
> 
* HTTP 1.0, assume close after body
< HTTP/1.0 204 No Content
< Host: localhost:8000
< Connection: close
< X-Powered-By: PHP/5.6.24
< Cache-Control: private, must-revalidate
< ETag: "da39a3ee5e6b4b0d3255bfef95601890afd80709"
< Date: Sun, 27 Nov 2016 01:34:15 GMT
< Content-type: text/html; charset=UTF-8
< 
* Closing connection 0

$ curl -i -X DELETE http://localhost:8000/api/books?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQsImlzcyI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNDgwMjA2Nzg4LCJleHAiOjE0ODAyOTMxODgsIm5iZiI6MTQ4MDIwNjc4OCwianRpIjoiZWM2ZmNjMDEwMzc1OTkzY2ExNjNiYzAxNTExOThmNzQifQ.Xgn08MHDRSC48H57uur2VYAJS6viWbcSLOQSOVry4OU
HTTP/1.0 204 No Content
Host: localhost:8000
Connection: close
X-Powered-By: PHP/5.6.24
Cache-Control: private, must-revalidate
ETag: "da39a3ee5e6b4b0d3255bfef95601890afd80709"
Date: Sun, 27 Nov 2016 01:44:32 GMT
Content-type: text/html; charset=UTF-8
