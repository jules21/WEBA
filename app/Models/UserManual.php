<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserManual
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $for_admin 0: for user, 1: for admin
 * @method static \Database\Factories\UserManualFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereForAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereUpdatedAt($value)
 * @property string|null $file_kn
 * @method static \Illuminate\Database\Eloquent\Builder|UserManual whereFileKn($value)
 * @mixin \Eloquent
 */
class UserManual extends Model
{
    use HasFactory;

    const USER_MANUALS_PATH = 'user_manuals';
}
