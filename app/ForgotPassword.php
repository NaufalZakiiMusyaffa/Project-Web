<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    protected $table = 'forgot_password';
    protected $fillable = ['user_id', 'verifikasi_kode', 'is_used', 'expired_at'];

    /**
     * Get the user that owns the ForgotPassword
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
