<h2 align="center">
   Laravel Accessory
</h2>

## Introduction
Laravel Accessory provides a collection of helper methods and traits for supercharging your Laravel Applications.

## License
Laravel Accessory is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Installation
This packages works for Laravel versions 5.* only.

Install Laravel Accessory as you would with any other dependency managed by Composer:

 ```bash
 $ composer require percymamedy/laravel-accessory
 ```

### Configuration
> If you are using Laravel >= 5.5, you can skip service registration 
> and aliases registration thanks to Laravel auto package discovery 
> feature.

### Usage

Let's take a look at the available features and helpers provided by Laravel Accessory.

### Available Traits

Laravel Accessory provides you with useful traits that can be easily applied to your classes.

#### ```Makable```

The ```Makable``` trait simply adds a ```static make()``` method to your classes. This allows you to fluently create new
instances of a class without using the ```new``` keyword everytime. This is simply sugar coating for newing up objects.

Consider the following Mail class with the ```Makable``` trait applied to it :

```php
<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Accessory\Support\Makable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Makable, Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //
    }
}
```

You may now new up the Mail class using the ```static make()``` method directly on the class like so :

```php
<?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function ship(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Ship order...

        $message = OrderShipped::make($order);

        Mail::to($request->user())->send($message);
    }
}
```

Good use for the ```Makable``` trait is within ```Jobs```, ```Mailables```, ```Events``` and ```Notifications```. You can of course use it on any class that you desire.

#### ```Dispatchable```

The ```Dispatchable`` trait extends the ```Illuminate\Foundation\Bus\Dispatchable``` but adds a ```static dispatchNow()``` method which  allows you to dispatch ```Jobs``` to its appropriate handler in the current process.

Consider the following Job class with the ```Dispatchable``` trait applied to it :

```php
<?php

namespace App\Jobs;

use App\Podcast;
use App\AudioProcessor;
use Illuminate\Bus\Queueable;
use Accessory\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProcessPodcast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $podcast;

    /**
     * Create a new job instance.
     *
     * @param  Podcast  $podcast
     * @return void
     */
    public function __construct(Podcast $podcast)
    {
        $this->podcast = $podcast;
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle(AudioProcessor $processor)
    {
        // Process uploaded podcast...
    }
}
```

You may now dispatch the Job immediately using the ```static dispatchNow()``` method directly on the class like so :

```php
<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPodcast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PodcastController extends Controller
{
    /**
     * Store a new podcast.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Create podcast...

        ProcessPodcast::dispatchNow($podcast);
    }
}
```
