<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 *
 */
class TicketResponse extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function ticket(): BelongsToMany
    {
        return $this->belongsToMany(Ticket::class, 'ticket_response', 'ticket_id', 'ticket_id');
    }

    /**
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ticket_response', 'user_id', 'user_id');
    }
}
