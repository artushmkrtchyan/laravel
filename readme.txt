Installation
$ git clone https://github.com/artushmkrtchyan/laravel.git
$ composer install
 	save the .env.example to .env
	update the .env file with your db credentials
$ php artisan key:generate
$ php artisan migrate 
	or
$ php artisan migrate:refresh --seed
$ php artisan storage:link
$ php artisan passport:install

Login social:
  Set the keys you got after registering your app in your .env file:

  TWITTER_ID=
  TWITTER_SECRET=
  TWITTER_URL=http://local.laravel/auth/twitter/callback

  GITHUB_ID=
  GITHUB_SECRET=
  GITHUB_URL=http://local.laravel/auth/github/callback

  FACEBOOK_ID=
  FACEBOOK_SECRET=
  FACEBOOK_URL=http://local.laravel/auth/facebook/callback


URL
1 https://scotch.io/tutorials/user-authorization-in-laravel-54-with-spatie-laravel-permission
2 https://github.com/caleboki/acl
3.https://github.com/KodeBlog/Laradmin
4.https://medium.com/@ezp127/laravel-5-4-native-user-authentication-role-authorization-3dbae4049c8a
5.https://scotch.io/tutorials/laravel-social-authentication-with-socialite

