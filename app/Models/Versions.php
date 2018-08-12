<?php
namespace App\Models;

class Versions extends \Eloquent
{
    protected $table = 'versions';

    protected $guarded = array();

    public static $rules = array();

    protected $fillable = array('id', 'project_id', 'version');

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo('App\Models\Projects', 'project_id');
    }

}
