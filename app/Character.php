<?php

namespace App;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\DB;

class Character extends Model
{
    use Translatable;

    const Author        = "Author";
    const Translator    = "Translator";
    const Investigator  = "Investigator";
    const Publisher     = "Publisher";

    public $translatedAttributes = ['name'];
    protected  $fillable = ['name' , 'type'];


    public static function getEnumValues(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM characters WHERE Field = "type"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
