@extends('layouts.app')

@section('title', __('system.home'))

@section('content')
    @include('partials.error')
    <div class="table-scroll">
        <form method="GET" action="{{ route('orders.create') }}" id="form" data-abide novalidate>
            {{ csrf_field() }}
            <table class="hover tickets">
                <thead>
                    <tr>
                        <th>{{ __('system.type') }}</th>
                        <th>{{ __('system.price') }}</th>
                        <th>{{ __('system.quantity') }}</th>
                    </tr>
                </thead>
                @each('ticket', $tickets, 'ticket', 'ticket-empty')
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right">
                            <button class="button button-primary" name="submit" type="submit">
                                {{ __('system.next') }}
                            </button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){8
            $('[data-quantity="plus"]').click(function(e){
                e.preventDefault();
                var currentVal = parseInt($(this).closest('.input-group').find('input').val());
                console.log(currentVal);
                if (!isNaN(currentVal)) {
                    $(this).closest('.input-group').find('input').val(currentVal + 1);
                } else {
                    $(this).closest('.input-group').find('input').val(0);
                }
            });
            $('[data-quantity="minus"]').click(function(e) {
                e.preventDefault();
                var currentVal = parseInt($(this).closest('input').val());
                if (!isNaN(currentVal) && currentVal > 0) {
                    $(this).closest('.input-group').find('input').val(currentVal - 1);
                } else {
                    $(this).closest('.input-group').find('input').val(0);
                }
            });
        });
    </script>
@endpush