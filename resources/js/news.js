$(document).ready(function () {
    $('#edit-button').on('click', function () {
        $('#news-display').hide();   // 表示中のタイトルと本文を非表示
        $('#news-title').hide();   // 表示中のタイトルと本文を非表示
        $('#news-date').hide();   // 表示中のタイトルと本文を非表示
        $('#news-edit').show();      // 編集フォームを表示
    });

    $('#cancel-edit').on('click', function () {
        $('#news-display').show();   // 表示中のタイトルと本文を非表示
        $('#news-title').show();   // 表示中のタイトルと本文を非表示
        $('#news-date').show();   // 表示中のタイトルと本文を非表示
        $('#news-edit').hide();      // 編集フォームを表示
    });
});

console.log("✅ news.js 読み込まれてるよ！");

