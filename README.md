# Laravel Has Model Callbacks

The `gokure/laravel-has-model-callback` package provides easy to use class methods to hook the model events in your app. Methods are depends on `Illuminate\Database\Eloquent\Concerns\HasEvents` trait.

A demo of how you can use it:

before

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

after

```php
// app/YourModel.php

use Gokure\Eloquent\Concerns\HasModelCallbacks::class;

protected function beforeSave()
{
    $this->full_name = $this->first_name . ' ' . $this->last_name;
}
```

The following methods are supports:

| For creates    | For updates       | For deletes       | For restores      |
|----------------|-------------------|-------------------|-------------------|
| beforeSave()   | beforeSave()      | beforeDelete()    | beforeRestore()   |
| beforeCreate() | beforeUpdate()    | *delete()         | beforeSave()      |
| *insert()      | *update()         | afterDelete()     | beforeUpdate()    |
| afterCreate()  | afterUpdate()     |                   | *update()         |
| afterSave()    | afterSave()       |                   | afterUpdate()     |
|                |                   |                   | afterSave()       |
|                |                   |                   | afterRestore()    |

Perform sequence will stopped when `before*` methods return `false`.

## Installation

Install the `gokure/laravel-has-model-callback` package:

```bash
$ composer require gokure/laravel-has-model-callback
```

Add `use Gokure\Eloquent\Concerns\HasModelCallbacks::class;` to your model and define methods if you want.
