<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
// сущность класа Posts будет ссылаться на таблицу posts в базе данных
class News extends Model {
    // запрещает изменение колонок
    protected $guarded = [];
    // возвращает сущность пользователя, который является автором этого поста
    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}