<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    'app_commentaire_index' => [[], ['_controller' => 'App\\Controller\\CommentaireController::index'], [], [['text', '/commentaire/']], [], [], []],
    'app_commentaire_new' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::new'], [], [['text', '/newback'], ['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_commentaire_show' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_post_showcomment' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::commentpost'], [], [['text', '/new'], ['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_commentaire_editfront' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::editfront'], [], [['text', '/editfront'], ['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_commentaire_edit' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_commentaire_remove' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::Remove'], [], [['text', '/Remove'], ['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_commentaire_delete' => [['id'], ['_controller' => 'App\\Controller\\CommentaireController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/commentaire']], [], [], []],
    'app_post_index' => [[], ['_controller' => 'App\\Controller\\PostController::index'], [], [['text', '/post/']], [], [], []],
    'app_post_date' => [[], ['_controller' => 'App\\Controller\\PostController::decroissantDate'], [], [['text', '/post/date']], [], [], []],
    'app_post_sujet' => [[], ['_controller' => 'App\\Controller\\PostController::decroissantSujet'], [], [['text', '/post/sujet']], [], [], []],
    'app_searchpost' => [[], ['_controller' => 'App\\Controller\\PostController::searchajax'], [], [['text', '/post/searchposteajax']], [], [], []],
    'app_post_front' => [[], ['_controller' => 'App\\Controller\\PostController::frontpost'], [], [['text', '/post/front']], [], [], []],
    'app_postfront_new' => [[], ['_controller' => 'App\\Controller\\PostController::addPost'], [], [['text', '/post/front/new']], [], [], []],
    'app_post_new' => [[], ['_controller' => 'App\\Controller\\PostController::new'], [], [['text', '/post/new']], [], [], []],
    'app_post_show' => [['id'], ['_controller' => 'App\\Controller\\PostController::show'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/post/details']], [], [], []],
    'app_comment_post' => [['id'], ['_controller' => 'App\\Controller\\PostController::commentSection'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/post']], [], [], []],
    'app_post_showcomments' => [['id'], ['_controller' => 'App\\Controller\\PostController::commentSectionBack'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/post/back']], [], [], []],
    'app_post_editfront' => [['id'], ['_controller' => 'App\\Controller\\PostController::editfront'], [], [['text', '/editfront'], ['variable', '/', '[^/]++', 'id', true], ['text', '/post']], [], [], []],
    'app_post_edit' => [['id'], ['_controller' => 'App\\Controller\\PostController::edit'], [], [['text', '/edit'], ['variable', '/', '[^/]++', 'id', true], ['text', '/post']], [], [], []],
    'app_post_delete' => [['id'], ['_controller' => 'App\\Controller\\PostController::delete'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/post']], [], [], []],
    'app_postfront_delete' => [['id'], ['_controller' => 'App\\Controller\\PostController::deletefront'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/post/front']], [], [], []],
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
];
