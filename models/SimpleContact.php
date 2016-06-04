<?php namespace Zainab\SimpleContact\Models;

use Model;

/**
 * Model
 */
class SimpleContact extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = true;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'zainab_simplecontact_contact';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_new' => 'boolean',
        'is_replied' => 'boolean',
    ];
}