<?php
namespace App\Models;

class Projects extends \Eloquent
{
    protected $table = 'projects';

    protected $guarded = array();

    public static $rules = array();

    protected $fillable = array('id', 'project_name');

    public $timestamps = false;

}
