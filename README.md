
This is laravel framework with liamcottle Instagram private library.

This is automated application built to share likes between community of users. Users can login and get likes by requesting it. Same way user account used to send likes to other user requests. Applies for auto follows, comments too. 

<b>The new instagram checkpoint has been bit solved with this code.</b>

<b> Application can do </b>

1. Username and password login
2. Ability to pass instagram checkpoint issue.
3. Automated proxy supported.

<b> To install this application.</b>

1. Clone this repo.
2. change database information on .env file
3. Migrate database using `php artisan migrate` and seed it using command php artisan db:seed
4. Login admin via /alogin

<b>
   email: admin@admin.com
   password: testpassword
</b>

4. Add proxies. Goto admin panel and add proxies. No problem, if you are using small application. By default, there's one proxy to use <b>Not recommended</b>. Use proxy from the same country user comes from.

5. Now goto main page of the app.

   Sigin with instagram username and password. If it's ask for verification code, verify with the code.   
   
 <b> To get followers </b>
   
 6. once everything done, you can request followers via /getfollowers/{user_id}/{next_id}
 
 
 <b> You need to run laravel cron every minute in order to auto comment, like, follow to work.</a>

<b> Raise issue or request new functionalities. I am happy to work.</b>
 
 <b> <a href="https://paypal.me/muthukrishnanc/5"> If you like my work, donate $5 to improve this script.<a> </b>
