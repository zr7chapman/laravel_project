@extends('layout')
@section('title', '感情日記一覧')
@section('content')
<!-- 
①route作成（削除ボタン）
②Controllerづくり
③削除機能づくり
 -->
<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h2>感情日記一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <table class="table table-striped">
            <tr>
                <th>日記番号</th>
                <th>タイトル</th>
                <th>感じたこと</th>
                <th>画像</th>
                <th>日付</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->id  }}</td>
                <td><a href="/blog/{{ $blog->id }}">{{ $blog->title  }}</a></td>
                <td></td>
                <td></td>
                <td>{{ $blog->updated_at  }}</td>
                <td><button type="button" class="btn btn-primary" onclick="location.href='/blog/edit/{{ $blog->id }}'">編集</button></td>
                <form method="POST" action="{{ route('delete', $blog->id) }}" onSubmit="return checkDelete()">
                {{ csrf_field() }}
                <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
                </form>
            </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
}
</script>
@endsection