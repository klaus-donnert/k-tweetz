<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>k-Tweetz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">k-tweetz</a>
        </div>
    </div>
</nav>
<div class="container">
    <form class="well" action="{{route('post.tweet')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endforeach
        @endif
        <div class="form-group">
            <label for="tweet">Tweet Text</label>
            <input type="text" id="tweet" name="tweet" class="form-control">
        </div>

        <div class="form-group">
            <label>Upload Images</label>
            <div class="form-control">
                <input type="file" name="images[]" multiple class="">
            </div>
        </div>
        <div class="form-group">
            <button name="submit" class="btn btn-primary">Submit Tweet</button>
        </div>

    </form>

    @if(!empty($data))
        @foreach($data as $key => $tweet)
            <div class="well">
                <h3><?= Twitter::linkify($tweet['text']); ?>
                    <i class="glyphicon glyphicon-heart"></i> {{$tweet['favorite_count']}}
                    <i class="glyphicon glyphicon-repeat"></i> {{$tweet['retweet_count']}}
                </h3>
                <div>
                    @if(!empty($tweet['extended_entities']['media']))
                        @foreach($tweet['extended_entities']['media'] as $image)
                            <img src="{{$image['media_url_https']}}" style="max-width:400px;">
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach

    @else
        <p>No Tweets found.</p>
    @endif
</div>
</body>
</html>
