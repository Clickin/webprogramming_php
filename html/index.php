<!DOCTYPE html>
<html>
    <?php $title = "SKKU Theater"?>
    <?php 
    include('navbar.php');
    include('connect.php');?>
    <style>
        img {
            width:200px;height:270px;border:1px;
            margin: 10px;
        }
        .movie-list{
            margin: 10px;
            border: 1px solid gray;
            flaot: left;
            display: inline-block;
        }
    </style>
    <body>

        <div class="container">
            <div class="row">
                <h1 class="page-header">영화 목록</h1>
                <div class="movie-list">
                    <img src="https://i.imgur.com/uLPNKAw.jpg"><br>
                    <input class="btn btn-default" type="button" onclick="window.open('./movie1.html', '_blank');" value="상세보기">
                    
                </div>
                <div class="movie-list">
                    <img src="https://i.imgur.com/lCsmd8d.jpg"><br>
                    <input class="btn btn-default" type="button" onclick="window.open('./movie2.html', '_blank');" value="상세보기">
                </div>
                <div class="movie-list">
                    <img src="https://i.imgur.com/yYii7Pp.jpg"><br>
                    <input class="btn btn-default" type="button" onclick="window.open('./movie3.html', '_blank');" value="상세보기">
                </div>
                <div class="movie-list">
                    <img src="https://i.imgur.com/cK2SfQx.jpg"><br>
                    <input class="btn btn-default" type="button" onclick="window.open('./movie4.html', '_blank');" value="상세보기">
                </div>
            </div>
        </div>

    </body>
</html>