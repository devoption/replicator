<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

#[Fillable(['first_name', 'last_name', 'email', 'password', 'theme_preferences'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasRolesAndAbilities, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'theme_preferences' => 'array',
        ];
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes): string => trim(sprintf(
                '%s %s',
                $attributes['first_name'] ?? '',
                $attributes['last_name'] ?? '',
            )),
            set: function (string $value): array {
                $parts = preg_split('/\s+/', trim($value), 2) ?: [];

                return [
                    'first_name' => $parts[0] ?? '',
                    'last_name' => $parts[1] ?? '',
                ];
            },
        );
    }

    protected function initials(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes): string {
                $firstName = $attributes['first_name'] ?? '';
                $lastName = $attributes['last_name'] ?? '';
                $initials = mb_strtoupper(mb_substr((string) $firstName, 0, 1).mb_substr((string) $lastName, 0, 1));

                return $initials !== '' ? $initials : '?';
            },
        );
    }

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }
}
