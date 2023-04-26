<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/commentaire' => [[['_route' => 'app_commentaire_index', '_controller' => 'App\\Controller\\CommentaireController::index'], null, ['GET' => 0], null, true, false, null]],
        '/post' => [[['_route' => 'app_post_index', '_controller' => 'App\\Controller\\PostController::index'], null, ['GET' => 0], null, true, false, null]],
        '/post/date' => [[['_route' => 'app_post_date', '_controller' => 'App\\Controller\\PostController::decroissantDate'], null, ['GET' => 0], null, false, false, null]],
        '/post/sujet' => [[['_route' => 'app_post_sujet', '_controller' => 'App\\Controller\\PostController::decroissantSujet'], null, ['GET' => 0], null, false, false, null]],
        '/post/searchposteajax' => [[['_route' => 'app_searchpost', '_controller' => 'App\\Controller\\PostController::searchajax'], null, null, null, false, false, null]],
        '/post/front' => [[['_route' => 'app_post_front', '_controller' => 'App\\Controller\\PostController::frontpost'], null, ['GET' => 0], null, false, false, null]],
        '/post/front/new' => [[['_route' => 'app_postfront_new', '_controller' => 'App\\Controller\\PostController::addPost'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/post/new' => [[['_route' => 'app_post_new', '_controller' => 'App\\Controller\\PostController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/commentaire/([^/]++)(?'
                    .'|/(?'
                        .'|new(?'
                            .'|back(*:45)'
                            .'|(*:52)'
                        .')'
                        .'|edit(?'
                            .'|front(*:72)'
                            .'|(*:79)'
                        .')'
                        .'|Remove(*:93)'
                    .')'
                    .'|(*:101)'
                .')'
                .'|/post/(?'
                    .'|details/([^/]++)(*:135)'
                    .'|([^/]++)(*:151)'
                    .'|back/([^/]++)(*:172)'
                    .'|([^/]++)(?'
                        .'|/edit(?'
                            .'|front(*:204)'
                            .'|(*:212)'
                        .')'
                        .'|(*:221)'
                    .')'
                    .'|front/([^/]++)(*:244)'
                .')'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:284)'
                    .'|wdt/([^/]++)(*:304)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:350)'
                            .'|router(*:364)'
                            .'|exception(?'
                                .'|(*:384)'
                                .'|\\.css(*:397)'
                            .')'
                        .')'
                        .'|(*:407)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        45 => [[['_route' => 'app_commentaire_new', '_controller' => 'App\\Controller\\CommentaireController::new'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        52 => [[['_route' => 'app_post_showcomment', '_controller' => 'App\\Controller\\CommentaireController::commentpost'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        72 => [[['_route' => 'app_commentaire_editfront', '_controller' => 'App\\Controller\\CommentaireController::editfront'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        79 => [[['_route' => 'app_commentaire_edit', '_controller' => 'App\\Controller\\CommentaireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        93 => [[['_route' => 'app_commentaire_remove', '_controller' => 'App\\Controller\\CommentaireController::Remove'], ['id'], ['GET' => 0], null, false, false, null]],
        101 => [
            [['_route' => 'app_commentaire_show', '_controller' => 'App\\Controller\\CommentaireController::show'], ['id'], ['GET' => 0], null, false, true, null],
            [['_route' => 'app_commentaire_delete', '_controller' => 'App\\Controller\\CommentaireController::delete'], ['id'], ['POST' => 0], null, false, true, null],
        ],
        135 => [[['_route' => 'app_post_show', '_controller' => 'App\\Controller\\PostController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        151 => [[['_route' => 'app_comment_post', '_controller' => 'App\\Controller\\PostController::commentSection'], ['id'], ['GET' => 0], null, false, true, null]],
        172 => [[['_route' => 'app_post_showcomments', '_controller' => 'App\\Controller\\PostController::commentSectionBack'], ['id'], ['GET' => 0], null, false, true, null]],
        204 => [[['_route' => 'app_post_editfront', '_controller' => 'App\\Controller\\PostController::editfront'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        212 => [[['_route' => 'app_post_edit', '_controller' => 'App\\Controller\\PostController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        221 => [[['_route' => 'app_post_delete', '_controller' => 'App\\Controller\\PostController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        244 => [[['_route' => 'app_postfront_delete', '_controller' => 'App\\Controller\\PostController::deletefront'], ['id'], ['POST' => 0], null, false, true, null]],
        284 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        304 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        350 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        364 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        384 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        397 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        407 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
