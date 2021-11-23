<?php

namespace App\Models;

use App\Constants\DbTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $table = DbTables::FEEDBACKS;

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
