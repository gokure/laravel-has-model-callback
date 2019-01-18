# Laravel Has Model Callbacks

Callbacks of model events, trigger around with create/update/delete or restore.

Perform sequence will stopped when before* events return `false`.

| For creates    | For updates       | For deletes       | For restores      |
|----------------|-------------------|-------------------|-------------------|
| beforeSave()   | beforeSave()      | beforeDelete()    | beforeRestore()   |
| beforeCreate() | beforeUpdate()    | *delete()         | beforeSave()      |
| *insert()      | *update()         | afterDelete()     | beforeUpdate()    |
| afterCreate()  | afterUpdate()     |                   | *update()         |
| afterSave()    | afterSave()       |                   | afterUpdate()     |
|                |                   |                   | afterSave()       |
|                |                   |                   | afterRestore()    |

## Installation

Install the ``gokure/laravel-has-model-callback`` package:

```bash
$ composer require gokure/laravel-has-model-callback
```

Change your models:

### Before

```php
// app/YourModel.php

protected static function boot()
{
    parent::boot();
    static::saving(function ($model) {
        $model->full_name = $model->first_name . ' ' . $model->last_name;
    });
}
```

### After

```php
// app/YourModel.php

use Gokure\Eloquent\Concerns\HasModelCallback::class;

protected function beforeSave()
{
    $this->full_name = $this->first_name . ' ' . $this->last_name;
}
```
