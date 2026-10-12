<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HiddenPartnerCourse extends Model
{
    protected $fillable = ['slug'];

    /**
     * Slugs the admin has hidden from the public Courses page. Returns an
     * empty list (rather than erroring) if the table doesn't exist yet, so a
     * deploy that lands before `php artisan migrate` can't take the public
     * page down.
     *
     * @return array<int, string>
     */
    public static function slugs(): array
    {
        return rescue(fn () => static::pluck('slug')->all(), [], false);
    }
}
