<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 */
class TicketResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'response'
    ];

    /**
     * @return BelongsToMany
     */
    public function ticket(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class, 'ticket_response', 'ticket_id', 'ticket_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
