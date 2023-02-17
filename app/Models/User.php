<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'social_security',
        'present_address',
        'present_state',
        'present_city',
        'present_zip',
        'present_phone',
        /* 'permanent_address',
        'permanent_state',
        'permanent_city',
        'permanent_zip',
        'permanent_phone', */
        'email',
        'referred_by',
        'position',
        'start_date',
        'employed',
        'applied',
        'where_apply',
        'when_apply',
        'high_school',
        'high_school_graduate',
        'high_school_subjects_studied',
        'college',
        'college_graduate',
        'college_subjects_studied',
        'trade_school',
        'trade_school_graduate',
        'trade_school_subjects_studied',
        'special_study',
        'special_training',
        'special_skills',
        'military',
        'rank',
        'year_1',
        'month_1',
        'name_1',
        'phone_1',
        'position_1',
        'reason_1',
        'year_2',
        'month_2',
        'name_2',
        'phone_2',
        'position_2',
        'reason_2',
        'year_3',
        'month_3',
        'name_3',
        'phone_3',
        'position_3',
        'reason_3',
        'year_4',
        'month_4',
        'name_4',
        'phone_4',
        'position_4',
        'reason_4',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the state that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /* public function presentStateRelation(): BelongsTo
    {
        return $this->belongsTo(State::class, 'present_state');
    } */


    /**
     * Get the city that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /* public function presentCityRelation(): BelongsTo
    {
        return $this->belongsTo(City::class, 'present_city');
    } */

    /**
     * Get the state that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /* public function permanentStateRelation(): BelongsTo
    {
        return $this->belongsTo(State::class, 'permanent_state');
    } */


    /**
     * Get the city that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /* public function permanentCityRelation(): BelongsTo
    {
        return $this->belongsTo(City::class, 'permanent_city');
    } */


    /**
     * Get the company that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
