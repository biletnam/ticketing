<tr>
    <td>
        <strong>{{ $ticket->name }}</strong><br />
        {{ \Jano\Repositories\HelperRepository::getUserPrice($ticket->price, Auth::user()) }}
    </td>
    <td>
        @if (!$ticket->soldout)
            <div class="input-group">
                <span class="input-group-label">
                    <button class="icon clear button" href="#" data-quantity="plus">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </span>
                <input type="number" name="tickets[{{ $ticket->id }}]" id="tickets" value="0">
                <span class="input-group-label">
                    <button class="icon clear button" href="#" data-quantity="minus">
                        <i class="fa fa-minus" aria-hidden="true"></i>
                    </button>
                </span>
            </div>
        @else
            <span class="text-alert">{{ __('system.soldout') }}</span>
        @endif
    </td>
</tr>