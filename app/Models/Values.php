<?php
namespace App\Models;

class Values extends \Eloquent
{
    protected $table = 'values';

    protected $guarded = array();

    public static $rules = array();

    protected $fillable = array('id', 'project_id', 'lang', 'version', 'key', 'value');

    public $timestamps = false;

    public static function valueLang()
    {
       return  array(
            'tr' => 'Türkçe',
            'en' => 'İngilizce',
            'de' => 'Almanca',
            'fr' => 'Fransızca',
            'es' => 'İspanyolca',
            'it' => 'İtalyanca',
            'ru' => 'Rusça',
            'az' => 'Azerice',
            'bg' => 'Bulgarca',
            'hy' => 'Ermenice',
            'fi' => 'Fince',
            'ka' => 'Gürcüce',
            'ro' => 'Romence',
            'uk' => 'Ukraynaca',
            'sr' => 'Sırpça',
            'sk' => 'Slovakça',
            'so' => 'Somalice',
            'uz' => 'Özbekçe',
            'pl' => 'Lehçe',
            'sv' => 'İsveççe'
        );

    }

    public function project()
    {
        return $this->belongsTo('App\Models\Projects', 'project_id');
    }

    public function version()
    {
        return $this->belongsTo('App\Models\Versions', 'version_id');
    }

}
