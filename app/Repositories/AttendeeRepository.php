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

namespace Jano\Repositories;

use Illuminate\Support\Collection;
use Jano\Contracts\AttendeeContract;
use Jano\Contracts\TicketContract;
use Jano\Events\AttendeeDestroyed;
use Jano\Events\AttendeesCreated;
use Jano\Models\Attendee;
use Jano\Models\Ticket;
use Jano\Models\User;

class AttendeeRepository implements AttendeeContract
{
    /**
     * @inheritdoc
     */
    public function store(
        TicketContract $contract,
        User $user,
        Collection $attendees
    ) {
        $tickets = Ticket::all();

        $amount = 0;

        foreach ($tickets as $ticket) {
            $amount += $contract->getPrice($ticket, $user) *
                $attendees->where('ticket_id', $ticket['id'])->count();
        }

        $account = $user->account();
        $account->amount_due += $amount;
        $account->save();

        $return = collect();

        foreach ($attendees as $attendee) {
            $ticket = $tickets->where('id', $attendee['ticket_id'])->first();
            $return->push($contract->reserve($ticket, $user, $attendee));
        }

        event(new AttendeesCreated($user, $return));

        return $return;
    }

    /**
     * @inheritdoc
     */
    public function destroy($attendee)
    {
        if (is_a($attendee, Collection::class)) {
            $attendee->each(function ($item) {
                $item->delete();
            });
        } else {
            $attendee->delete();
        }

        event(new AttendeeDestroyed($attendee));
    }
}