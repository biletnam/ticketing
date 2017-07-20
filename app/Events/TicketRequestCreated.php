<?php
/**
 * Jano Ticketing System
 * Copyright (C) 2016-2017 Andrew Ying
 *
 * This file is part of Jano Ticketing System.
 *
 * Jano Ticketing System is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License v3.0 as
 * published by the Free Software Foundation.
 *
 * Jano Ticketing System is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Jano\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Jano\Models\TicketRequest;
use Jano\Models\User;

class TicketRequestCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \Jano\Models\User
     */
    protected $user;

    /**
     * @var \Jano\Models\TicketRequest
     */
    protected $request;

    /**
     * Create a new event instance.
     *
     * @param \Jano\Models\User $user
     * @param \Jano\Models\TicketRequest $request
     */
    public function __construct(User $user, TicketRequest $request)
    {
        $this->user = $user;
        $this->request = $request;
    }
}
