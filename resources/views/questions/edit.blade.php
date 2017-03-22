@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>
                    <div class="panel-body">
                        <form action="/questions/{{ $question->id }} " method="post">
                            {!! csrf_field() !!}
                            {{ method_field('PATCH') }}
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                <label for="title">标题：</label>
                                <input type="text" class="form-control" name="title" placeholder="标题" id="title"
                                       value="{{ $question->title }}">
                                @if($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('topics') ? 'has-error' : '' }} ">
                                <label for="topic">话题：</label>
                                <select class="js-example-basic-multiple form-control" name="topics[]" id="topic"
                                        multiple="multiple">
                                    @foreach($question->topics as $topic)
                                        <option value="{{ $topic->id }} " selected>{{ $topic->name }} </option>
                                    @endforeach
                                </select>
                                @if($errors->has('topics'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('topics') }} </strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
                                <script id="container" name="body" type="text/plain">
                                    {!! $question->body !!}
                                </script>
                                @if($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-success btn-block pull-right" type="submit">发布问题</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 实例化编辑器 -->
@section('js')
    <script type="text/javascript">
        var ue = UE.getEditor('container', {
            toolbars: [
                ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft', 'justifycenter', 'justifyright', 'link', 'insertimage', 'fullscreen']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode: true,
            wordCount: false,
            imagePopup: false,
            autotypeset: {indent: true, imageBlockLine: 'center'}
        });
        ue.ready(function ()
        {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
        function formatTopic(topic)
        {

            return "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__meta'>" +
            "<div class='select2-result-repository__title'>" +
            topic.name ? topic.name : "Laravel" +
                "</div></div></div>";
        }

        function formatTopicSelection(topic)
        {
            return topic.name || topic.text;
        }

        $(".js-example-basic-multiple").select2({
            tags: true,
            placeholder: '选择相关话题',
            minimumInputLength: 2,
            ajax: {
                url: '/api/topics',
                dataType: 'json',
                delay: 250,
                data: function (params)
                {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data, params)
                {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            templateResult: formatTopic,
            templateSelection: formatTopicSelection,
            escapeMarkup: function (markup)
            {
                return markup;
            }
        });
    </script>
@endsection
<!-- 编辑器容器 -->
<script id="container" name="content" type="text/plain"></script>
@endsection
