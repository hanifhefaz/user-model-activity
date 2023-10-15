@extends('UserModelActivity::layouts.app')

@section('content')
    <div class="container">
        <h1>User Model Activity</h1>
        <div class="log-files">
            @foreach ($logFiles as $logFile)
                <div class="log-file" data-file="{{ $logFile }}">
                    {{ $logFile }}
                </div>
            @endforeach
        </div>

        <div id="log-content">
            @include('UserModelActivity::user-activity.logcontent')
        </div>

        <style>
            .log-files {
                float: left;
                width: 30%;
                padding-right: 20px;
            }

            .log-file {
                cursor: pointer;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid transparent;
                border-radius: 5px;
                background-color: #f1f1f1;
                color: #333;
                font-weight: bold;
            }

            .log-file.active {
                border-color: #000;
                background-color: #000;
                color: #fff;
            }

            #log-content {
                float: left;
                width: 70%;
                background-color: #f1f1f1;
                padding: 20px;
                border-radius: 5px;
                color: #333;
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5;
                overflow-wrap: break-word;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        </style>

        <script src="{{ asset('vendor/user-model-activity/js/user-model-activity-jquery.js') }}"></script>
        <script>
            $(document).ready(function() {
                var currentPage = 1;
                function fetchLogContent(page) {
                    var logFile = $('.log-file.active').data('file');

                    if (logFile) {
                        $.ajax({
                            url: '/fetch-log-content',
                            type: 'GET',
                            data: { logFile: logFile, page: page },
                            success: function(response) {
                                $('#log-content').html(response);
                                currentPage = page;
                            }
                        });
                    } else {
                        $('#log-content').empty();
                    }
                }

                $('.log-file').on('click', function() {
                    $('.log-file').removeClass('active');
                    $(this).addClass('active');
                    fetchLogContent(1);
                });

                $(document).on('click', '.pagination a', function(event) {
                    event.preventDefault();
                    var nextPage = $(this).attr('href').split('page=')[1];
                    fetchLogContent(nextPage);
                });

                fetchLogContent(currentPage);
            });
        </script>
    </div>
@endsection
