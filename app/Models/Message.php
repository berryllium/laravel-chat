<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function scopeMore(Builder $builder, $from, $to, $message_id = false, $limit = 5) {
        $builder
            ->where(function ($query) use ($from, $to) {
                $query->where('from', '=', $from)
                    ->orWhere('to', '=', $from);
                })
            ->where(function ($query) use ($from, $to) {
                $query->where('from', '=', $to)
                    ->orWhere('to', '=', $to);
                })
            ->when(
            $message_id ?? false,
            fn ($query, $value) => $query->where('id', '<', $value)
            )
            ->latest()
            ->limit($limit);

        return $builder->get();
    }
}
