Installation
1. git clone https://github.com/artushmkrtchyan/laravel.git
2. composer install
3. save the .env.example to .env
4. update the .env file with your db credentials
5. php artisan key:generate
6. php artisan migrate
7. php artisan storage:link
8. Login social:
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

passport version number (4.0.3)
