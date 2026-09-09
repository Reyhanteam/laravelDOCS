<?php

// Documentation is data. Code samples must never be interpreted as PHP while this config is loaded.
$code = static fn (array $lines): string => implode("\n", $lines);
$pages = [];

$add = static function (string $slug, string $title, string $subtitle, array $blocks = []) use (&$pages): void {
    $pages[$slug] = [
        'title' => $title,
        'subtitle' => $subtitle,
        'search' => [$title, $subtitle],
        'blocks' => $blocks,
    ];
};

$add('getting-started/introduction', 'Introduction', 'A Laravel-native router for Telegram bots.', [
    ['t' => 'p', 'text' => 'Laravel Telegram Bot Router brings the routing model you already know from HTTP to the Telegram Bot API. Declare routes for commands, messages and callback queries, then dispatch them to controllers with middleware and parameters.'],
    ['t' => 'h2', 'text' => 'A first look'],
    ['t' => 'code', 'lang' => 'php', 'title' => 'routes/bot.php', 'code' => $code([
        'use ReyhanTeam\\TelegramBotRouter\\Facades\\TelegramRoute;',
        'use App\\Telegram\\Controllers\\StartController;',
        '',
        "TelegramRoute::onCommand('start', [StartController::class, 'start']);",
    ])],
    ['t' => 'list', 'items' => ['Command, message and callback-query routing', 'Webhook and polling transports', 'Keyboard builders and Response API', 'Queue integration and rate limiting', 'Telegram API client and testing support']],
]);

$add('getting-started/requirements', 'Requirements', 'Everything you need before installing the package.', [
    ['t' => 'table', 'head' => ['Requirement', 'Version', 'Notes'], 'rows' => [
        ['PHP', '8.1+', 'Use a version supported by your package release'],
        ['Laravel', '10.x–13.x', 'Match the Laravel version supported by the installed release'],
        ['ext-json', 'Required', 'Telegram update decoding'],
        ['Queue driver', 'Optional', 'Required only for queued updates'],
        ['Cache', 'Optional', 'Recommended for deduplication and rate limiting'],
    ]],
]);

$add('getting-started/installation', 'Installation', 'Install the package and publish its Laravel integration.', [
    ['t' => 'h2', 'text' => 'Install via Composer'],
    ['t' => 'code', 'lang' => 'bash', 'code' => 'composer require reyhanteam/laravel-telegram-bot-router'],
    ['t' => 'h2', 'text' => 'Publish bot routes'],
    ['t' => 'code', 'lang' => 'bash', 'code' => 'php artisan vendor:publish --tag=telegram-bot-routes'],
    ['t' => 'p', 'text' => 'This creates routes/bot.php, keeping Telegram routes separate from routes/web.php.'],
]);

$add('getting-started/quick-start', 'Quick Start', 'Create a Telegram route and send a response.', [
    ['t' => 'code', 'lang' => 'php', 'title' => 'routes/bot.php', 'code' => $code([
        'use ReyhanTeam\\TelegramBotRouter\\Facades\\TelegramRoute;',
        'use App\\Telegram\\Controllers\\StartController;',
        '',
        "TelegramRoute::onCommand('start', [StartController::class, 'start']);",
    ])],
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        'public function start(Update $update): Response',
        '{',
        "    return Response::text('Welcome!');",
        '}',
    ])],
    ['t' => 'code', 'lang' => 'bash', 'code' => 'php artisan reyhan:start-polling'],
]);

$add('core-concepts/how-it-works', 'How It Works', 'From a Telegram update to a controller response.', [
    ['t' => 'list', 'ordered' => true, 'items' => ['Webhook or polling receives the update.', 'The update is parsed and normalised.', 'The router finds a matching Telegram route.', 'Middleware runs around the handler.', 'The controller returns a response.', 'The response becomes Telegram Bot API calls.']],
]);

$add('core-concepts/architecture', 'Architecture', 'The transport, routing and response layers.', [
    ['t' => 'table', 'head' => ['Component', 'Responsibility'], 'rows' => [['Transport', 'Webhook or polling receives updates'], ['Update layer', 'Normalises Telegram payloads'], ['Router', 'Matches Telegram routes'], ['Middleware', 'Cross-cutting checks and policies'], ['Controller', 'Application logic'], ['Response', 'Outgoing Telegram actions'], ['Telegram client', 'Bot API communication']]],
]);

$add('core-concepts/telegram-updates', 'Telegram Updates', 'The update object exposed to route handlers.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        'public function start(Update $update)',
        '{',
        '    $update->id;',
        '    $update->text;',
        '    $update->chat->id;',
        '    $update->from->id;',
        '    $update->callbackData;',
        '    $update->raw();',
        '}',
    ])],
]);

$add('core-concepts/controllers', 'Controllers', 'Keep Telegram bot logic inside ordinary Laravel controllers.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        'class OrderController',
        '{',
        '    public function show(Update $update, string $id): Response',
        '    {',
        '        return Response::text("Order #{$id}");',
        '    }',
        '}',
    ])],
]);

$add('routing/commands', 'Command Routes', 'Route slash commands such as /start and /help.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        "Route::onCommand('start', [StartController::class, 'start']);",
        "Route::onCommand('help', [HelpController::class, 'help']);",
        "Route::onCommand(['stats', 'statistics'], StatsController::class);",
    ])],
]);

$add('routing/messages', 'Message Routes', 'Match normal text and message updates.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        "Route::onMessage('Menu', MenuController::class);",
        "Route::onMessage('/^track\\s+(?<code>[A-Z0-9]+)$/i', TrackController::class);",
        'Route::onPhoto(PhotoController::class);',
        'Route::onDocument(DocumentController::class);',
    ])],
]);

$add('routing/callback-queries', 'Callback Queries', 'Handle inline keyboard button presses.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        "Route::onCallback('order:{id}:cancel', [OrderController::class, 'cancel']);",
        '',
        'public function cancel(Update $update, string $id): Response',
        '{',
        "    return Response::answerCallback('Cancelled');",
        '}',
    ])],
]);

$add('routing/route-parameters', 'Route Parameters', 'Use parameters instead of manually parsing Telegram text.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        "Route::onCommand('order {id}', [OrderController::class, 'show']);",
        "Route::onCommand('remind {when} {message?}', RemindController::class);",
        "Route::onCommand('user {id}', UserController::class)->where('id', '[0-9]+');",
    ])],
]);

$add('routing/named-routes', 'Named Routes', 'Give Telegram routes stable names.', [
    ['t' => 'code', 'lang' => 'php', 'code' => "Route::onCallback('order:{id}:cancel', [OrderController::class, 'cancel'])->name('orders.cancel');"],
]);

$add('routing/route-groups', 'Route Groups', 'Share middleware and route configuration.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        "Route::middleware('telegram.admin')->group(function () {",
        "    Route::onCommand('stats', StatsController::class);",
        "    Route::onCommand('ban {id}', BanController::class);",
        '});',
    ])],
]);

$add('routing/middleware', 'Middleware', 'Authorization, throttling and cross-cutting Telegram policies.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code([
        'class EnsureUserIsAdmin',
        '{',
        '    public function handle(Update $update, Closure $next)',
        '    {',
        '        if (! in_array($update->from->id, config(\'telegram-bot.admins\'))) {',
        '            return Response::text(\'Not allowed.\');',
        '        }',
        '',
        '        return $next($update);',
        '    }',
        '}',
    ])],
]);

$add('bot-modes/webhook', 'Webhook Mode', 'Let Telegram push updates to your Laravel application.', [
    ['t' => 'p', 'text' => 'In webhook mode Telegram sends an HTTP POST to the configured Laravel webhook route.'],
    ['t' => 'code', 'lang' => 'bash', 'code' => 'php artisan reyhan:setWebhookRoute'],
    ['t' => 'code', 'lang' => 'env', 'code' => "TELEGRAM_MODE=webhook\nTELEGRAM_WEBHOOK_PATH=/telegram/webhook"],
]);

$add('bot-modes/polling', 'Polling Mode', 'Pull updates with long polling.', [
    ['t' => 'code', 'lang' => 'bash', 'code' => 'php artisan reyhan:start-polling'],
    ['t' => 'p', 'text' => 'Polling uses the same route table and controllers as webhook mode.'],
]);

$add('bot-modes/webhook-vs-polling', 'Webhook vs Polling', 'Choose the transport that fits your environment.', [
    ['t' => 'table', 'head' => ['Aspect', 'Webhook', 'Polling'], 'rows' => [['HTTPS', 'Required', 'Not required'], ['Local development', 'Needs public endpoint', 'Works directly'], ['Production', 'Recommended', 'Use with process manager'], ['Routes', 'Same route table', 'Same route table']]],
]);

$add('keyboard/overview', 'Keyboard Overview', 'Build Telegram reply and inline keyboards.', [
    ['t' => 'p', 'text' => 'The Keyboard API provides reusable builders for Telegram reply and inline keyboards.'],
]);
$add('keyboard/reply-keyboard', 'Reply Keyboard', 'Build keyboards that appear as Telegram reply options.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code(['$keyboard = Keyboard::make()', "    ->button('Menu')", "    ->button('Help');"])],
]);
$add('keyboard/inline-keyboard', 'Inline Keyboard', 'Build keyboards attached to messages.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code(['$keyboard = Keyboard::make()', "    ->button('Open', url: 'https://example.com')", "    ->button('Cancel', callbackData: 'order:{id}:cancel');"])],
]);
$add('keyboard/buttons', 'Buttons', 'Configure button labels, URLs and callback data.', [
    ['t' => 'p', 'text' => 'Buttons can represent normal reply choices, URLs or callback actions depending on the keyboard type.'],
]);
$add('keyboard/callback-data', 'Callback Data', 'Connect inline keyboard actions to callback routes.', [
    ['t' => 'code', 'lang' => 'php', 'code' => "Route::onCallback('order:{id}:cancel', [OrderController::class, 'cancel']);"],
]);
$add('keyboard/reusable-patterns', 'Reusable Keyboard Patterns', 'Keep frequently used keyboard layouts reusable.', [
    ['t' => 'p', 'text' => 'Create keyboard factories or application services for repeated layouts instead of duplicating button definitions in controllers.'],
]);

$add('telegram/telegram-api', 'Telegram API', 'Access Telegram Bot API methods through the package client.', [
    ['t' => 'p', 'text' => 'The package exposes a developer-friendly Telegram API layer while keeping routing and application logic separate.'],
]);
$add('telegram/response-api', 'Response API', 'Describe outgoing Telegram actions from route handlers.', [
    ['t' => 'code', 'lang' => 'php', 'code' => $code(["return Response::text('Hello');", '', 'return Response::photo($file);'])],
]);

$add('queue/queue', 'Queue', 'Process Telegram updates asynchronously with Laravel queues.', [
    ['t' => 'code', 'lang' => 'env', 'code' => "TELEGRAM_QUEUE_CONNECTION=database\nTELEGRAM_QUEUE_NAME=telegram"],
]);
$add('queue/rate-limiting', 'Rate Limiting', 'Control outgoing Telegram API traffic per user, chat or command.', [
    ['t' => 'list', 'items' => ['Per-user limits', 'Per-chat limits', 'Per-command limits', 'Laravel Cache and RateLimiter integration', 'Configurable limits and backoff']],
]);

foreach ([
    'testing/unit' => ['Unit Testing', 'Test isolated routing and support classes.'],
    'testing/feature' => ['Feature Testing', 'Test complete Laravel integration flows.'],
    'testing/routing' => ['Routing Tests', 'Verify commands, messages, callbacks and parameters.'],
    'testing/telegram' => ['Telegram Tests', 'Test Telegram update handling and API integration.'],
    'testing/api' => ['API Tests', 'Test Telegram API client and response behaviour.'],
] as $slug => [$title, $subtitle]) {
    $add($slug, $title, $subtitle, [['t' => 'p', 'text' => 'Keep automated tests close to the behaviour they verify. Use fake or test transports where possible and reserve real Telegram API calls for explicit smoke tests.']]);
}

$add('configuration/configuration', 'Configuration', 'Configure the bot, transport, queues and rate limits.', [
    ['t' => 'code', 'lang' => 'env', 'code' => "TELEGRAM_BOT_TOKEN=123456:AA...\nTELEGRAM_MODE=webhook\nTELEGRAM_WEBHOOK_PATH=/telegram/webhook"],
]);
$add('configuration/security', 'Security', 'Protect bot tokens, webhook endpoints and privileged routes.', [
    ['t' => 'list', 'items' => ['Never commit the bot token.', 'Validate webhook requests in production.', 'Protect administrator routes with middleware.', 'Apply rate limits to sensitive commands.']],
]);

foreach ([
    'examples/simple-bot' => ['Simple Bot', 'A minimal Telegram bot using routes and a controller.'],
    'examples/start-command' => ['Start Command', 'Handle /start with a controller.'],
    'examples/echo-bot' => ['Echo Bot', 'Route incoming text to an echo handler.'],
    'examples/inline-keyboard' => ['Inline Keyboard', 'Send an inline keyboard and handle callbacks.'],
    'examples/callback-bot' => ['Callback Bot', 'Route callback data to a controller method.'],
    'examples/admin-commands' => ['Admin Commands', 'Protect administrator commands with middleware.'],
    'examples/queue-bot' => ['Queue-based Bot', 'Process updates asynchronously with Laravel queues.'],
] as $slug => [$title, $subtitle]) {
    $add($slug, $title, $subtitle, [['t' => 'p', 'text' => 'This example follows the package architecture: define the Telegram route in routes/bot.php, keep application logic in a controller, and return a Telegram Response.']]);
}

foreach ([
    'api/route-api' => ['Route API', 'Reference for Telegram route definitions.'],
    'api/keyboard-api' => ['Keyboard API', 'Reference for keyboard builders and buttons.'],
    'api/response-api' => ['Response API', 'Reference for outgoing Telegram responses.'],
    'api/telegram-api' => ['Telegram API Reference', 'Client methods and error handling.'],
] as $slug => [$title, $subtitle]) {
    $add($slug, $title, $subtitle, [['t' => 'p', 'text' => 'Use the package API directly from your Laravel application while keeping transport and routing concerns separated.']]);
}

foreach ([
    'changelog' => ['Changelog', 'Notable changes to Laravel Telegram Bot Router.'],
    'faq' => ['FAQ', 'Frequently asked questions.'],
    'troubleshooting' => ['Troubleshooting', 'Common setup and runtime problems.'],
    'contributing' => ['Contributing', 'How to contribute to the package.'],
] as $slug => [$title, $subtitle]) {
    $add($slug, $title, $subtitle, [['t' => 'p', 'text' => 'See the repository history and project contribution guidelines for the latest details.']]);
}

$navigation = [
    'Getting Started' => ['getting-started/introduction', 'getting-started/requirements', 'getting-started/installation', 'getting-started/quick-start'],
    'Core Concepts' => ['core-concepts/how-it-works', 'core-concepts/architecture', 'core-concepts/telegram-updates', 'core-concepts/controllers'],
    'Routing' => ['routing/commands', 'routing/messages', 'routing/callback-queries', 'routing/route-parameters', 'routing/named-routes', 'routing/route-groups', 'routing/middleware'],
    'Bot Modes' => ['bot-modes/webhook', 'bot-modes/polling', 'bot-modes/webhook-vs-polling'],
    'Keyboard' => ['keyboard/overview', 'keyboard/reply-keyboard', 'keyboard/inline-keyboard', 'keyboard/buttons', 'keyboard/callback-data', 'keyboard/reusable-patterns'],
    'Telegram & Responses' => ['telegram/telegram-api', 'telegram/response-api'],
    'Queue & Rate Limiting' => ['queue/queue', 'queue/rate-limiting'],
    'Testing' => ['testing/unit', 'testing/feature', 'testing/routing', 'testing/telegram', 'testing/api'],
    'Configuration & Security' => ['configuration/configuration', 'configuration/security'],
    'Examples' => ['examples/simple-bot', 'examples/start-command', 'examples/echo-bot', 'examples/inline-keyboard', 'examples/callback-bot', 'examples/admin-commands', 'examples/queue-bot'],
    'API Reference' => ['api/route-api', 'api/keyboard-api', 'api/response-api', 'api/telegram-api'],
    'More' => ['changelog', 'faq', 'troubleshooting', 'contributing'],
];

$groups = [];
foreach ($navigation as $group => $slugs) {
    foreach ($slugs as $slug) {
        $groups[$slug] = $group;
    }
}

return [
    'groups' => $groups,
    'navigation' => $navigation,
    'pages' => $pages,
];
