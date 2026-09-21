<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} | API Backend</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bricolage-grotesque:600,700,800|jetbrains-mono:400,500,700|figtree:400,500,600&display=swap" rel="stylesheet">

    <style>
        :root {
            --paper: #eef2f7;
            --panel: #ffffff;
            --ink: #14213d;
            --muted: #56627a;
            --line: #d5dce8;
            --blue: #2f5bff;
            --code-bg: #101a33;
            --code-line: #24335c;
            --code-text: #cfd8f2;
            --get: #0f9d7a;
            --post: #2f5bff;
            --put: #c77d0a;
            --delete: #d63b4b;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html { -webkit-text-size-adjust: 100%; }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--paper);
            color: var(--ink);
            font-family: 'Figtree', system-ui, sans-serif;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        a { color: inherit; }

        :focus-visible {
            outline: 3px solid var(--blue);
            outline-offset: 3px;
            border-radius: 6px;
        }

        .wrap {
            max-width: 1120px;
            margin: 0 auto;
            padding: 48px 24px 32px;
        }

        /* Hero */
        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 48px;
            align-items: center;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 14px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--muted);
        }

        .status i {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--get);
            box-shadow: 0 0 0 4px rgba(15, 157, 122, 0.18);
        }

        h1 {
            margin: 22px 0 0;
            font-family: 'Bricolage Grotesque', 'Figtree', sans-serif;
            font-weight: 800;
            font-size: clamp(2.4rem, 5.4vw, 4rem);
            line-height: 1.02;
            letter-spacing: -0.03em;
        }

        .lead {
            margin: 22px 0 0;
            max-width: 46ch;
            font-size: 1.125rem;
            color: var(--muted);
        }

        .base {
            display: flex;
            align-items: stretch;
            margin-top: 32px;
            max-width: 480px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
        }

        .base span {
            flex: 1;
            min-width: 0;
            padding: 13px 16px;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            white-space: nowrap;
        }

        .base button {
            border: 0;
            border-left: 1px solid var(--line);
            padding: 0 20px;
            background: var(--ink);
            color: #fff;
            font: 600 0.9rem 'Figtree', sans-serif;
            cursor: pointer;
        }

        .base button:hover { background: var(--blue); }

        .hint {
            margin: 10px 0 0;
            font-size: 0.875rem;
            color: var(--muted);
        }

        /* Request / response window */
        .window {
            background: var(--code-bg);
            border-radius: 16px;
            box-shadow: 0 30px 60px -30px rgba(20, 33, 61, 0.55);
            overflow: hidden;
            min-width: 0;
        }

        .window .bar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            border-bottom: 1px solid var(--code-line);
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.85rem;
            color: var(--code-text);
            overflow-x: auto;
            white-space: nowrap;
        }

        .method {
            display: inline-block;
            min-width: 62px;
            padding: 2px 8px;
            border-radius: 6px;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.72rem;
            font-weight: 700;
            text-align: center;
            color: #fff;
        }

        .m-get { background: var(--get); }
        .m-post { background: var(--post); }
        .m-put { background: var(--put); }
        .m-delete { background: var(--delete); }

        .window .meta {
            padding: 10px 18px;
            border-bottom: 1px solid var(--code-line);
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.78rem;
            color: #8d9bc4;
        }

        .window .meta b { color: #5fd3b3; font-weight: 500; }

        .window pre {
            margin: 0;
            padding: 18px;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.82rem;
            line-height: 1.7;
            color: var(--code-text);
            overflow-x: auto;
        }

        .k { color: #8fb0ff; }
        .s { color: #f0c987; }
        .n { color: #6fe0c0; }

        /* Sections */
        section { margin-top: 72px; }

        h2 {
            margin: 0;
            font-family: 'Bricolage Grotesque', 'Figtree', sans-serif;
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: -0.02em;
        }

        .section-note {
            margin: 8px 0 0;
            color: var(--muted);
        }

        .tools {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 22px;
        }

        .tool {
            padding: 12px 20px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
        }

        .tool:hover { border-color: var(--ink); }

        .groups {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-top: 24px;
        }

        .group {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 22px;
        }

        .group h3 {
            margin: 0 0 14px;
            font-size: 1rem;
            font-weight: 700;
        }

        .group ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .group li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 0;
            border-top: 1px solid var(--line);
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.82rem;
            overflow-x: auto;
            white-space: nowrap;
        }

        .group li:first-child { border-top: 0; }

        .auth-note {
            margin-top: 20px;
            padding: 14px 18px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-left: 4px solid var(--blue);
            border-radius: 10px;
            color: var(--muted);
        }

        .auth-note code {
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.85rem;
            color: var(--ink);
        }

        footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 8px;
            margin-top: 72px;
            padding-top: 22px;
            border-top: 1px solid var(--line);
            font-size: 0.875rem;
            color: var(--muted);
        }

        @media (max-width: 860px) {
            .hero { grid-template-columns: minmax(0, 1fr); gap: 36px; }
            .groups { grid-template-columns: minmax(0, 1fr); }
            .wrap { padding-top: 32px; }
            section { margin-top: 56px; }
        }
    </style>
</head>
<body>
    <main class="wrap">
        <div class="hero">
            <div>
                <span class="status"><i></i> API is running</span>

                <h1>This app is a full API backend</h1>

                <p class="lead">
                    There is no web interface here. Develop your own front end app,
                    or test the endpoints with Postman, Insomnia, or any API client.
                </p>

                <div class="base">
                    <span id="base-url">{{ url('/api') }}</span>
                    <button type="button" id="copy-btn">Copy</button>
                </div>
                <p class="hint">Base URL. Send <code>Accept: application/json</code> with every request.</p>
            </div>

            <div class="window" aria-label="Example request and response">
                <div class="bar">
                    <span class="method m-get">GET</span>
                    <span>/api/produk/index</span>
                </div>
                <div class="meta"><b>200 OK</b> &nbsp; application/json</div>
<pre><span class="k">{</span>
  <span class="k">"success"</span>: <span class="n">true</span>,
  <span class="k">"message"</span>: <span class="s">"Data retrieved"</span>,
  <span class="k">"data"</span>: <span class="k">[</span>
    <span class="k">{</span>
      <span class="k">"id"</span>: <span class="n">1</span>,
      <span class="k">"kode_produk"</span>: <span class="s">"PRD-001"</span>,
      <span class="k">"nama"</span>: <span class="s">"Beras 5kg"</span>,
      <span class="k">"harga"</span>: <span class="n">65000</span>,
      <span class="k">"stok"</span>: <span class="n">50</span>
    <span class="k">}</span>
  <span class="k">]</span>
<span class="k">}</span></pre>
            </div>
        </div>

        <section>
            <h2>Test it with</h2>
            <p class="section-note">Any HTTP client works. These are the most common.</p>
            <div class="tools">
                <a class="tool" href="https://www.postman.com/downloads/" target="_blank" rel="noopener">Postman</a>
                <a class="tool" href="https://insomnia.rest/download" target="_blank" rel="noopener">Insomnia</a>
                <a class="tool" href="https://usebruno.com/downloads" target="_blank" rel="noopener">Bruno</a>
                <a class="tool" href="https://marketplace.visualstudio.com/items?itemName=rangav.vscode-thunder-client" target="_blank" rel="noopener">Thunder Client</a>
                <a class="tool" href="https://curl.se/" target="_blank" rel="noopener">cURL</a>
            </div>
        </section>

        <section>
            <h2>Endpoints</h2>
            <p class="section-note">All paths start with <code>/api</code>.</p>

            <div class="groups">
                <div class="group">
                    <h3>Authentication</h3>
                    <ul>
                        <li><span class="method m-post">POST</span> /register</li>
                        <li><span class="method m-post">POST</span> /login</li>
                    </ul>
                </div>

                <div class="group">
                    <h3>Store</h3>
                    <ul>
                        <li><span class="method m-get">GET</span> /toko/index</li>
                        <li><span class="method m-post">POST</span> /toko/store</li>
                        <li><span class="method m-get">GET</span> /toko/show/{id}</li>
                        <li><span class="method m-put">PUT</span> /toko/update/{id}</li>
                        <li><span class="method m-delete">DELETE</span> /toko/delete/{id}</li>
                    </ul>
                </div>

                <div class="group">
                    <h3>Product</h3>
                    <ul>
                        <li><span class="method m-get">GET</span> /produk/index</li>
                        <li><span class="method m-post">POST</span> /produk/store</li>
                        <li><span class="method m-get">GET</span> /produk/show/{id}</li>
                        <li><span class="method m-put">PUT</span> /produk/update/{id}</li>
                        <li><span class="method m-delete">DELETE</span> /produk/delete/{id}</li>
                    </ul>
                </div>

                <div class="group">
                    <h3>Transaction</h3>
                    <ul>
                        <li><span class="method m-get">GET</span> /transaksi/index</li>
                        <li><span class="method m-post">POST</span> /transaksi/store</li>
                        <li><span class="method m-get">GET</span> /transaksi/show/{id}</li>
                        <li><span class="method m-delete">DELETE</span> /transaksi/delete/{id}</li>
                    </ul>
                </div>
            </div>

            <p class="auth-note">
                Log in first, then send the token with every store, product, and transaction request:
                <code>Authorization: Bearer YOUR_TOKEN</code>
            </p>
        </section>

        <footer>
            <span>{{ config('app.name', 'Laravel') }} API</span>
            <span>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</span>
        </footer>
    </main>

    <script>
        (function () {
            var btn = document.getElementById('copy-btn');
            var url = document.getElementById('base-url').textContent.trim();

            btn.addEventListener('click', function () {
                var done = function () {
                    btn.textContent = 'Copied';
                    setTimeout(function () { btn.textContent = 'Copy'; }, 1500);
                };

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(url).then(done);
                } else {
                    var input = document.createElement('input');
                    input.value = url;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    done();
                }
            });
        })();
    </script>
</body>
</html>