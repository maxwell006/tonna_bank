@extends("{$activeTheme}layouts.auth")

@section('auth')
    <div class="custom--card mb-4">
        <div class="card-body">
            <form action="" method="get" class="row g-xxl-4 g-3 align-items-end">
                <div class="col-xl-5 col-lg-4 col-sm-4">
                    <label class="form--label">@lang('Transaction Number')</label>
                    <input type="text" class="form--control form--control--sm" name="search" value="{{ request('search') }}">
                </div>
                <div class="col-xl-2 col-lg-3 col-sm-4">
                    <label class="form--label">@lang('Type')</label>
                    <select class="form--control form--control--sm wide" name="trx_type">
                        <option selected value="">@lang('All')</option>
                        <option value="+" @selected(request('trx_type') == '+')>@lang('Plus')</option>
                        <option value="-" @selected(request('trx_type') == '-')>@lang('Minus')</option>
                    </select>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-4">
                    <label class="form--label">@lang('Remark')</label>
                    <select class="form--control form--control--sm form-select select-2" name="remark">
                        <option value="">@lang('Any')</option>

                        @foreach($remarks as $remark)
                            <option value="{{ $remark->remark }}" @selected(request('remark') == $remark->remark)>
                                {{ __(keyToTitle($remark->remark)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-2">
                    <button type="submit" class="btn btn--sm btn--base w-100">
                        <i class="ti ti-search"></i> @lang('Search')
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless table--striped table--responsive--md">
            <thead>
                <tr>
                    <th>@lang('S.N.')</th>
                    <th>@lang('Trx No.')</th>
                    <th>@lang('Transacted')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Post Balance')</th>
                    <th>@lang('Details')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td>{{ $transactions->firstItem() + $loop->index }}</td>
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
                        <td>
                            {{ showAmount($transaction->post_balance) . ' ' . __($setting->site_cur) }}
                        </td>
                        <td>
                            <span title="{{ $transaction->details }}">
                                {{ __(strLimit($transaction->details, 35)) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    @include('partials.noData')
                @endforelse
            </tbody>
        </table>
    </div>

    @if($transactions->hasPages())
        {{ paginateLinks($transactions) }}
    @endif
@endsection

@push('page-style-lib')
    <link rel="stylesheet" href="{{ asset('assets/universal/css/select2.min.css') }}">
@endpush

@push('page-script-lib')
    <script src="{{ asset('assets/universal/js/select2.min.js') }}"></script>
@endpush
