## User Model Activity

<img src="https://banners.beyondco.de/User%20Model%20Activity.png?theme=dark&packageManager=composer+require&packageName=hanifhefaz%2Fuser-model-activity&pattern=intersectingCircles&style=style_1&description=Track+models%27+created%2C+updated+and+deleted+activity&md=1&showWatermark=1&fontSize=150px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg&widths=400&heights=400">

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
- [Conclusion](#conclusion)
- [Contributors](#contributors)
- [Known Issues and future plans](#issues-plans)

<a name="introduction"></a>
## Introduction

Introducing the User Model Activity Package: Effortlessly Track Changes in Your Models

Have you ever found yourself in need of a simple yet effective way to track and log changes made to your Laravel models? Look no further! We are thrilled to present our User Model Activity package, designed to save the logs of model events such as creation, update, and deletion into a convenient log file. With this package, monitoring and auditing changes in your application's models has never been easier.

<a name="installation"></a>
## Installation

You can install the package with Composer.

```bash
composer require hanifhefaz/user-model-activity
```

After installation run the following command to publish the necessary assets and files:

```shell
php artisan vendor:publish --provider="Hanifhefaz\UserModelActivity\UserModelActivityServiceProvider"
```

That's it. You have successfully installed and published the required files and assets of the package.

<a name="usage"></a>
## Usage

Once you have installed and configured the package, you can start using it to track changes in your models. Follow this step-by-step guide to get started:

- Logging File Configuration

    First things is first! Go to your ```config/logging.php``` and add the following to the channels array:

    ```php
    /*
    * Logging.php
    */
        'channels' => [
            // existing code ...

            // 'stack' => [
            //     'driver' => 'stack',
            //     'channels' => ['single'],
            //     'ignore_exceptions' => false,
            // ],

            // ...

            'user-model-activity' => [
                'driver' => 'single',
                'path' => storage_path('logs/user-model-activity.log'),
                'level' => 'debug',
            ],
        ]
    ```

    Now, you can use the ```UserModelActivityLogger``` trait inside the model and all the logs will be tracked.

    ```php
    <?php

    namespace App\Models;

    use Hanifhefaz\UserModelActivity\Traits\UserModelActivityLogger;
    use Illuminate\Database\Eloquent\Model;

    class Post extends Model
    {
        use UserModelActivityLogger;
        protected $fillable = ['title', 'content'];
    }
    ```

    That is it. Now just visit ```user-model-activity``` URL and select the file where you saved the logs. You will see all the logs.


    ![View](/images/view.png "Logs View")

<a name="conclusion"></a>
## Conclusion

The User Model Activity package offers a straightforward and efficient solution for tracking changes made to your Laravel models. It simplifies the process of monitoring, auditing, and debugging model-related changes. Enhance your application's maintainability and gain valuable insights into your data with the User Model Activity package.

<a name="contributors"></a>
## Contributions

Contributions are most welcome! Please pick one of the known issues and future plans or implement your own idea to help the package grow.

Current Contributers: [Contributors](https://github.com/hanifhefaz/user-model-activity/graphs/contributors).

<a href="https://github.com/hanifhefaz/user-model-activity/graphs/contributors"></a>
<table>
  <tr>
    <td align="center"><a href="https://github.com/hanifhefaz/"><img src="https://avatars3.githubusercontent.com/hanifhefaz?v=4?s=100" width="100px;" alt=""/><br /><sub><b>Hanif Hefaz</b></sub></a></td>
  </tr>
</table>

<a name="issues-plans"></a>
## Known issues and future plans

- To further enhance the package, we plan to bring some changes in the log views. currently its not optimized.

- A better approach to integrate user's details as well to the log. currently it will save details of model, and if your model has created_by it will be logged, but we need a better approach for this.

- Parsing of the logs in a better way.

- The trait is not working in spatie's Role and Permission models if they are extended from parent model such as below:

```php

<?php

namespace App\Models;

use Hanifhefaz\UserModelActivity\Traits\UserModelActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ParentPermission;

class Permission extends ParentPermission
{
    use HasFactory;
    use UserModelActivityLogger;

    protected $fillable = [
        'id','name','created_at','updated_at'
    ];

}
```

If you found any issue, please post it to issues section.
