---
layout: single
---


# [](#introduction)Introduction

Laranotify is the most advanced and recommended laravel package that redefines the way alert messages or notifications are displayed on screen. 

It's built on top of the popular Bootstrap notify plugin by [Robert McIntosh](https://github.com/mouse0270). Every method found there in the plugin is included in this awesome package. The package has added the ability to create custom templates apart from the type provided by Robert. However, customizing the template, gives your users different looks. Read about template customization under templates section.

> **Note:** _To start building your custom templates, it’s advisable to publish the samples provided by the package to your view directory. [Learn more about this here](#publishing)_

 > When published, the sample templates will be copied to `views/vendor/vendor` folder.
 
# Provider
The package provider is auto-discovered if you are using Laravel 5.5 and above. If your version is less than 5.5, kindly add this line to your ``config/app.php`` file under providers array.

```php
/**
* Laranotify provider.
*
*/

Coderatio\Laranotify\LaranotifyServiceProvider::class,
```
# Aliases (Facades)
The package comes with two facades. If you want to use them, kindly the code below to your ``config/app.php`` file under aliases array.

```php
/**
* Laranotify aliases.
*
*/

'Notify' => Coderatio\Laranotify\Facades\Notify::class,
'Laranotify' => Coderatio\Laranotify\Facades\Laranotify::class,
```

# Publishing
The package has configuration and assets files that needs to be published to your app public directory. To publish these files, run this on your terminal:

```vim 
php artisan vendor:publish --tag=laranotify-required
``` 

# Header and footer
Finally, call ``notify_header()`` function at the head tag and `notify_footer()` after your bootstrap JavaScript file to register laranotify assets in your project. This step is required.

e.g
### Header
```php
notify_header();
```
> <i class="l sl-icon-warning"></i> **Note:** _If you want to use the included Bootstrap css file, pass ``true`` as a parameter to the function like this:_

```php
notify_header(true);
```

### Footer
```php
notify_footer();
```
> **Note:** _If you want to use the included Bootstrap and jQuery files, pass ``true`` as a parameter to the function like this:_

```php
 notify_footer(true);
```
> **Note:** _For these files to be properly loaded in your project, you will need to run this on your terminal:_

```vim
php artisan vendor:publish --tag=laranotify-foundations
```

# Usage via Facades
```php
Notify::message ('I am a simple notification from laranotify');
// You've just created your first notification.
```
 
 You can then chain other methods to it. For example, if i want to change the delay period, i will do this:
  ```php
 Notify::success('I am a simple notification from laranotify')->delay(6000); 
 // 6000 = 6secs.
 ```
We included two facades for conveniences. You can choose to use either of them.
# Usage via helpers
There are two helper functions provided to help you get started out of the box. The helper functions return the instance of the package service class.

```php
/**
* @param (string) $message
*/
notify();
```

This helper takes only one argument which is your message. You may use the message method or notify types methods e.g error, info e.t.c by chaining to the helper function and many other once.

```php
/**
* @param (string) $message
*/
laranotify();
// Same as notify helper above. Take a look below.
````

```php
notify('Hello World'); 
// OR
laranotify('Hello World');
```

Will display ``Hello World`` on screen with default bootstrap info alert type.

To display a different type of alert , say error alert, chain error method to a helper or type method and pass any bootstrap alert class or your custom class to it. E.g

```php
notify()->error('There was an error!'); 
 // OR
notify('There was an error!')->type('danger');
```

## Attributions
We deeply want to appreciate the creator of Bootstrap notify or growl plugin [Robert McIntosh](https://github.com/mouse0270). Without which, there wouldn't have been this awesome package.


### Components

*   This is an unordered list following a header.
*   This is an unordered list following a header.
*   This is an unordered list following a header.

##### [](#header-5)Header 5

1.  This is an ordered list following a header.
2.  This is an ordered list following a header.
3.  This is an ordered list following a header.

###### [](#header-6)Header 6

| head1        | head two          | three |
|:-------------|:------------------|:------|
| ok           | good swedish fish | nice  |
| out of stock | good and plenty   | nice  |
| ok           | good `oreos`      | hmm   |
| ok           | good `zoute` drop | yumm  |

### There's a horizontal rule below this.

* * *

### Here is an unordered list:

*   Item foo
*   Item bar
*   Item baz
*   Item zip

### And an ordered list:

1.  Item one
1.  Item two
1.  Item three
1.  Item four

### And a nested list:

- level 1 item
  - level 2 item
  - level 2 item
    - level 3 item
    - level 3 item
- level 1 item
  - level 2 item
  - level 2 item
  - level 2 item
- level 1 item
  - level 2 item
  - level 2 item
- level 1 item

### Small image

![](https://assets-cdn.github.com/images/icons/emoji/octocat.png)

### Large image

![](https://guides.github.com/activities/hello-world/branching.png)


### Definition lists can be used with HTML syntax.

<dl>
<dt>Name</dt>
<dd>Godzilla</dd>
<dt>Born</dt>
<dd>1952</dd>
<dt>Birthplace</dt>
<dd>Japan</dd>
<dt>Color</dt>
<dd>Green</dd>
</dl>

```
Long, single-line code blocks should not wrap. They should horizontally scroll if they are too long. This line should be long enough to demonstrate this.
```

```
The final element.
```
