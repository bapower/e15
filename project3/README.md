
# Project 3 
+ By: Bry Power
+ Production URL: <http://e15p3.brypower.rocks>

## Feature summary

+ Visitors can register/log in
+ Visitors can search for or browse restaurants
+ Visitors can read reviews and discussions about restaurants
+ Users can write reviews of restaurants
+ Users can update or delete reviews that they have written
+ Users can reply to reviews of restaurants
+ Users can delete replies that they have written
+ Users can add restaurants to their favorites
+ Users can view/ remove restaurants that are favorites

  
## Database summary

+ My application has 5 tables in total (`users`, `resaurants`, `restaurant_user`, `reviews`, `replies`)
+ There's a many-to-many relationship between `restaurants` and `users`
+ There's a one-to-many relationship between `reviews` and `users`
+ There's a one-to-many relationship between `restaurants` and `replies`
+ There's a one-to-many relationship between `replies` and `users`
+ There's a one-to-many relationship between `replies` and `reviews`

## Outside resources
#### PHP Documentation
* [strtolower](https://www.php.net/manual/en/function.strtolower.php)
* [preg_match_all](https://www.php.net/manual/en/function.preg-match-all.php)
* [strlen](https://www.php.net/manual/en/function.strlen.php)
* [array_rand](https://www.php.net/manual/en/function.array-rand.php)
* [str_repeat](https://www.php.net/manual/en/function.str-repeat.php)
#### Other resources
* [Laravel Documentation](https://laravel.com/docs/7.x/installation)
* [regexr](https://regexr.com/)
* [Name Generator](https://www.fantasynamegenerators.com/restaurant-names.php)
* [Lorem Flickr](https://loremflickr.com/)
* [Dusk Documentation](https://laravel.com/docs/7.x/dusk)
* [Faker Documentation](https://github.com/fzaninotto/Faker)
* [Bootstrap Documentation](https://getbootstrap.com/)
* [Font Awesome Documentation](https://fontawesome.com/v4.7.0/icons/)
* [Let's Build a Forum with Laravel and TDD](https://laracasts.com/series/lets-build-a-forum-with-laravel)
* [SQL SELECT WHERE field contains words](https://stackoverflow.com/questions/14290857/sql-select-where-field-contains-words)
* [Laravel get count on belongsToMany relationship](https://stackoverflow.com/questions/50345871/laravel-get-count-on-belongstomany-relationship)
* [Laravel: How to Make Menu Item Active by URL/Route](https://quickadminpanel.com/blog/laravel-how-to-make-menu-item-active-by-urlroute/)
* [Laravel Eloquent ORM - removing rows and all the child relationship, with event deleting](https://stackoverflow.com/questions/34989701/laravel-eloquent-orm-removing-rows-and-all-the-child-relationship-with-event)
* [Deleting specific records from the pivot table](https://stackoverflow.com/questions/45908315/laravel-5-4-deleting-specific-records-from-the-pivot-table)


