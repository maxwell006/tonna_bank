@extends("{$activeTheme}layouts.auth")

@section('auth')
    <div class="custom--card mb-4">
        <div class="card-body">
            <form action="{{ route('user.fetch.statement') }}" method="get" class="row g-xxl-4 g-3 align-items-end">
                <div class="col-xl-4 col-sm-6">
                    <label class="form--label">@lang('Date')</label>
                    <input type="text" class="form--control form--control--sm date-picker" name="date" value="{{ request('date') }}" data-range="true" data-multiple-dates-separator=" - " data-language="en" placeholder="@lang('Start Date - End Date')" autocomplete="off">
                </div>
                <div class="col-xl-2 col-sm-6">
                    <label class="form--label">@lang('Transaction Type')</label>
                    <select class="form--control form--control--sm wide" name="trx_type">
                        <option selected value="">@lang('All')</option>
                        <option value="+" @selected(request('trx_type') == '+')>@lang('Plus')</option>
                        <option value="-" @selected(request('trx_type') == '-')>@lang('Minus')</option>
                    </select>
                </div>
                <div class="col-xl-2 col-sm-6">
                    <label class="form--label">@lang('From Amount')</label>
                    <input type="number" step="any" min="0" class="form--control form--control--sm" name="from_amount" placeholder="@lang('Enter Amount')" value="{{ request('from_amount') }}">
                </div>
                <div class="col-xl-2 col-sm-6">
                    <label class="form--label">@lang('To Amount')</label>
                    <input type="number" step="any" min="0" class="form--control form--control--sm" name="to_amount" placeholder="@lang('Enter Amount')" value="{{ request('to_amount') }}">
                </div>
                <div class="col-xl-2">
                    <button type="submit" class="btn btn--sm btn--base w-100">
                        <i class="ti ti-filter"></i> @lang('Filter')
                    </button>
                </div>
            </form>
        </div>
    </div>

    @isset($transactions)
        <div class="custom--card border-0 h-auto">
            <div class="card-header bg--base">
                <div class="d-flex justify-content-between align-items-center gap-2">
                    <h3 class="title text-white">@lang('Financial Overview')</h3>

                    @if($transactions->count())
                        <form action="{{ route('user.export.statement') }}" method="post">
                            @csrf
                            <input type="hidden" name="date" value="{{ request('date') }}">
                            <button type="submit" class="btn btn--sm btn--light py-1">
                                @lang('Export')
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless table--striped table--responsive--md top-rounded-0">
                    <thead>
                        <tr>
                            <th>@lang('TRX')</th>
                            <th>@lang('Initiated')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Post Balance')</th>
                            <th>@lang('Details')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->trx }}</td>
                                <td>
                                    <span>
                                        <span class="d-block">{{ showDateTime($transaction->created_at) }}</span>
                                        <span class="d-block">{{ diffForHumans($transaction->created_at) }}</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="@if ($transaction->trx_type == '+') text--success @else text--danger @endif">
                                        {{ $transaction->trx_type == '+' ? '+' : '-' }} {{ showAmount($transaction->amount) . ' ' . __($setting->site_cur) }}
                                    </span>
                                </td>
                                <td>{{ showAmount($transaction->post_balance) . ' ' . __($setting->site_cur) }}</td>
                                <td>{{ __($transaction->details) }}</td>
                            </tr>
                        @empty
                            @include('partials.noData')
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($transactions->hasPages())
            {{ paginateLinks($transactions) }}
        @endif
    @endisset
@endsection

@push('page-style-lib')
    <link rel="stylesheet" href="{{ asset('assets/universal/css/datepicker.css') }}">
@endpush

@push('page-script-lib')
    <script src="{{ asset('assets/universal/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/universal/js/datepicker.en.js') }}"></script>
@endpush

@push('page-script')
    <script>
        (function ($) {
            'use strict'

            $(function () {
                let datePicker = $('.date-picker')

                datePicker.on('input keyup keydown keypress', function () {
                    return false
                })

                datePicker.datepicker()
            })
        })(jQuery)
    </script>
@endpush
