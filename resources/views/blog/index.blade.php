@extends('blog.includes.main')

@section('content')

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('blog/img/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Nasi Goreng</h1>
                        <hr class="small">
                        <span class="subheading">Simple CMS based on Laravel 5.1</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @foreach ($posts as $post)
                    <?php 
                        $a_post = url('post/'.$post['slug']);
                        $a_author = url('user/'.$post['user']['id']);
                        $author = $post['user']['name'];
                        $a_category = url('category/'.$post['category']['slug']).'/posts';
                        $category = $post['category']['title'];
                        $date = (new DateTime($post['user']['created_at']))->format('F dS, Y');
                    ?>
                    <div class="post-preview">
                        <a href="{{$a_post}}">
                            <div class="post-header-preview" style="background-image: url('{{$post['header_image']}}')"></div>
                        </a>
                        <a href="{{$a_post}}">
                            <h2 class="post-title">
                                {{$post['title']}}
                            </h2>
                        </a>
                        <p class="post-subtitle">{{$post['description']}}</p>
                        <p class="post-meta"><a href="{{$a_author}}">{{$author}}</a> in <a href="{{$a_category}}">{{$category}}</a>, {{$date}}</p>
                    </div>
                    <br>
                @endforeach

                <!-- Pager -->
                <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

@endsection