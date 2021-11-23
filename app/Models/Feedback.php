<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'description',
        'worklog_id'];

    /**
     * Get the worklog for the feedbacks
     *
     * @return BelongsTo
     */
    public function worklog(): BelongsTo
    {
        return $this->belongsTo(Worklog::class, 'worklog_id', 'id');
    }
}
