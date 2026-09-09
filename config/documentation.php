<?php

return [
    'groups' => [
        'getting-started/introduction'=>'Getting Started','getting-started/requirements'=>'Getting Started','getting-started/installation'=>'Getting Started','getting-started/quick-start'=>'Getting Started',
        'core-concepts/how-it-works'=>'Core Concepts','core-concepts/architecture'=>'Core Concepts','core-concepts/telegram-updates'=>'Core Concepts','core-concepts/controllers'=>'Core Concepts',
        'routing/commands'=>'Routing','routing/messages'=>'Routing','routing/callback-queries'=>'Routing','routing/route-parameters'=>'Routing','routing/named-routes'=>'Routing','routing/route-groups'=>'Routing','routing/middleware'=>'Routing',
        'bot-modes/webhook'=>'Bot Modes','bot-modes/polling'=>'Bot Modes','bot-modes/webhook-vs-polling'=>'Bot Modes',
        'keyboard/overview'=>'Keyboard','keyboard/reply-keyboard'=>'Keyboard','keyboard/inline-keyboard'=>'Keyboard','keyboard/buttons'=>'Keyboard','keyboard/callback-data'=>'Keyboard','keyboard/reusable-patterns'=>'Keyboard',
        'telegram/telegram-api'=>'Telegram & Responses','telegram/response-api'=>'Telegram & Responses','queue/queue'=>'Queue & Rate Limiting','queue/rate-limiting'=>'Queue & Rate Limiting',
        'testing/unit'=>'Testing','testing/feature'=>'Testing','testing/routing'=>'Testing','testing/telegram'=>'Testing','testing/api'=>'Testing',
        'configuration/configuration'=>'Configuration & Security','configuration/security'=>'Configuration & Security',
        'examples/simple-bot'=>'Examples','examples/start-command'=>'Examples','examples/echo-bot'=>'Examples','examples/inline-keyboard'=>'Examples','examples/callback-bot'=>'Examples','examples/admin-commands'=>'Examples','examples/queue-bot'=>'Examples',
        'api/route-api'=>'API Reference','api/keyboard-api'=>'API Reference','api/response-api'=>'API Reference','api/telegram-api'=>'API Reference',
        'changelog'=>'More','faq'=>'More','troubleshooting'=>'More','contributing'=>'More',
    ],
    'navigation' => [
        'Getting Started'=>['getting-started/introduction','getting-started/requirements','getting-started/installation','getting-started/quick-start'],
        'Core Concepts'=>['core-concepts/how-it-works','core-concepts/architecture','core-concepts/telegram-updates','core-concepts/controllers'],
        'Routing'=>['routing/commands','routing/messages','routing/callback-queries','routing/route-parameters','routing/named-routes','routing/route-groups','routing/middleware'],
        'Bot Modes'=>['bot-modes/webhook','bot-modes/polling','bot-modes/webhook-vs-polling'],
        'Keyboard'=>['keyboard/overview','keyboard/reply-keyboard','keyboard/inline-keyboard','keyboard/buttons','keyboard/callback-data','keyboard/reusable-patterns'],
        'Telegram & Responses'=>['telegram/telegram-api','telegram/response-api'],
        'Queue & Rate Limiting'=>['queue/queue','queue/rate-limiting'],
        'Testing'=>['testing/unit','testing/feature','testing/routing','testing/telegram','testing/api'],
        'Configuration & Security'=>['configuration/configuration','configuration/security'],
        'Examples'=>['examples/simple-bot','examples/start-command','examples/echo-bot','examples/inline-keyboard','examples/callback-bot','examples/admin-commands','examples/queue-bot'],
        'API Reference'=>['api/route-api','api/keyboard-api','api/response-api','api/telegram-api'],
        'More'=>['changelog','faq','troubleshooting','contributing'],
    ],
    'pages' => [
        'getting-started/introduction'=>['title'=>'Introduction','subtitle'=>'A Laravel-native router for Telegram bots — describe your bot with routes, controllers and middleware.','blocks'=>[
            ['t'=>'p','text'=>'Laravel Telegram Bot Router brings the routing model you already know from HTTP to the Telegram Bot API. Instead of a giant switch statement over update payloads, you declare routes for commands, text messages and callback queries, and dispatch them to controllers with middleware, parameters and named routes.'],
            ['t'=>'p','text'=>'The package is deliberately thin: it provides a dispatcher, a fluent response builder, keyboard helpers, queue integration and a test harness, and stays out of the way for everything else.'],
            ['t'=>'h2','text'=>'Why a router?'],['t'=>'list','items'=>['Every incoming Telegram update is matched against declared routes, exactly like an HTTP request.','Controllers keep bot logic testable and out of your service providers.','Middleware handles authorization, throttling, chat-type checks and logging in one place.','Route parameters turn /order 42 into a typed argument instead of manual string parsing.']],
            ['t'=>'h2','text'=>'A first look'],['t'=>'code','lang'=>'php','title'=>'routes/bot.php','code'=>"use ReyhanTeam\\TelegramBotRouter\\Facades\\TelegramRoute;\nuse App\\Telegram\\Controllers\\StartController;\n\nTelegramRoute::onCommand('start', [StartController::class, 'start']);"],
            ['t'=>'callout','kind'=>'tip','title'=>'Already know Laravel routing?','text'=>'Then you already know this package. The API follows the familiar Laravel routing model: names, groups, middleware and parameters.'],
            ['t'=>'h2','text'=>'What is in the box?'],['t'=>'list','items'=>['Command, message and callback-query routing','Webhook and long-polling transports','Reply and inline keyboard builders','A fluent Response API','Queue integration and rate limiting','A Telegram API client and test harness']],
        ]],
        'getting-started/requirements'=>['title'=>'Requirements','subtitle'=>'Everything you need before installing the package.','blocks'=>[
            ['t'=>'table','head'=>['Requirement','Version','Notes'],'rows'=>[['PHP','8.1+','Supported by the package'],['Laravel','10.x, 11.x, 12.x, 13.x','Use the version supported by the package release'],['ext-json','Required','Telegram update decoding'],['HTTP client','Required','Telegram Bot API transport'],['Queue driver','Optional','Only for queued updates'],['Cache','Optional','Recommended for deduplication and rate limiting']]],
            ['t'=>'h2','text'=>'Telegram side'],['t'=>'list','ordered'=>true,'items'=>['Create a bot with @BotFather and copy the token.','For webhooks, expose an HTTPS endpoint.','For local development, polling is usually the simplest option.']],
            ['t'=>'callout','kind'=>'warning','title'=>'HTTPS for webhooks','text'=>'Telegram requires a secure HTTPS endpoint for webhook delivery.'],
        ]],
        'getting-started/installation'=>['title'=>'Installation','subtitle'=>'Install the package and publish its Laravel route configuration.','blocks'=>[
            ['t'=>'h2','text'=>'Install via Composer'],['t'=>'code','lang'=>'bash','code'=>'composer require reyhanteam/laravel-telegram-bot-router'],
            ['t'=>'h2','text'=>'Publish bot routes'],['t'=>'code','lang'=>'bash','code'=>'php artisan vendor:publish --tag=telegram-bot-routes'],
            ['t'=>'p','text'=>'The command creates routes/bot.php. This file is dedicated to Telegram bot routes and stays separate from routes/web.php.'],
            ['t'=>'h2','text'=>'Publish configuration'],['t'=>'code','lang'=>'bash','code'=>'php artisan vendor:publish --tag=telegram-bot-config'],
            ['t'=>'h2','text'=>'Environment'],['t'=>'code','lang'=>'dotenv','title'=>'.env','code'=>'TELEGRAM_BOT_TOKEN=123456:AA...\nTELEGRAM_MODE=webhook\nTELEGRAM_WEBHOOK_PATH=/telegram/webhook'],
        ]],
        'getting-started/quick-start'=>['title'=>'Quick Start','subtitle'=>'Create a route, point it to a controller, and run your bot.','blocks'=>[
            ['t'=>'h2','text'=>'1. Declare a route'],['t'=>'code','lang'=>'php','title'=>'routes/bot.php','code'=>"use ReyhanTeam\\TelegramBotRouter\\Facades\\TelegramRoute;\nuse App\\Telegram\\Controllers\\StartController;\n\nTelegramRoute::onCommand('start', [StartController::class, 'start']);"],
            ['t'=>'h2','text'=>'2. Create the controller'],['t'=>'code','lang'=>'bash','code'=>'php artisan make:controller Telegram/StartController'],
            ['t'=>'h2','text'=>'3. Handle the update'],['t'=>'code','lang'=>'php','code'=>"public function start(Update $update): Response\n{\n    return Response::text('Welcome!');\n}"],
            ['t'=>'h2','text'=>'4. Run the bot'],['t'=>'code','lang'=>'bash','code'=>'php artisan reyhan:start-polling'],
            ['t'=>'callout','kind'=>'tip','text'=>'Send /start to your bot. The router matches the command and calls the configured controller method.'],
        ]],
        'core-concepts/how-it-works'=>['title'=>'How It Works','subtitle'=>'From a Telegram update to a controller response.','blocks'=>[
            ['t'=>'p','text'=>'Telegram sends an Update payload. The package normalises the payload, determines its type, matches it against the Telegram route table and invokes the selected handler.'],
            ['t'=>'list','ordered'=>true,'items'=>['Webhook or polling receives the update.','The update is parsed into the package update model.','The router finds the first matching Telegram route.','Middleware runs around the handler.','The controller or callable returns a Response.','The response is converted into Telegram Bot API calls.']],
            ['t'=>'h2','text'=>'Matching order'],['t'=>'p','text'=>'Routes are matched from top to bottom. Put specific routes before generic routes and keep fallback behaviour last.'],
        ]],
        'core-concepts/architecture'=>['title'=>'Architecture','subtitle'=>'The moving parts and how they fit together.','blocks'=>[
            ['t'=>'table','head'=>['Component','Responsibility'],'rows'=>[['Transport','Webhook or polling receives updates'],['Update layer','Normalises Telegram payloads'],['Router','Finds a matching Telegram route'],['Middleware pipeline','Runs cross-cutting logic'],['Controller','Application logic'],['Response','Describes outgoing Telegram calls'],['Telegram client','Communicates with the Bot API']]],
            ['t'=>'p','text'=>'The design keeps transport, routing and application logic separated so the same route table can be used by webhook and polling.'],
        ]],
        'core-concepts/telegram-updates'=>['title'=>'Telegram Updates','subtitle'=>'The update object and the data it exposes.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"public function start(Update $update)\n{\n    $update->id;\n    $update->text;\n    $update->chat->id;\n    $update->from->id;\n    $update->callbackData;\n    $update->raw();\n}"],
            ['t'=>'h2','text'=>'Update kinds'],['t'=>'table','head'=>['Kind','Typical route'],'rows'=>[['message','onCommand(), onMessage()'],['callback_query','onCallback()'],['edited_message','message route with edited update'],['inline_query','inline-query route'],['chat member','chat-member route']]],
        ]],
        'core-concepts/controllers'=>['title'=>'Controllers','subtitle'=>'Where your bot logic lives.','blocks'=>[
            ['t'=>'p','text'=>'Telegram controllers are ordinary Laravel classes. Constructor injection works through the service container, and handler methods receive the update plus route parameters.'],
            ['t'=>'code','lang'=>'php','code'=>"class OrderController\n{\n    public function show(Update $update, string $id): Response\n    {\n        return Response::text(\"Order #{$id}\");\n    }\n}"],
            ['t'=>'callout','kind'=>'tip','text'=>'Keep controllers thin. Put business rules in services and use Response builders for output.'],
        ]],
        'routing/commands'=>['title'=>'Command Routes','subtitle'=>'Route slash commands to handlers.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('start', [StartController::class, 'start']);\nRoute::onCommand('help', [HelpController::class, 'help']);\nRoute::onCommand(['stats', 'statistics'], StatsController::class);"],
            ['t'=>'h2','text'=>'Bot mentions in groups'],['t'=>'p','text'=>'Commands can arrive with a bot mention such as /start@my_bot. Configure the bot username so the router can normalise the command.'],
        ]],
        'routing/messages'=>['title'=>'Message Routes','subtitle'=>'Match free-form text and message updates.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onMessage('Menu', MenuController::class);\nRoute::onMessage('/^track\\\\s+(?<code>[A-Z0-9]+)$/i', TrackController::class);\nRoute::onPhoto(PhotoController::class);\nRoute::onDocument(DocumentController::class);"],
            ['t'=>'p','text'=>'Use command routes for slash commands and message routes for normal text.'],
        ]],
        'routing/callback-queries'=>['title'=>'Callback Queries','subtitle'=>'Handle inline keyboard button presses.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCallback('order:{id}:cancel', [OrderController::class, 'cancel']);\n\npublic function cancel(Update $update, string $id): Response\n{\n    return Response::answerCallback('Cancelled');\n}"],
            ['t'=>'callout','kind'=>'warning','title'=>'Answer callbacks','text'=>'Telegram displays a loading state until a callback query is answered. Make sure your handler answers it.'],
        ]],
        'routing/route-parameters'=>['title'=>'Route Parameters','subtitle'=>'Use typed parameters instead of manual string parsing.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('order {id}', [OrderController::class, 'show']);\nRoute::onCommand('remind {when} {message?}', RemindController::class);\nRoute::onCommand('user {id}', UserController::class)->where('id', '[0-9]+');"],
            ['t'=>'table','head'=>['Syntax','Meaning'],'rows'=>[['{id}','Required parameter'],['{id?}','Optional parameter'],['{rest*}','Remaining text'],['where()','Regular-expression constraint']]],
        ]],
        'routing/named-routes'=>['title'=>'Named Routes','subtitle'=>'Give Telegram routes stable names.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCallback('order:{id}:cancel', [OrderController::class, 'cancel'])->name('orders.cancel');"],
            ['t'=>'p','text'=>'Named routes make route references stable and allow keyboard callback data to be generated from a single route definition.'],
        ]],
        'routing/route-groups'=>['title'=>'Route Groups','subtitle'=>'Share middleware and other attributes.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::middleware('telegram.admin')->group(function () {\n    Route::onCommand('stats', StatsController::class);\n    Route::onCommand('ban {id}', BanController::class);\n});"],
        ]],
        'routing/middleware'=>['title'=>'Middleware','subtitle'=>'Authorization, throttling and cross-cutting concerns.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"class EnsureUserIsAdmin\n{\n    public function handle(Update $update, Closure $next)\n    {\n        if (! in_array($update->from->id, config('telegram-bot.admins'))) {\n            return Response::text('Not allowed.');\n        }\n\n        return $next($update);\n    }\n}"],
            ['t'=>'p','text'=>'Middleware can be attached globally, to a route group, or to an individual Telegram route.'],
        ]],
        'bot-modes/webhook'=>['title'=>'Webhook Mode','subtitle'=>'Let Telegram push updates to your Laravel application.','blocks'=>[
            ['t'=>'p','text'=>'In webhook mode Telegram sends an HTTP POST to the configured Laravel webhook route. The package receives the request and sends it through the same Telegram router.'],
            ['t'=>'code','lang'=>'bash','code'=>'php artisan reyhan:set-webhook-route'],
            ['t'=>'code','lang'=>'env','code'=>'TELEGRAM_MODE=webhook\nTELEGRAM_WEBHOOK_PATH=/telegram/webhook'],
            ['t'=>'callout','kind'=>'danger','title'=>'Protect the endpoint','text'=>'Use a webhook secret or another validation layer in production.'],
        ]],
        'bot-modes/polling'=>['title'=>'Polling Mode','subtitle'=>'Pull updates with long polling.','blocks'=>[
            ['t'=>'code','lang'=>'bash','code'=>'php artisan reyhan:start-polling'],
            ['t'=>'p','text'=>'Polling keeps asking Telegram for updates and passes every update through the same route table used by webhook mode.'],
            ['t'=>'callout','kind'=>'warning','text'=>'Do not run polling while a webhook is registered for the same bot.'],
        ]],
        'bot-modes/webhook-vs-polling'=>['title'=>'Webhook vs Polling','subtitle'=>'Choose the transport that fits your environment.','blocks'=>[
            ['t'=>'table','head'=>['Aspect','Webhook','Polling'],'rows'=>[['Latency','Push immediately','Long-poll response'],['HTTPS','Required','Not required'],['Local development','Needs public tunnel','Works directly'],['Production','Recommended','Use with process manager'],['Route table','Same','Same']]],
            ['t'=>'callout','kind'=>'tip','text'=>'Both modes use the same routes and controllers. Switching transport does not require rewriting bot logic.'],
        ]],
        'keyboard/overview'=>['title'=>'Keyboards Overview','subtitle'=>'Reply and inline keyboards with a fluent builder.','blocks'=>[
            ['t'=>'p','text'=>'Reply keyboards send text messages. Inline keyboards are attached to messages and can produce callback queries or open URLs.'],
            ['t'=>'table','head'=>['Type','Sends','Attached to'],'rows'=>[['Reply keyboard','Text','Chat input area'],['Inline keyboard','Callback query or URL','Message']]],
        ]],
        'keyboard/reply-keyboard'=>['title'=>'Reply Keyboard','subtitle'=>'Replace the user keyboard with predefined choices.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"$keyboard = Keyboard::reply()\n    ->button('Menu')\n    ->button('Support')\n    ->row()\n    ->contact('Share phone')\n    ->location('Share location')\n    ->resize();\n\nreturn Response::text('Choose an option')->keyboard($keyboard);"],
            ['t'=>'h3','text'=>'Removing the keyboard'],['t'=>'code','lang'=>'php','code'=>"return Response::text('Done')->removeKeyboard();"],
        ]],
        'keyboard/inline-keyboard'=>['title'=>'Inline Keyboard','subtitle'=>'Buttons attached to a message.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"$keyboard = Keyboard::inline()\n    ->button('Approve', callback: \"order:{$id}:approve\")\n    ->button('Reject', callback: \"order:{$id}:reject\")\n    ->row()\n    ->url('Open dashboard', $url);"],
            ['t'=>'h3','text'=>'Editing in place'],['t'=>'code','lang'=>'php','code'=>"return Response::answerCallback('Approved')->editText('Order approved.');"],
        ]],
        'keyboard/buttons'=>['title'=>'Buttons','subtitle'=>'Common Telegram keyboard button types.','blocks'=>[
            ['t'=>'table','head'=>['Method','Button type'],'rows'=>[['button($text, callback: $data)','Callback button'],['url($text, $url)','URL'],['webApp($text, $url)','Telegram Web App'],['contact($text)','Reply contact request'],['location($text)','Reply location request'],['pay($text)','Payment button']]],
        ]],
        'keyboard/callback-data'=>['title'=>'Callback Data','subtitle'=>'Structured callback payloads.','blocks'=>[
            ['t'=>'p','text'=>'Callback data should stay short. A structured convention makes it easy to map button payloads to callback routes.'],
            ['t'=>'code','lang'=>'php','code'=>"'order:42:cancel'\n\nRoute::onCallback('order:{id}:cancel', ...);"],
            ['t'=>'callout','kind'=>'danger','title'=>'Do not trust callback data','text'=>'Callback data is user-controlled input. Authorize the requested action in the handler.'],
        ]],
        'keyboard/reusable-patterns'=>['title'=>'Reusable Patterns','subtitle'=>'Pagination, confirmation and menu keyboards.','blocks'=>[
            ['t'=>'h3','text'=>'Confirmation'],['t'=>'code','lang'=>'php','code'=>"return Keyboard::inline()\n    ->button('Yes', callback: \"delete:{$id}:yes\")\n    ->button('No', callback: \"delete:{$id}:no\");"],
            ['t'=>'h3','text'=>'Pagination'],['t'=>'code','lang'=>'php','code'=>"Keyboard::inline()\n    ->button('Previous', callback: 'page:'.($page - 1))\n    ->button('Next', callback: 'page:'.($page + 1));"],
        ]],
        'telegram/telegram-api'=>['title'=>'Telegram API','subtitle'=>'Call Bot API methods through the package client.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Telegram::sendMessage(chat_id: $chatId, text: 'Hello');\nTelegram::sendPhoto(chat_id: $chatId, photo: $url);\nTelegram::getMe();\nTelegram::call('setChatTitle', ['chat_id' => $chatId, 'title' => 'New title']);"],
            ['t'=>'callout','kind'=>'note','text'=>'The client exposes common Bot API methods and provides a generic call path for methods not covered by a helper.'],
        ]],
        'telegram/response-api'=>['title'=>'Response API','subtitle'=>'Describe outgoing Telegram messages fluently.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"return Response::text('Hello')\n    ->replyTo($update->messageId)\n    ->keyboard($keyboard);\n\nResponse::markdown('*bold*');\nResponse::photo($url);\nResponse::document($file);"],
            ['t'=>'table','head'=>['Method','Effect'],'rows'=>[['text()','Text message'],['markdown()','Markdown message'],['html()','HTML message'],['photo()','Photo'],['document()','Document'],['keyboard()','Attach keyboard'],['removeKeyboard()','Remove keyboard'],['answerCallback()','Answer callback']]],
        ]],
        'queue/queue'=>['title'=>'Queue','subtitle'=>'Process slow handlers in the background.','blocks'=>[
            ['t'=>'p','text'=>'Queued updates let webhook requests return quickly while slow work runs in a Laravel queue worker.'],
            ['t'=>'code','lang'=>'env','code'=>'TELEGRAM_QUEUE_CONNECTION=database\nTELEGRAM_QUEUE_NAME=telegram-test\nTELEGRAM_QUEUE_TRIES=3\nTELEGRAM_QUEUE_BACKOFF=1,1,1\nTELEGRAM_QUEUE_TIMEOUT=120'],
            ['t'=>'code','lang'=>'bash','code'=>'php artisan queue:work --queue=telegram-test'],
            ['t'=>'callout','kind'=>'warning','text'=>'Queued work sends its Telegram response as a fresh Bot API call rather than as the original webhook HTTP response.'],
        ]],
        'queue/rate-limiting'=>['title'=>'Rate Limiting','subtitle'=>'Protect your bot and stay inside Telegram limits.','blocks'=>[
            ['t'=>'p','text'=>'Outgoing calls can be throttled, while incoming commands can be limited per user, chat or command.'],
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('search', SearchController::class)\n    ->middleware('telegram.throttle:5,1');"],
            ['t'=>'code','lang'=>'env','code'=>'TELEGRAM_RATE_LIMIT_ENABLED=true'],
        ]],
        'testing/unit'=>['title'=>'Unit Tests','subtitle'=>'Test controllers in isolation.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"it('greets the user', function () {\n    $update = Update::fake()->message('/start');\n    $response = (new StartController)->start($update);\n    expect($response)->not->toBeNull();\n});"],
        ]],
        'testing/feature'=>['title'=>'Feature Tests','subtitle'=>'Drive the Telegram pipeline end to end.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Telegram::fake();\n$this->telegram()->send('/start');\nTelegram::assertSent('sendMessage');"],
            ['t'=>'callout','kind'=>'note','text'=>'The fake client prevents network calls and records outgoing Telegram API requests for assertions.'],
        ]],
        'testing/routing'=>['title'=>'Routing Tests','subtitle'=>'Assert that updates reach the correct handler.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"expect(TelegramRoute::resolve(Update::fake()->message('/start')))->not->toBeNull();"],
        ]],
        'testing/telegram'=>['title'=>'Telegram Fakes','subtitle'=>'Assertions for outgoing Bot API calls.','blocks'=>[
            ['t'=>'table','head'=>['Assertion','Checks'],'rows'=>[['assertSent()','A method was called'],['assertNotSent()','A method was not called'],['assertSentCount()','Number of API calls'],['assertMessageContains()','Message content'],['assertKeyboardHas()','Button label'],['assertCallbackAnswered()','Callback was answered']]],
        ]],
        'testing/api'=>['title'=>'API Tests','subtitle'=>'Test the webhook endpoint itself.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"it('accepts a valid update', function () {\n    $this->postJson('/telegram/webhook', Update::fake()->message('/ping')->toArray())\n        ->assertOk();\n});"],
        ]],
        'configuration/configuration'=>['title'=>'Configuration','subtitle'=>'Configure transport, routing, queue and Telegram API behaviour.','blocks'=>[
            ['t'=>'table','head'=>['Key','Example','Description'],'rows'=>[['token','env(...)','Bot token'],['mode','webhook','webhook or polling'],['webhook.path','telegram/webhook','Receiving route'],['queue.updates','true','Queue incoming updates'],['rate_limit.enabled','true','Enable outgoing/incoming limits'],['logging.channel','stack','Logging channel']]],
            ['t'=>'callout','kind'=>'note','text'=>'Use the published configuration file as the source of truth for the installed package version.'],
        ]],
        'configuration/security'=>['title'=>'Security','subtitle'=>'Harden your bot before production.','blocks'=>[
            ['t'=>'list','items'=>['Keep the bot token out of version control.','Validate webhook requests.','Authorize sensitive commands and callback actions.','Escape untrusted text before Markdown or HTML output.','Rate-limit public commands.','Avoid logging complete Telegram payloads when they contain personal data.']],
        ]],
        'examples/simple-bot'=>['title'=>'Simple Bot','subtitle'=>'The smallest useful bot.','blocks'=>[
            ['t'=>'code','lang'=>'php','title'=>'routes/bot.php','code'=>"Route::onCommand('start', fn () => Response::text('Hi!'));\nRoute::onCommand('ping', fn () => Response::text('pong'));"],
        ]],
        'examples/start-command'=>['title'=>'Start Command','subtitle'=>'Handle onboarding with /start.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('start', [StartController::class, 'start']);\n\npublic function start(Update $update): Response\n{\n    return Response::text(\"Welcome, {$update->from->firstName}!\");\n}"],
        ]],
        'examples/echo-bot'=>['title'=>'Echo Bot','subtitle'=>'Repeat normal text messages.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onMessage('*', function (Update $update) {\n    return Response::text($update->text);\n});"],
        ]],
        'examples/inline-keyboard'=>['title'=>'Inline Keyboard Example','subtitle'=>'A callback-driven keyboard.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('products', [ProductController::class, 'index']);\nRoute::onCallback('products:page:{page}', [ProductController::class, 'page']);"],
        ]],
        'examples/callback-bot'=>['title'=>'Callback Bot','subtitle'=>'A confirmation flow driven by callbacks.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('delete {id}', [AccountController::class, 'confirm']);\nRoute::onCallback('account:{id}:delete:{answer}', [AccountController::class, 'resolve']);"],
        ]],
        'examples/admin-commands'=>['title'=>'Admin Commands','subtitle'=>'Protect commands with middleware.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::middleware('telegram.admin')->group(function () {\n    Route::onCommand('stats', StatsController::class);\n    Route::onCommand('broadcast {message*}', BroadcastController::class);\n});"],
        ]],
        'examples/queue-bot'=>['title'=>'Queue-based Bot','subtitle'=>'Long-running work without webhook timeouts.','blocks'=>[
            ['t'=>'code','lang'=>'php','code'=>"Route::onCommand('export', ExportController::class)->queue();"],
            ['t'=>'code','lang'=>'bash','code'=>'php artisan queue:work'],
        ]],
        'api/route-api'=>['title'=>'Route API','subtitle'=>'Telegram route registration reference.','blocks'=>[
            ['t'=>'table','head'=>['Method','Description'],'rows'=>[['onCommand()','Route a slash command'],['onMessage()','Route text messages'],['onCallback()','Route callback queries'],['onPhoto()','Route photo updates'],['onDocument()','Route document updates'],['fallback()','Handle unmatched updates'],['name()','Name a route'],['middleware()','Attach middleware'],['where()','Constrain a parameter'],['queue()','Queue a route']]],
        ]],
        'api/keyboard-api'=>['title'=>'Keyboard API','subtitle'=>'Builder reference for reply and inline keyboards.','blocks'=>[
            ['t'=>'table','head'=>['Method','Description'],'rows'=>[['make()','Create a keyboard'],['button()','Add a button'],['url()','Add a URL button'],['webApp()','Add a Web App button'],['contact()','Request contact'],['location()','Request location'],['row()','Start a new row'],['when()','Conditional builder'],['resize()','Resize reply keyboard'],['oneTime()','One-time reply keyboard']]],
        ]],
        'api/response-api'=>['title'=>'Response API Reference','subtitle'=>'Factories and modifiers on Response.','blocks'=>[
            ['t'=>'table','head'=>['Method','Description'],'rows'=>[['Response::text()','Plain text'],['Response::markdown()','Markdown'],['Response::html()','HTML'],['Response::photo()','Photo'],['Response::document()','Document'],['Response::answerCallback()','Answer callback'],['->replyTo()','Reply to message'],['->keyboard()','Attach keyboard'],['->editText()','Edit source message'],['->deleteMessage()','Delete source message'],['->then()','Chain another response']]],
        ]],
        'api/telegram-api'=>['title'=>'Telegram API Reference','subtitle'=>'Client methods and error handling.','blocks'=>[
            ['t'=>'table','head'=>['Method','Description'],'rows'=>[['Telegram::getMe()','Bot identity'],['Telegram::sendMessage()','Send a message'],['Telegram::sendPhoto()','Send a photo'],['Telegram::sendDocument()','Send a document'],['Telegram::sendVideo()','Send a video'],['Telegram::getFile()','File metadata'],['Telegram::downloadFile()','Download a file'],['Telegram::setWebhook()','Set webhook'],['Telegram::deleteWebhook()','Delete webhook'],['Telegram::call()','Call any Bot API method']]],
        ]],
        'changelog'=>['title'=>'Changelog','subtitle'=>'Notable changes to Laravel Telegram Bot Router.','blocks'=>[
            ['t'=>'h2','text'=>'v1.0.8'],['t'=>'list','items'=>['Webhook and polling flows working together through the shared router pipeline.']],
            ['t'=>'h2','text'=>'v1.x'],['t'=>'list','items'=>['Routing, keyboard, response, queue, rate limiting and testing capabilities continue to evolve with the package.']],
        ]],
        'faq'=>['title'=>'FAQ','subtitle'=>'Short answers to common questions.','blocks'=>[
            ['t'=>'faq','items'=>[['q'=>'Can I use controllers?','a'=>'Yes. Route handlers can point to normal Laravel controller methods or invokable classes.'],['q'=>'Can I use polling locally?','a'=>'Yes. Polling is designed for environments where a public webhook endpoint is not available.'],['q'=>'Can I use webhook in production?','a'=>'Yes. Webhook mode is suitable for production when the endpoint is secured and publicly reachable over HTTPS.'],['q'=>'Can I use both at the same time?','a'=>'No. Telegram does not allow getUpdates while a webhook is active for the same bot.'],['q'=>'Can I queue updates?','a'=>'Yes. Enable the queue update option and run the configured Laravel queue worker.']]],
        ]],
        'troubleshooting'=>['title'=>'Troubleshooting','subtitle'=>'Common symptoms, causes and fixes.','blocks'=>[
            ['t'=>'h2','text'=>'Bot does not respond'],['t'=>'list','items'=>['Check that the route exists in routes/bot.php.','Check the bot token.','Check the configured mode.','For webhook, check the registered webhook route and server logs.','For polling, make sure the polling command is running.']],
            ['t'=>'h2','text'=>'Webhook problems'],['t'=>'list','items'=>['409 Conflict usually means another update consumer is active.','401 Unauthorized usually means the bot token is invalid.','404 means the webhook URL or path is wrong.']],
            ['t'=>'h2','text'=>'Duplicate replies'],['t'=>'p','text'=>'Move slow work to the queue and use update deduplication when appropriate.'],
        ]],
        'contributing'=>['title'=>'Contributing','subtitle'=>'How to help improve the package.','blocks'=>[
            ['t'=>'code','lang'=>'bash','code'=>'git clone https://github.com/ReyhanTeam/laravel-telegram-bot-router\ncomposer install\ncomposer test\ncomposer lint'],
            ['t'=>'list','ordered'=>true,'items'=>['Open an issue for large changes.','Keep pull requests focused.','Add tests for behaviour changes.','Run the project formatter and static analysis.','Keep commits clear and consistent.']],
        ]],
    ],
];
