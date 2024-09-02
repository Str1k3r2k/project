<?php

namespace App\Policies;

use App\Models\job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy{
    public function edit(User $user, job $job): bool{
        return $job->employer->user->is($user);
    }
}
