# Laranotify
<p class="center">
<a href="https://packagist.org/packages/coderatio/laranotify"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
<a href="https://poser.pugx.org/coderatio/laranotify/downloads"><img src="https://poser.pugx.org/coderatio/laranotify/downloads"></a>
</p>
The most advanced laravel package to dynamically display beautiful and elegant alert messages, blockables and notifications on screen. This is built with fluency in mind--meaning, you can chain as many methods as you want. Lots of functionalities are available. <a href="#demos">See demos</a>

It's built on top of Bootstrap notify or growl plugin. It comes with all methods in the plugin with lots of additional advanced methods. It therefore, requires you to have bootstrap installed on your project. However, customizing the template, gives your users different looks. Read about template customization under templates section.

> **Note:** _To start building your custom template, it's advisable to publish a sample to your view directory. When published, the sample template will be copied to laranotify directory inside your views folder. <a href="#publish-template">Learn about template publishing here</a>_.

# Installation
Laranotify installation should be done via composer.
Require `coderatio/laranotify` in your project's composer.json file OR

Do `composer require coderatio/laranotify` on your terminal or command prompt if you are on Windows OS.

# Provider and Aliases
If your Laravel installed version is less than 5.5, you will need to manually register the service provider and aliases. The provider and aliases are auto-discovered in version 5.5 and above.

To register the package service provider and aliases, open your `app.php` in config directory of your laravel installation then copy and paste:

```php
// Laranotify provider
Coderatio\Laranotify\LaranotifyServiceProvider::class,
```
Under your providers array.

Then in your aliases array, copy and paste:
```php
// Laranotify aliases
'Notify' => Coderatio\Laranotify\Facades\Notify::class,
'Laranotify' => Coderatio\Laranotify\Facades\Laranotify::class,
```
The aliases are Facades that helps you bind non static methods as static to the package service class. E.g 
```php
Notify::success('This is a message'); 
 ```
 
# Publishing
The package has configuration and assets files that needs to be published to your app public directory. To publish these files, run;

```vim 
php artisan vendor:publish --tag=laranotify-required
``` 
on your command line.

# Header and footer
Finally, call ``notify_header()`` function at the head tag and `notify_footer()` after your bootstrap JavaScript file to register laranotify assets in your project. This step is required.

e.g
##### Header
```html
<head>
{{ notify_header() }}

</head>
```
> **Note:** _If you want to use the included Bootstrap css file, pass ``true`` as a parameter to the function like this:_

```blade
 {{ notify_header(true) }}
```
##### Footer
```html
{{ notify_footer() }}

</body>
```
> **Note:** _If you want to use the included Bootstrap and jQuery files, pass ``true`` as a parameter to the function like this:_
```blade
 {{ notify_footer(true) }}
```

_For these files to be properly loaded in your project, you will need to run ``php artisan vendor:publish --tag=laranotify-foundations`` on your command line or prompt._

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
````
Same as notify helper above.

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
## Demos
<img src="https://github.com/coderatio/laranotify/blob/master/src/public/img/blockable-icon.jpg"/>

## Attributions
We deeply want to appreciate the creator of Bootstrap notify or growl plugin [Robert McIntosh](https://github.com/mouse0270). Without which, there wouldn't have been this awesome package.
## Documentation
Full documentation can be found <a href="">here</a>.
## Copyright & Licence
The MIT License (MIT) Copyright (c) 2018 Coderatio

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

