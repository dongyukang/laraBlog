## LaraBlog

LaraBlog is a simple blog powered by Laravel 5.

###Features Included:

* Markdown support, so articles can be look nice without needing to write html.
* Comment support, allowing users to leave comments on articles and see what other users have said.
* Profile pages, so users can look up others to see their comment history. Users can also create a custom 'about me' page.
* User roles. Admins can post, edit, and delete articles, while Owners can create new Admins. Users may also be banned, which prevents them from posting.
* Article tagging. Articles can be tagged with custom tags for easy organization.

###Using LaraBlog:

I wrote LaraBlog to learn more about laravel 5 and it's associated tools. However, you can easily install and run LaraBlog if you want to try it out! Here's how:

1. Clone this repository
2. (Optional) Set up the database by editing config/database.php and .env (if you want). By default, LaraBlog will work just fine using sqlite and saving data in storage/database.sqlite.
3. In the command line, run "php artisan migrate --seed". This will create the necessary tables.
4. If you want to test LaraBlog locally, run "php artisan serve" on the command line, and navigate to "localhost:8000" in your browser. You should see LaraBlog!
5. Log in using the account "master@gmail.com" with the password "password". This is an owner-level account with access to everything.


###Resources Used:

I used a few different libraries and frameworks to make LaraBlog. First and foremost, of course, was [laravel 5](http://laravel.com/), which powers the blog.

I also used the following:

* [select2](https://select2.github.io/) was used to make the tag selection process much more user friendly.
* [bootstrap](http://getbootstrap.com/) was used to handle the blog's visuals
* [markdown-js](https://github.com/evilstreak/markdown-js) was used to provide a real-time preview of the article.
* [parsedown-laravel](https://github.com/maxhoffmann/parsedown-laravel) was used to convert markdown to html in the backend