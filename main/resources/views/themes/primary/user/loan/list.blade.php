@extends("{$activeTheme}layouts.auth")

@section('auth')
    <div class="mb-xxl-4 mb-3">
        <div class="d-flex flex-wrap align-items-end justify-content-end gap-3">
            <form action="" method="get" class="d-flex flex-wrap gap-3 justify-content-center">
                <div class="input--group">
                    <input type="text" class="form--control form--control--sm" name="search" value="{{ request('search') }}" placeholder="@lang('Plan/Loan Number')">
                    <button type="submit" class="btn btn--sm btn--base px-3">
                        <i class="ti ti-search"></i>
                    </button>
                </div>
                <div class="input--group">
                    <input type="text" class="form--control form--control--sm date-picker" name="date" value="{{ request('date') }}" data-range="true" data-multiple-dates-separator=" - " data-language="en" placeholder="@lang('Start Date - End Date')" autocomplete="off">
                    <button type="submit" class="btn btn--sm btn--base px-3">
                        <i class="ti ti-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table--striped table-borderless table--responsive--md">
            <thead>
                <tr>
                    <th>@lang('S.N.')</th>
                    <th>@lang('Loan No.') | @lang('Plan')</th>
                    <th>@lang('Amount')</th>
                    <th>@lang('Installment Amount')</th>
                    <th>@lang('Installment')</th>
                    <th>@lang('Payable Amount')</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Status')</th>
                    <th>@lang('Action')</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loanList as $loan)
                    <tr>
                        <td>{{ $loanList->firstItem() + $loop->index }}</td>
                        <td>
                            <span>
                                <span class="d-block">{{ $loan->scheme_code }}</span>
                                <span class="d-block text--base small">{{ __($loan->plan_name) }}</span>
                            </span>
                        </td>
                        <td>
                            {{ $setting->cur_sym . showAmount($loan->amount_requested) }}
                        </td>
                        <td>
                            <span>
                                <span class="d-block">{{ $setting->cur_sym . showAmount($loan->per_installment) }}</span>
                                <span class="d-block text--base small">
                                    {{ trans('In every') . ' ' . $loan->installment_interval . ' ' . trans(\Illuminate\Support\Str::plural('Day', $loan->installment_interval)) }}
                                </span>
                            </span>
                        </td>
                        <td>
                            <span>
                                <span class="d-block">@lang('Total'): {{ $loan->total_installment }}</span>
                                <span class="d-block text--base small">@lang('Given'): {{ $loan->given_installment }}</span>
                            </span>
                        </td>
                        <td>
                            {{ $setting->cur_sym . showAmount($loan->payable_amount) }}
                        </td>
                        <td>
                            <span>
                                <span class="d-block">
                                    @lang('Approved'): {{ is_null($loan->approved_at) ? trans('N/A') : showDateTime($loan->approved_at, 'd M, Y') }}
                                </span>
                                <span class="d-block text--base small">
                                    @lang('Next Installment'): {{ is_null($loan->approved_at) ? trans('N/A') : showDateTime($loan->next_installment_date, 'd M, Y') }}
                                </span>
                            </span>
                        </td>
                        <td>
                            @php echo $loan->status_badge @endphp
                        </td>
                        <td>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('user.loan.installments', $loan) }}" class="btn btn-outline--base btn--icon">
                                    <i class="ti ti-calendar-dollar transform-0"></i>
                                </a>

                                @if($loan->status == ManageStatus::LOAN_REJECTED)
                                    <button type="button" class="btn btn--base btn--icon btn-feedback" data-bs-toggle="modal" data-bs-target="#feedbackModal" data-admin_feedback="{{ __($loan->admin_feedback) }}">
                                        <i class="ti ti-device-desktop transform-1"></i>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    @include('partials.noData')
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($loanList->hasPages())
        {{ paginateLinks($loanList) }}
    @endif
@endsection

@push('user-panel-modal')
    <div class="custom--modal modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="feedbackModalLabel">@lang('Admin Feedback')</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="px-1"></p>
                </div>
            </div>
        </div>
    </div>
@endpush

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

                $('.btn-feedback').on('click', function () {
                    $('#feedbackModal').find('p').text($(this).data('admin_feedback'))
                })
            })
        })(jQuery)
    </script>
@endpush
