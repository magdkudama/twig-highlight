Twig highlight extension
========================

Simple extension to highlight code (it could be done using a filter or a function, of course... but why not with a custom tag? :D).

Installing
----------

Add the dependency to the ```composer.json``` file:

```json
{
    "require": {
        "magdkudama/twig-highlight": "dev-master"
    }
}
```

A minimum working version:

```php
<?php

use MagdKudama\Highlight\Extension;
use MagdKudama\Highlight\Engine\PygmentsRenderer;

$twig = // Initialize Twig!

$twig->addExtension(new Extension(new PygmentsRenderer()));
```

Usage
-----

```jinja
{% highlight 'php' with { theme: 'vim' } ignore_errors %}
    <?php

    echo "Hello World!";

    for ($i = 0; $i < 10; $i++) {
        echo $i;
    }
{% endhighlight %}

{% highlight 'php' with { theme: 'vim' } %}
    ... code here ...
{% endhighlight %}

{% highlight 'php' %}
    ... code here ...
{% endhighlight %}

{% highlight 'php' ignore_errors %}
    ... code here ...
{% endhighlight %}
```

The language (php in this case) is required, but the parameters (```with {}``` and ```ignore_errors``` are optional).

If you don't want to use Pygments, you can create your own engine by implementing the ```MagdKudama\Highlight\Engine``` interface.

TODO
----

* Support... Maybe Geshi?
* Default content when there's an error... Maybe!

License
-------

**Twig highlight extension** is licensed under the [MIT license](LICENSE).

Contributors
------------

- Magd Kudama [magdkudama]

