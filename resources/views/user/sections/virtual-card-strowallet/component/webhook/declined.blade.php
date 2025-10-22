@if(isset($item))
    <div class="dashboard-list-item-wrapper">
        <div class="dashboard-list-item sent">
            <div class="dashboard-list-left">
                <div class="dashboard-list-user-wrapper">
                    <div class="dashboard-list-user-icon">
                        <i class="las la-arrow-down"></i>
                    </div>
                    <div class="dashboard-list-user-content">
                        <h4 class="title">{{ str_replace(' ', ' ', ucwords(str_replace('.', ' ', $item->event))) }}</h4>
                    </div>
                </div>
            </div>
            <div class="dashboard-list-right">
                <h4 class="main-money text--base">{{ get_amount($item->data->amount ?? 0,$item->card_currency,get_wallet_precision()) }}</h4>
            </div>
        </div>
        <div class="preview-list-wrapper">
            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="lab la-tumblr"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{__("web_trx_id")}}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ $item->transaction_id }}</span>
                </div>
            </div>
            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="las la-credit-card"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{ __("cardI d") }}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ $item->cardId ?? '' }}</span>
                </div>
            </div>

            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="las la-thumbtack"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{ __("Reference") }}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ $item->data->reference }}</span>
                </div>
            </div>

            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="las la-receipt"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{ __("Narration") }}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ $item->data->narrative ?? "",}}</span>
                </div>
            </div>
            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="las la-smoking"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{ __("Reason") }}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ $item->data->reason ?? "" }}</span>
                </div>
            </div>
            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="lab la-get-pocket"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{ __("Status") }}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ ucwords($item->data->status ?? "" )}}</span>
                </div>
            </div>
            <div class="preview-list-item">
                <div class="preview-list-left">
                    <div class="preview-list-user-wrapper">
                        <div class="preview-list-user-icon">
                            <i class="las la-clock"></i>
                        </div>
                        <div class="preview-list-user-content">
                            <span>{{ __("Time & Date") }}</span>
                        </div>
                    </div>
                </div>
                <div class="preview-list-right">
                    <span>{{ \Carbon\Carbon::parse($item->data->date)->format('d-m-y h:i:s A') }}</span>
                </div>
            </div>
        </div>
    </div>
@endif
