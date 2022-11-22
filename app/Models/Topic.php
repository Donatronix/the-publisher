<?php

namespace App\Models;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Class Topic.
 *
 * @package namespace App\Models;
 */
class Topic extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic',
        'slug',
    ];

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'subscriber_topic');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        self::creating(static function ($model) {
            $model->slug = Str::slug($model->topic);
        });
    }
}
