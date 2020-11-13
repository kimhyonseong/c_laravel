// Modules 호출
// var gulp = require('gulp'); // Gulp 모듈 호출
// Gulp.task() 를 사용해 기본(Default) //테스크를 정의
// gulp.task('default', function () { // 콘솔 객체에 메시지를 기록(log)해 봅니다.
//     console.log('gulp default 일이 수행되었습니다!!!');
// });

var elixir = require('laravel-elixir');

elixir(function (mix) {
    mix
        .sass('app.scss')
        .scripts([
            '../vendor/jquery/dist/jquery.js',
            '../vendor/bootstrap-sass/assets/javascripts/bootstrap.js',
            'app.js'
        ], 'public/js/app.js')
        .version([
            'css/app.css',
            'js/app.js'
        ])
        .copy("resources/assets/vendor/font-awesome/fonts", "public/build/fonts");
});