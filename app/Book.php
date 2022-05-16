<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use PharIo\Manifest\Author;

class Book extends Model implements TranslatableContract
{


    use Translatable;

    public $translatedAttributes = [
        'name' ,
        'binding_type' ,
        'paper_type',
        'printing_colors',
        'about',
        'submit'
    ];

    protected $casts = [
        'author' => 'array',
        'publisher' => 'array',
        'translator' => 'array',
        'investigator' => 'array',
        'images' => 'array',
    ];

    protected $appends = [ 'is_fav','edition','classification','image_path' , 'author_name' , 'publisher_name' , 'translator_name' , 'investigator_name'];


    protected $fillable = [
        'name' ,
        'images',
        'binding_type' ,
        'paper_type',
        'printing_colors',
        'about',
        'number_pages',
        'year_release',
        'size',
        'weight',
        'price_usd_after_discount',
        'price_le_after_discount',
        'ISBN',
        'code',
        'author',
        'publisher',
        'translator',
        'investigator',
        'edition_id',
        'classification_id',
        'slug'
         ];

    public function getClassificationAttribute(){
        if ($this->classification_id){
            $c =  Classification::where('id',$this->classification_id)->get()->pluck('classification')->toArray();
            return $c[0];
        }
        return nul;
    }

//    public function getTopicAttribute(){
//        if ($this->topic_id){
//            $c =  Topic::where('id',$this->topic_id)->get()->pluck('topic')->toArray();
//            return $c[0];
//        }
//        return null;
//    }

    public function getEditionAttribute(){
        if ($this->edition_id){
            $c =  Edition::where('id',$this->edition_id)->get()->pluck('edition')->toArray();
            return $c[0];
        }
        return null;
    }
    public function getAuthorNameAttribute(){
        if ($this->author != null ){
            $author = Character::whereIn('id',$this->author)->where('type' , Character::Author)->get()->pluck('name')->toArray();
            return implode(' , ' , $author);
        }
        return null;
    }

    public function getPublisherNameAttribute(){
        if ($this->publisher){
            $publisher = Character::whereIn('id',$this->publisher)->where('type' , Character::Publisher)->get()->pluck('name')->toArray();
            return implode(' , ' , $publisher);
        }
        return null;
    }

    public function getTranslatorNameAttribute(){
        if ($this->translator){
            $translator = Character::whereIn('id',$this->translator)->where('type' , Character::Translator)->get()->pluck('name')->toArray();
            return implode(' , ' , $translator);
        }
        return null;
    }

    public function getInvestigatorNameAttribute(){
        if ($this->investigator){
            $investigator = Character::whereIn('id',$this->investigator)->where('type' , Character::Investigator)->get()->pluck('name')->toArray();
            return implode(' , ' , $investigator);
        }
    }

    public function getIsFavAttribute(){
        if (auth()->user()){
            return in_array( auth()->user('web')->id , $this->favorite->pluck('id')->toArray());
        }
        return false;
    }

    public function getImagePathAttribute(){
        $images = [];
        if (is_array($this->images) && $this->images ){
            foreach ($this->images as $img){
                array_push($images , asset( "uploads/" .$img));
            }
            return $images;
        }
        return $this->images;

    }


    public function favorite()
    {
        return $this->belongsToMany(User::class , 'favorites' ,  'book_id' , 'user_id' , 'id' , 'id');
    }

    public function cart()
    {
        return $this->belongsToMany(User::class , 'cart' )->withPivot('quantity');
    }
}
