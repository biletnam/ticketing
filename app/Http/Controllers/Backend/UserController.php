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

namespace Jano\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Jano\Contracts\UserContract;
use Jano\Http\Controllers\Controller;
use Jano\Http\Traits\RendersAjaxView;
use Jano\Models\User;

class UserController extends Controller
{
    use RendersAjaxView;

    /**
     * @var \Jano\Contracts\UserContract
     */
    protected $contract;

    /**
     * AccountController constructor.
     *
     * @param \Jano\Contracts\UserContract $contract
     */
    public function __construct(UserContract $contract)
    {
        $this->middleware(['auth', 'staff']);
        $this->contract = $contract;
    }

    /**
     * Renders the index page for accounts.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->ajaxView(
            $request,
            'backend.users.index',
            $this->contract->search($request->get('q'))
        );
    }

    /**
     * Renders the user information page.
     *
     * @param \Jano\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.users.show', [
            'user' => $user,
            'account' => $user->account()->first()
        ]);
    }
}