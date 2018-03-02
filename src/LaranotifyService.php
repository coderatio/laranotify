<?php
/**
 * Created by PhpStorm.
 * User: JOSIAH
 * Date: 2/25/2018
 * Time: 6:11 PM
 */

namespace Coderatio\Laranotify;


class LaranotifyService
{
    /**
     * Laranotify config object instance
     * @var $config
     */
    private $config;
    /**
     * The type notification to show. danger, warning, info or success
     * @var string $type
     */
    public $type = 'info';
    /**
     * The message to display
     * @var string $message
     */
    public $message;
    /**
     * The notification title
     * @var string $title
     */
    public $title = 'Alert';
    /**
     * The amount of time to allow notification box stay visible
     * @var int $timer
     */
    public $timer = 1000;
    /**
     * @var int
     */
    public $delay = 5000;
    /**
     * @var bool $progress
     */
    public $progress = 'true';
    /**
     * @var string $icon
     */
    public $icon;
    /**
     * @var string $element
     */
    public $element = 'body';
    /**
     * @var string $url
     */
    public $url;
    /**
     * @var string $target
     */
    public $target = '_blank';
    /**
     * @var string $urlTarget
     */
    public $urlTarget = '_blank';
    /**
     * @var string $position
     */
    public $position = 'null';
    /**
     * @var array $animate
     */
    public $animate = [
        'enter' => 'animated fadeInRight',
        'exit' => 'animated fadeOutRight'
    ];
    /**
     * @var bool $allowDismiss
     */
    public $allowDismiss = 'true';
    /**
     * @var bool $newestFirst
     */
    public $newestFirst = 'true';
    /**
     * @var array $placement
     */
    public $placement = [];
    /**
     * @var int $spacing
     */
    public $spacing = 10;
    /**
     * @var int $offset
     */
    public $offset = 20;
    /**
     * @var int $offsetX
     */
    public $offsetX = 20;
    /**
     * @var int $offsetY
     */
    public $offsetY = 20;
    /**
     * @var int $zIndex
     */
    public $zIndex = 1031;
    /**
     * @var string $mouseOver
     */
    public $mouseOver = 'pause';
    /**
     * @var null $onShow
     */
    public $onShow = 'null';
    /**
     * @var null $onShown
     */
    public $onShown = 'null';
    /**
     * @var null $onClose
     */
    public $onClose = 'null';
    /**
     * @var null $onClosed
     */
    public $onClosed = 'null';
    /**
     * @var string $iconType
     */
    public $iconType = 'class';
    /**
     * @var string $template
     */
    public $template;
    /**
     * @var array $data
     */
    public $data = [];

    /**
     * LaranotifyService constructor.
     * Inject configurator via laravel container to $config property
     */
    public function __construct()
    {
        $this->config = app('LNConfig');
    }

    /**
     * Build error messages
     * @param string $message
     * @return mixed
     */
    public function error($message)
    {
        $this->message = $message;
        $this->type = 'danger';
        $this->title = 'Whoops';
        $this->icon = 'sl sl-icon-close danger ln-notify-icon';
        $this->animate['enter'] = 'animated tada';

        return $this->setNotifier();
    }

    /**
     * Build warning messages
     * @param string $message
     * @return mixed
     */
    public function warning($message)
    {
        $this->message = $message;
        $this->type = 'warning';
        $this->title = 'Warning';
        $this->icon = 'sl sl-icon-bell warning ln-notify-icon';

        return $this->setNotifier();
    }

    /**
     * Build info messages
     * @param string $message
     * @return mixed
     */
    public function info($message)
    {
        $this->message = $message;
        $this->type = 'info';
        $this->title = 'Notice';
        $this->icon = 'sl sl-icon-info info ln-notify-icon';

        return $this->setNotifier();
    }

    /**
     * Build info messages
     * @param string $message
     * @return mixed
     */
    public function success($message)
    {
        $this->message = $message;
        $this->type = 'success';
        $this->title = 'Success';
        $this->icon = 'sl sl-icon-check success ln-notify-icon';

        return $this->setNotifier();
    }

    /**
     * This is the title that will be displayed at top of the notification.
     * Please keep in mind you can style the [data-notify="title"] in style.css this to look the way you want.
     * @param string $title
     * @return LaranotifyService
     */
    public function title($title)
    {
        $this->title = $title;
        return $this->setNotifier();
    }

    /**
     * This will control the animation used to bring and remove the notification. Since version 1.0.0 all animations are controlled using css. Animate.css by Daniel Eden is already loaded for you on ln_header function.
     * @param boolean|array $animation
     * @return LaranotifyService
     */
    public function animate($animation)
    {
        if (is_array($animation) && isset($animation[0]) && isset($animation[1])) {
            $this->animate['enter'] = "animated " . $animation[0];
            $this->animate['exit'] = "animated " . $animation[1];
        }

        if (is_array($animation) && isset($animation['enter']) && isset($animation['exit'])) {
            $this->animate['enter'] = "animated {$animation['enter']}";
            $this->animate['exit'] = "animated {$animation['exit']}";
        }

        if (is_bool($animation) && $animation == false) {
            $this->animate['enter'] = null;
            $this->animate['exit'] = null;
        }

        return $this->setNotifier();
    }

    /**
     * This will control the animation used to bring the notification on screen.
     * @param string $animation
     * @return LaranotifyService
     */
    public function enter($animation)
    {
        $this->animate['enter'] = "animated {$animation}";

        return $this->setNotifier();
    }

    /**
     * This will control the animation used to remove the notification on screen.
     * @param string $animation
     * @return LaranotifyService
     */
    public function out($animation)
    {
        $this->animate['exit'] = "animated {$animation}";

        return $this->setNotifier();
    }

    /**
     * This boolean is used to determine if the notification should display a progress bar.
     * @param boolean $bool
     * @return LaranotifyService
     */
    public function progress($bool)
    {
        if (is_bool($bool)) {
            $this->progress = json_encode($bool);
        }

        return $this->setNotifier();
    }

    /**
     * This is the icon that will be displayed within the notification.
     * This icon can either be a class (Font Icon) or an image url.
     * Please keep in mind if you wish to use an image then, use the imageIcon method instead.
     * @param string $icon
     * @return LaranotifyService
     */
    public function icon($icon)
    {
        $this->icon = "ln-notify-icon {$this->type} {$icon}";

        return $this->setNotifier();
    }

    /**
     * This is the message that will be displayed within the notify notification.
     * @param string $type danger, warning, info, success
     * @param string $message
     * @return LaranotifyService
     */
    public function message($message, $type = '')
    {
        if ($type == 'danger') {
            $this->animate['enter'] = 'animated tada';
        }
        if ($type != '') {
            $this->type = $type;
        }

        $this->message = $message;

        return $this->setNotifier();
    }

    /**
     * If this value is set it will make the entire notify (except the close button) a clickable area.
     * If the user clicks on this area it will take them to the @var $url ; specified here.
     * @param string $url
     * @param string $target
     * @return LaranotifyService
     */
    public function url($url, $target = '')
    {
        $this->urlTarget = $target;
        $this->url = $url;

        return $this->setNotifier();
    }

    /**
     * This sets the target of the url for a notification. please check HTML <a> target Attribute to learn more about these options.
     * @param string $target
     * @return LaranotifyService
     */
    public function urlTarget($target)
    {
        $this->urlTarget = $target;

        return $this->setNotifier();
    }

    /**
     * By default this does nothing. If you set this option to pause it will pause the timer on the notification delay.
     * @param string $event
     * @return LaranotifyService
     */
    public function mouseOver($event)
    {
        $this->mouseOver = $event;

        return $this->setNotifier();
    }

    /**
     * Appends the notification to a specific element. If the element is set to anything other than the body
     * of a document it switches from a position: fixed to position: absolute.
     * @param string $element
     * @return LaranotifyService
     */
    public function element($element)
    {
        $this->element = $element;

        return $this->setNotifier();
    }

    /**
     * Defines the style of the notification using bootstraps native alert styles.
     * Please keep in mind that when the notification is generated the type gets prefixed with alert-$type.
     * It's set to info by default.
     * @param string $type
     * @return LaranotifyService
     */
    public function type($type)
    {
        $this->type = $type;

        return $this->setNotifier();
    }

    /**
     * This adds padding in pixels between the element and the notification creating a space between their edges.
     * @param integer $offset
     * @return LaranotifyService
     */
    public function offset($offset)
    {
        if (is_int($offset)) {
            $this->offset = $offset;
        }

        return $this->setNotifier();
    }

    /**
     * This adds adding on the x axis in pixels between the element and the notification creating a space between their edges.
     * @param integer $offset
     * @return LaranotifyService
     */
    public function offsetX($offset)
    {
        if (is_int($offset)) {
            $this->offsetX = $offset;
        }

        return $this->setNotifier();
    }

    /**
     * This adds padding on the y axis in pixels between the element and the notification creating a space between their edges.
     * @param integer $offset
     * @return LaranotifyService
     */
    public function offsetY($offset)
    {
        if (is_int($offset)) {
            $this->offsetY = $offset;
        }

        return $this->setNotifier();
    }

    /**
     * This adds a padding in pixels between notifications with the same placement creating a space between their edges.
     * @param integer $space
     * @return LaranotifyService
     */
    public function spacing($space)
    {
        if (is_int($space)) {
            $this->spacing = $space;
        }

        return $this->setNotifier();
    }

    /**
     * Pretty simple, this sets the css property z-index for the notification. You may have to raise this number if you have other elements overlapping the notification.
     * @param integer $index
     * @return LaranotifyService
     */
    public function zIndex($index)
    {
        if (is_int($index)) {
            $this->zIndex = $index;
        }

        return $this->setNotifier();
    }

    /**
     * If delay is set higher than 0 then the notification will auto-close after the delay period is up. Please keep in mind that delay uses milliseconds so 5000 is 5 seconds.
     * @param integer $time
     * @return object LaranotifyService
     */
    public function delay($time)
    {
        if (is_int($time)) {
            $this->delay = $time;
        }

        return $this->setNotifier();
    }

    /**
     * This is the amount of milliseconds removed from the notification at every timer milliseconds. So to make that a little less confusing every 1000 milliseconds there will be 1000 milliseconds removed from the remaining time of the notify delay. If this is set higher then delay the notification will not be removed until timer has run out.
     * @param integer $time
     * @return object LaranotifyService
     */
    public function timer($time)
    {
        if (is_int($time)) {
            $this->timer = $time;
        }

        return $this->setNotifier();
    }

    /**
     * Allows users to specify a custom position to the notification container element.
     * @param string $postion relative, fixed, absolute, static
     * @return LaranotifyService
     */
    public function position($postion)
    {
        $this->position = $postion;

        return $this->setNotifier();
    }

    /**
     * If this value is set to false it will hide the data-grow="dismiss" element.
     * Please keep in mind if you modify the template setting and do not include a data-notify="dismiss"
     * element even with this set to true, there will be no element for a user to click to close the notification.
     * @param boolean $bool
     * @return LaranotifyService
     */
    public function allowDismiss($bool)
    {
        if (is_bool($bool)) {
            $this->allowDismiss = json_encode($bool);
        }

        return $this->setNotifier();
    }

    /**
     * This controls where the notification will be placed.
     * @param string $from top, bottom
     * @param string $align left, right, center
     * @return LaranotifyService
     */
    public function placement($from, $align)
    {
        $this->placement['from'] = $from;
        $this->placement['align'] = $align;

        return $this->setNotifier();
    }

    /**
     * This controls where the notification will be placed. E.g [top] or [bottom] of your element
     * @param string $from
     * @return LaranotifyService
     */
    public function from($from)
    {
        $this->placement['from'] = $from;

        return $this->setNotifier();
    }

    /**
     * This controls where the notification will be placed. E.g [left], [right] or [center] of your element
     * @param string $align
     * @return LaranotifyService
     */
    public function align($align)
    {
        $this->placement['align'] = $align;

        return $this->setNotifier();
    }

    /**
     * This event fires when the notification is loading.
     * @param $jsFunction | The javascript function to return
     * @return LaranotifyService
     */
    public function onShow($jsFunction)
    {
        $this->onShow = $jsFunction;

        return $this->setNotifier();
    }

    /**
     * This event fires when the notification is fully loaded on screen.
     * @param $jsFunction | The javascript function to return
     * @return LaranotifyService
     */
    public function onShown($jsFunction = null)
    {
        $this->onShown = $jsFunction;

        return $this->setNotifier();
    }

    /**
     * This event is fired when the notification is closing.
     * @param $jsFunction | The javascript function to return
     * @return LaranotifyService
     */
    public function onClose($jsFunction = null)
    {
        $this->onClose = $jsFunction;

        return $this->setNotifier();
    }

    /**
     * This event is fired when the notification is closed.
     * @param $jsFunction | The javascript function to return
     * @return LaranotifyService
     */
    public function onClosed($jsFunction = null)
    {
        $this->onClosed = $jsFunction;

        return $this->setNotifier();
    }

    /**
     * Play a sound when the notification is shown and stop it when notification is closed.
     * You can pass a relative path or url. We will check if it's a url or not.
     * If you pass in path, we will assume it's coming from the public folder.
     * We are setting the relative path to start with public folder because it's recommended by Laravel that
     * all public files should come from the public folder.
     * @param string $path
     * @return $this
     */
    public function withSound($path)
    {
        $sound = url("public/" . $path);
        if (str_start('http://', $path) || str_start('https://', $path)) {
            $sound = $path;
        }

        $this->onShow("
            function() {
                laranotifySound =  new Audio('{$sound}');  
                laranotifySound.play(); 
            }
        ");
        $this->onClosed("
            function() { 
                laranotifySound.currentTime = 0;
                laranotifySound.src = '';  
            }
        ");

        return $this;
    }

    /**
     * This will set set the icon to the image provided as @var $imageUrl
     * If the image couldn't be found, we will revoke to a default icon [bell].
     * It's expected that your image must have equal dimensions i.e same width and height.
     * @param string $imageUrl
     * @return LaranotifyService
     */
    public function imageIcon($imageUrl = '')
    {
        $this->iconType = 'class';
        $this->icon = "sl sl-icon-bell ln-notify-icon $this->type";

        if ($imageUrl != '') {
            $this->iconType = 'img';
            $this->icon = $imageUrl;
        }

        return $this->setNotifier();
    }

    /**
     * This gives you control over the layout of the notification where you can build your own template and set
     * it at the config file include the package.
     * Provide the name of your template view file.
     * This will then be set as the active template.
     * @param string $template Your template view file
     * @return LaranotifyService
     */
    public function template($template)
    {
        $this->template = view($template, $this->data);

        return $this->setNotifier();
    }

    /**
     * This will use the default modal template located in the package views folder.
     * You can pass your own template if you don't want to use the default.
     * The template must be a modal wrapped in a div with the nodal-backdrop class and add show class
     * to the modal div. E.g <div class='modal-backdrop'><div class='modal show'></div></div>
     * The modal should also be set display block. You may take a look at the default template for guide.
     * @param array $data
     * @param string $template
     * @return LaranotifyService
     */
    public function asModal($template = '', $data = [])
    {
        $defaultTemplate = 'notify::modal';
        if ($template != '') {
            $defaultTemplate = $template;
        }

        if ($data != []) {
            $this->data = $data;
        }

        $this->applyDynamicModalPositions();
        $this->offset = 0;
        $this->delay = 0;
        $this->progress(false);
        $this->animate(['fadeIn', 'fadeOut']);
        $this->align('center');
        $this->template = view($defaultTemplate, $this->data);

        return $this->setNotifier();
    }

    private function updateModalElement($contents)
    {
        return $this->onShow("
            function() {
                {$contents}
            }
        ");
    }

    private function applyDynamicModalPositions()
    {
        $alignment = '';
        if (isset($this->placement['align'])) {
            $alignment = $this->placement['align'];
        }

        switch ($alignment)
        {
            case 'right':
                $this->updateModalElement("
                    $('.modal-dialog').addClass('right');
                ");
                break;

            case 'left':
                $this->updateModalElement("
                    $('.modal-dialog').addClass('left');
                ");
                break;

            case 'middle':
                $this->updateModalElement("
                    $('.modal-dialog').addClass('middle');
                ");
                break;

            case 'center':
                $this->updateModalElement("
                    $('.modal-dialog').addClass('center');
                ");
                break;

            case 'bottom-right':
                $this->updateModalElement("
                    $('.modal-dialog').removeClass('right').addClass('bottom right');
                ");
                break;

            case 'bottom-left':
                $this->updateModalElement("
                    $('.modal-dialog').removeClass('left').addClass('bottom left');
                ");
                break;

            case 'bottom-center':
                $this->updateModalElement("
                    $('.modal-dialog').addClass('bottom center');
                ");
                break;

            default:
                $this->updateModalElement("
                    $('.modal-dialog').addClass('center');
                ");

                break;
        }
    }

    /**
     * Update a particular element after the notification is displayed on screen.
     * You can even change the contents of notification.
     * This work with the DOM.
     * @param string $target_element
     * @param string $contents
     * @param int $interval
     * @return LaranotifyService
     */
    public function updateAfterInterval($target_element, $contents, $interval = 0)
    {
        if (is_int($interval) && $interval != 0) {
            $this->onShown("
                function() {
                    setInterval(function() {
                        $('{$target_element}').html('{$contents}');
                    }, {$interval});
                }
            ");
        }

        return $this->setNotifier();
    }

    /**
     * Get the currently set template.
     * This will return default template if none is set.
     * @return string
     */
    private function getTemplate()
    {
        $template = config('laranotify.template');
        if ($template == '' && $this->template == '') {
            return $this->defaultTemplate();
        }

        if ($this->template != '') {
            return ($this->template);
        }

        return view($template);
    }

    /**
     * If you want to pass any other data to your template view file.
     * The data parameter must be an array.
     * @param array $data
     * @return LaranotifyService
     */
    public function with($data = [])
    {
        $this->data = $data;

        return $this->setNotifier();
    }

    /**
     * Build template for notification.
     * You only need to pass the template content as the parameter.
     * Template can come from anywhere within your laravel project.
     * @param string $template
     * @return string, json
     */
    private function buildTemplate($template)
    {
        $this->template = $template;
        $offset = "{
            x: $this->offsetX,
            y: $this->offsetY
        }";

        if ($this->offsetX == 20 && $this->offsetY == 20 || $this->offset == 20) {
            $offset = $this->offset;
        }

        $this->placement['enter'] = 'right';

        return "{
            icon: '$this->icon',
            title: '$this->title',
            message: '$this->message',
            url: '$this->url',
            target: '$this->target'
        }, {
            element: '$this->element',
            position: $this->position,
            type: '$this->type',
            allow_dismiss: $this->allowDismiss,
            newest_on_top: $this->newestFirst,
            showProgressbar: $this->progress,
            placement: " . json_encode($this->placement) . ",
            offset: $offset,
            spacing: $this->spacing,
            z_index: $this->zIndex,
            mouse_over: '$this->mouseOver',
            delay: $this->delay,
            timer: $this->timer,
            url_target: '$this->urlTarget',
            animate: " . json_encode($this->animate) . ",
            onShow: $this->onShow,
            onShown: $this->onShown,
            onClose: $this->onClose,
            onClosed: $this->onClosed,
            icon_type: '$this->iconType',
            template: `$this->template`
        }
        ";
    }

    /**
     * The default Bootstrap 3 template
     * @return string
     */
    private function defaultTemplate()
    {
        return view('notify::default');
    }

    /**
     * Boot Laranotify package.
     * @return $this
     */
    private function setNotifier()
    {
        session()->flash(config('laranotify.container'),
            $this->buildTemplate(
                $this->getTemplate()
            )
        );

        return $this;
    }


}