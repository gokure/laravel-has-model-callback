<?php

namespace Gokure\Eloquent\Concerns;

trait HasModelCallback
{
    /**
     * Register the bootable traits on the model
     */
    protected static function bootHasModelCallbacks()
    {
        $hooks = array(
            'saving'    => 'beforeSave',
            'creating'  => 'beforeCreate',
            'updating'  => 'beforeUpdate',
            'deleting'  => 'beforeDelete',
            'restoring' => 'beforeRestore',
            'saved'     => 'afterSave',
            'created'   => 'afterCreate',
            'updated'   => 'afterUpdate',
            'deleted'   => 'afterDelete',
            'restored'  => 'afterRestore',
        );

        $class = static::class;
        foreach ($hooks as $hook => $method) {
            if (method_exists($class, $hook)) {
                static::$hook(function ($model) use ($method) { // static::saving(function ($model) use ($method) {
                    return $model->$method();                   //     return $model->beforeSave();
                });                                             // });
            }
        }
    }

    /**
     * Callbacks of model events, trigger around with create/update/delete or restore.
     *
     * Perform sequence will stopped when before* events return `false`.
     *
     * | For creates    | For updates       | For deletes       | For restores      |
     * |----------------|-------------------|-------------------|-------------------|
     * | beforeSave()   | beforeSave()      | beforeDelete()    | beforeRestore()   |
     * | beforeCreate() | beforeUpdate()    | *delete()         | beforeSave()      |
     * | *insert()      | *update()         | afterDelete()     | beforeUpdate()    |
     * | afterCreate()  | afterUpdate()     |                   | *update()         |
     * | afterSave()    | afterSave()       |                   | afterUpdate()     |
     * |                |                   |                   | afterSave()       |
     * |                |                   |                   | afterRestore()    |
     *
     * To call Builder method
     */
    protected function beforeSave() {}
    protected function beforeCreate() {}
    protected function beforeUpdate() {}
    protected function beforeDelete() {}
    protected function beforeRestore() {}
    protected function afterSave() {}
    protected function afterCreate() {}
    protected function afterUpdate() {}
    protected function afterDelete() {}
    protected function afterRestore() {}
}
