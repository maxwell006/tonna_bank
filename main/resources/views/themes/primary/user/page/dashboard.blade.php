@extends("{$activeTheme}layouts.auth")

@php $userDashboardContent = getSiteData('user_dashboard.content', true) @endphp

@section('auth')
    <div class="row gy-5">
        @if($user->kc == ManageStatus::UNVERIFIED || $user->kc == ManageStatus::PENDING)
            <div class="col-12">
                <div class="alert alert--warning" role="alert">
                    @if($user->kc == ManageStatus::UNVERIFIED)
                        <span class="alert__title">{{ __($kycContent?->data_info->verification_required_heading) }}</span>
                        <p class="alert__desc">{{ __($kycContent?->data_info->verification_required_details) }} <a href="{{ route('user.kyc.form') }}" class="alert__link">@lang('Click here')</a> @lang('to verify.')</p>
                    @elseif($user->kc == ManageStatus::PENDING)
                        <span class="alert__title">{{ __($kycContent?->data_info->verification_pending_heading) }}</span>
                        <p class="alert__desc">{{ __($kycContent?->data_info->verification_pending_details) }} <a href="{{ route('user.kyc.data') }}" class="alert__link">@lang('See')</a> @lang('kyc data.')</p>
                    @endif
                </div>
            </div>
        @endif

        <div class="col-12">
            <label class="form--label">@lang('Referral Link')</label>
            <div class="refer-link">
                <div class="input--group bg-light mb-4">
                    <input type="text" class="form--control" id="referLink" value="{{ $referURL }}" readonly>
                    <button type="button" class="btn btn--base refer-link__copy px-3">
                        <i class="ti ti-copy"></i>
                    </button>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-xxxl-6">
                    <a href="{{ route('user.deposit') }}" class="dashboard-card balance-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->first_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__txt" data-mask-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->vector_image, '675x110') }}">
                            <span class="dashboard-card__title">@lang('Current Balance')</span>
                            <span class="dashboard-card__number">{{ $setting->cur_sym . showAmount($user->balance) }}</span>
                        </div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-wallet transform-0"></i>
                        </div>
                    </a>
                </div>
                <div class="col-xxxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <a href="{{ route('user.deposit.history') }}" class="dashboard-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->second_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-coins transform-0"></i>
                        </div>
                        <div class="dashboard-card__txt">
                            <span class="dashboard-card__title text--success">@lang('Deposited Amount')</span>
                            <span class="dashboard-card__number">{{ $setting->cur_sym . showAmount($depositAmount) }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <a href="{{ route('user.withdraw.history') }}" class="dashboard-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->second_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-credit-card transform-0"></i>
                        </div>
                        <div class="dashboard-card__txt">
                            <span class="dashboard-card__title text--warning">@lang('Withdrawal Amount')</span>
                            <span class="dashboard-card__number">{{ $setting->cur_sym . showAmount($withdrawalAmount) }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <a href="{{ route('user.transactions') }}" class="dashboard-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->second_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-arrows-right-left transform-0"></i>
                        </div>
                        <div class="dashboard-card__txt">
                            <span class="dashboard-card__title text--base">@lang('Today\'s Transactions')</span>
                            <span class="dashboard-card__number">{{ $user->transactions_count }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <a href="{{ route('user.dps.list') }}" class="dashboard-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->second_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-pig-money transform-0"></i>
                        </div>
                        <div class="dashboard-card__txt">
                            <span class="dashboard-card__title text--info">@lang('Running DPS')</span>
                            <span class="dashboard-card__number">{{ $user->deposit_pension_schemes_count }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <a href="{{ route('user.fds.list') }}" class="dashboard-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->second_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-cash-register transform-0"></i>
                        </div>
                        <div class="dashboard-card__txt">
                            <span class="dashboard-card__title text--primary">@lang('Running FDS')</span>
                            <span class="dashboard-card__number">{{ $user->fixed_deposit_schemes_count }}</span>
                        </div>
                    </a>
                </div>
                <div class="col-xxxl-3 col-lg-4 col-sm-6 col-xsm-6">
                    <a href="{{ route('user.loan.list') }}" class="dashboard-card">
                        <div class="dashboard-card__bg bg-img" data-background-image="{{ getImage($activeThemeTrue . 'images/site/user_dashboard/' . $userDashboardContent->data_info->second_background_image, '175x125') }}"></div>
                        <div class="dashboard-card__icon">
                            <i class="ti ti-cash transform-0"></i>
                        </div>
                        <div class="dashboard-card__txt">
                            <span class="dashboard-card__title text--danger">@lang('Running Loan')</span>
                            <span class="dashboard-card__number">{{ $user->loans_count }}</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <h5>@lang('Recent Deposits')</h5>
            <table class="table no-shadow table--striped table-borderless table--responsive--md">
                <thead>
                    <tr>
                        <th>@lang('S.N.')</th>
                        <th>@lang('TRX')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Date')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentDeposits as $deposit)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $deposit->trx }}</td>
                            <td>
                                <span class="text--success">{{ showAmount($deposit->amount) . ' ' . $setting->site_cur }}</span>
                            </td>
                            <td>{{ showDateTime($deposit->created_at, 'd M, Y') }}</td>
                        </tr>
                    @empty
                        @include('partials.noData')
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="col-xl-6">
            <h5>@lang('Recent Withdrawals')</h5>
            <table class="table no-shadow table--striped table-borderless table--responsive--md">
                <thead>
                    <tr>
                        <th>@lang('S.N.')</th>
                        <th>@lang('TRX')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Date')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentWithdrawals as $withdrawal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $withdrawal->trx }}</td>
                            <td>
                                <span class="text--success">{{ showAmount($withdrawal->amount) . ' ' . $setting->site_cur }}</span>
                            </td>
                            <td>{{ showDateTime($withdrawal->created_at, 'd M, Y') }}</td>
                        </tr>
                    @empty
                        @include('partials.noData')
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
